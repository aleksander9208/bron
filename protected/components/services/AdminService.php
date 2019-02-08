<?php

class AdminService
{


    public function getStatCamp()
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
        $campSeats= array();
        $shiftsData = SiteService::getShifts();
        foreach (Questionnaire::getCAMPName() as $campId => $campName) {
            $camp_reserve[$campId] = 0;
            $shifts = Questionnaire::getShiftsByParams($campId);
            foreach ($shifts as $sId) {
                $camp_reserve[$campId] += $reserve['srez_' . $sId];
                $campSeats[$campId] = $shiftsData[$sId]['seats'];
            }
            $questionnaire_main[$campId] = array();
            $questionnaire[$campId] = array();
            $result = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{questionnaire}}')
                ->where('status=:status AND camp_id=:camp AND is_main=1', array('status' => Questionnaire::STATUS_OK, 'camp' => $campId))
                ->order('created ASC')
                ->limit($campSeats[$campId])
                ->queryAll();



            foreach ($result as $r) {
                if ($reserve['srez_' . $r['shift_id']] > count($questionnaire_main[$r['camp_id']][$r['shift_id']])) {
                    $questionnaire_main[$r['camp_id']][$r['shift_id']][] = $r;
                    $ids[$r['camp_id']][] = $r['id'];
                }
            }
            $result = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{questionnaire}}')
                ->where('status=:status AND camp_id=:camp AND is_main=0', array('status' => Questionnaire::STATUS_OK, 'camp' => $campId))
                ->order('created ASC')
                ->limit($campSeats[$campId])
                ->queryAll();

            foreach ($result as $r) {
                $cntQuestnMain = (int)(isset($questionnaire_main[$r['camp_id']][$r['shift_id']]) ? count($questionnaire_main[$r['camp_id']][$r['shift_id']]) : 0);
                $cntQuestn = (int)(isset($questionnaire[$r['camp_id']][$r['shift_id']]) ? count($questionnaire[$r['camp_id']][$r['shift_id']]) : 0);
                if ($campSeats[$campId] > ($cntQuestnMain + $cntQuestn)) {
                    $questionnaire[$r['camp_id']][$r['shift_id']][] = $r;
                    $ids[$r['camp_id']][] = $r['id'];
                }
            }


        }

        $reserve =array();
        return array('questionnaire_main' => $questionnaire_main, 'questionnaire' => $questionnaire, 'reserve' => $reserve, 'camp_reserve' => $camp_reserve);
    }


}