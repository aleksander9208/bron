<?php

class AdminService
{


    public static function getStatCamp($statId)
    {
        $reserve = Yii::app()->db->createCommand()
            ->select('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27')
            ->from('{{questionnaire_rezerv}}')
            ->where('id=1')
            ->queryRow();
        $ids = array();
        $camp_reserve = array();
        $questionnaire = array();
        $questionnaire_main = array();
        $campSeats = array();

        switch ($statId) {
            case 4:
            case 5:
                $where = ' AND type=' . Questionnaire::TYPE_UR;
                break;
            default:
                $where = '';
        }

        foreach (Questionnaire::getCAMPName() as $campId => $campName) {
            $shiftsData = SiteService::getShifts($campId);
            $camp_reserve[$campId] = 0;
            $campSeats[$campId] = 0;
            $campReserveByShift = array();
            $shifts = Questionnaire::getShiftsByParams($campId);
            foreach ($shifts as $sId) {
                $camp_reserve[$campId] += $reserve['srez_' . $sId];
                $campReserveByShift[$sId] = $reserve['srez_' . $sId];
                $campSeats[$campId] += $shiftsData[$sId]['seats'];
            }


            foreach ($shiftsData as $sId => $v) {
                $questionnaire_main[$campId][$sId] = array();
                $questionnaire[$campId][$sId] = array();

                $result = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('{{questionnaire}}')
                    ->where('status=:status AND shift_id=:shift AND is_main=1 AND booking_id IS NOT NULL' . $where, array('status' => Questionnaire::STATUS_OK, 'shift' => $sId))
                    ->order('created ASC')
                    ->limit($campReserveByShift[$sId])
                    ->queryAll();

                foreach ($result as $r) {
                    if (!isset($questionnaire_main[$r['camp_id']][$r['shift_id']])) {
                        $questionnaire_main[$r['camp_id']][$r['shift_id']] = array();
                    }
                    if ($reserve['srez_' . $r['shift_id']] > count($questionnaire_main[$r['camp_id']][$r['shift_id']])) {
                        $questionnaire_main[$r['camp_id']][$r['shift_id']][] = $r;
                        switch ($statId) {
                            case 4:
                                $ids[$r['name_ur']][] = $r;
                                break;
                            case 5:
                                $ids[$r['name_ur']][$r['camp_id']][$r['shift_id']][] = $r;
                                break;
                        }
                    }
                }
                $result = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('{{questionnaire}}')
                    ->where('status=:status AND shift_id=:shift AND is_main=0 AND booking_id IS NOT NULL' . $where, array('status' => Questionnaire::STATUS_OK, 'shift' => $sId))
                    ->order('created ASC')
                    ->limit($shiftsData[$sId]['seats'])
                    ->queryAll();

                foreach ($result as $r) {
                    $cntQuestnMain = (int)(isset($questionnaire_main[$r['camp_id']][$r['shift_id']]) ? count($questionnaire_main[$r['camp_id']][$r['shift_id']]) : 0);
                    $cntQuestn = (int)(isset($questionnaire[$r['camp_id']][$r['shift_id']]) ? count($questionnaire[$r['camp_id']][$r['shift_id']]) : 0);
                    if ($campSeats[$campId] > ($cntQuestnMain + $cntQuestn)) {
                        $questionnaire[$r['camp_id']][$r['shift_id']][] = $r;
                        switch ($statId) {
                            case 4:
                                $ids[$r['name_ur']][] = $r;
                                break;
                            case 5:
                                $ids[$r['name_ur']][$r['camp_id']][$r['shift_id']][] = $r;
                                break;
                        }
                    }
                }

            }
        }
        switch ($statId) {
            case 4:
            case 5:
                $questionnaire = $ids;
                break;

        }

        $reserve = array();
        return array('questionnaire_main' => $questionnaire_main, 'questionnaire' => $questionnaire, 'reserve' => $reserve, 'camp_reserve' => $camp_reserve);
    }

    public static function getFillReserv()
    {
        $out = array();
        $result = Yii::app()->db->createCommand()
            ->select('shift_id,count(id) as cnt')
            ->from('{{questionnaire}}')
            ->where('status=:status AND is_main=1 AND booking_id IS NOT NULL', array('status' => Questionnaire::STATUS_OK))
            ->order('created ASC')
            ->group('shift_id')
            ->queryAll();

        $shifts = SiteService::getShifts();
        foreach ($shifts as $s) {
            $out[$s['id']] = 0;
        }
        foreach ($result as $r) {
            if (isset($out[$r['shift_id']])) {
                $out[$r['shift_id']] = $r['cnt'];
            }
        }

        return $out;
    }

    public function recalculateQuest()
    {
        Yii::log('ПЕРЕСЧЕТ БРОНИРОВАНИЯ С УЧЕТОМ РЕЗЕРВА', 'profile', 'turn');
        $shifts = SiteService::getShifts();
        $reserve = Yii::app()->db->createCommand()
            ->select('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27')
            ->from('{{questionnaire_rezerv}}')
            ->where('id=1')
            ->queryRow();

        foreach ($shifts as $shiftId => $s) {
            SiteService::turnUp($s, $reserve['srez_' . $s['id']]);
        }
    }

    public function campsTimeLeft($time)
    {
        $t = strtotime($time);
        if ((int)date("Hi") == (int)date("Hi", $t)) {
            $result = Yii::app()->db->createCommand()
                ->select('id')
                ->from('{{user}}')
                ->where('role=:role', array('role' =>  User::ROLE_ADMIN))
                ->queryAll();

           User::model()->updateAll(array('role' => User::ROLE_USER) , 'role=:role', array(':role' => User::ROLE_ADMIN));

            return $result;
        }

        return [];
    }
}