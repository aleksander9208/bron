<?php

class SiteService
{

    public static function checkTurn($userID, $shift, $full = false)
    {
        $shifts = SiteService::getShifts();
        $seats = (int)((isset($shifts[$shift]['seats'])) ? $shifts[$shift]['seats'] : 0);

        $result = Yii::app()->db->createCommand()
            ->select('SUM(IF(user_id=' . (int)$userID . ',1,0)) as incamp, COUNT(id) as cnt')
            ->from('{{questionnaire}}')
            ->where('((status=:status AND is_main=0) OR (is_main=1)) AND shift_id=:shift ', array('status' => Questionnaire::STATUS_OK, 'shift' => (int)$shift))
            ->order('is_main DESC, created ASC')
            ->limit($seats)
            ->queryRow();
        if ($full) {
            return array('incamp' => ($result['incamp'] ? true : false), 'all_seats' => $seats, 'free_seats' => (int)($seats - $result['cnt']), 'seats' => (int)$result['cnt']);
        }

        return ($result['incamp'] ? true : false);
    }

    public static function seatsShifts($shiftId = false)
    {
        $shifts = SiteService::getShifts();
        $out = array();
        $reserve = Yii::app()->db->createCommand()
            ->select('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27,srez_28,srez_29')
            ->from('{{questionnaire_rezerv}}')
            ->where('id=1')
            ->queryRow();

        foreach ($shifts as $s) {
            $out[$s['id']] = array('all_seats' => $s['seats'], 'free_seats' => 0, 'seats' => $reserve['srez_' . $s['id']]);
        }
        $result = Yii::app()->db->createCommand()
            ->select('COUNT(id) as cnt,shift_id ')
            ->from('{{questionnaire}}')
            ->where('status=:status AND is_main=0 AND booking_id IS NOT NULL', array('status' => Questionnaire::STATUS_OK))
            ->group('shift_id')
            ->order('is_main DESC, created ASC')
            ->queryAll();

        foreach ($result as $r) {
            $out[$r['shift_id']]['free_seats'] = (int)($out[$r['shift_id']]['all_seats'] - $r['cnt']);
            $out[$r['shift_id']]['seats'] += (int)$r['cnt'];
        }
        if (is_numeric($shiftId)) {
            return $out[$shiftId];
        }

        return $out;
    }

    public static function getShifts($campId = false)
    {
        $out = array();

        $result = Yii::app()->db->createCommand()
            ->select('*')
            ->from('sb_shifts')
            ->queryAll();

        foreach ($result as $k => $v) {
            $out[$k+1] = array(
                'id' => $k+1,
                'camp' => $result[$k]['camp'],
                'seats' => self::infoCamp((int)$result[$k]['camp'], 'seats'),
                'min_age' => self::infoCamp((int)$result[$k]['camp'], 'min_age'),
                'max_age' => self::infoCamp((int)$result[$k]['camp'], 'max_age'),
                'dlo' => array(
                    $result[$k]['dlo']
                )
            );
        }

        if ($campId) {
            foreach ($out as $shiftId => $v) {
                if ($v['camp'] != $campId) {
                    unset($out[$shiftId]);
                }
            }
        }

        return $out;
    }

    public static function templateChecker($shiftName, $shiftId, $seatsFrom, $seatsTo, $ageFrom, $ageTo, $shiftsPost, $period_group = '')
    {

        $seatsFrom = $seatsFrom + self::countSeats($shiftId);

        $checked = ((in_array($shiftId, $shiftsPost)) ? true : false);
        return '' .
        '<div class="custom-control custom-switch info_list">' .
        CHtml::checkBox('Shifts[]', $checked, array('class' => 'custom-control-input', 'id' => 'z_anketa_' . $shiftId, 'value' => $shiftId, 'data-pgroup' => $period_group)) .
        CHtml::label($shiftName, 'z_anketa_' . $shiftId, array('class' => 'custom-control-label')) .

        self::templateSeatsCount($seatsFrom, $seatsTo) .
        //'<div class="z_anketa_age">(от ' .$ageFrom . ' до ' .$ageTo . ' лет)</div>'.
        '</div>';
    }

    public static function templateSeatsCount($seatsFrom, $seatsTo, $fillReserv = null)
    {

        $proc = ($seatsFrom/$seatsTo) * 100;

        switch (round($proc)) {
            case ($proc < 50):
                $info = 'мало заявок';
                break;
            case ($proc > 50 && $proc < 120):
                $info = 'среднее количество';
                break;
            case ($proc > 120):
                $info = 'много заявок';
                break;
        }

        if ($seatsFrom<$seatsTo)
            return '<div class="z_anketa_counts">'.$seatsFrom.' из '. $seatsTo.(!is_null($fillReserv)?' [p:'.$fillReserv.']':'').'</div>';
        else
            return '<div class="z_anketa_counts">Резерв: '.$info.'</div>';
        //return '<div class="z_anketa_counts">' . ($seatsFrom > $seatsTo ? $seatsTo : $seatsFrom) . ' из ' . $seatsTo . ($seatsFrom > $seatsTo ? '. В резерве: ' . abs($seatsTo - $seatsFrom) : '') . '</div>';
    }

    public static function templateCount($seatsTo, $fillReserv = null)
    {
        return '<div class="z_anketa_counts">'.$seatsTo.(!is_null($fillReserv)?' [p:'.$fillReserv.']':'').'</div>';
    }

    public static function templateDloRange($shiftId)
    {
        $shifts = self::getShifts();
        if (isset($shifts[$shiftId])) {
            return self::templateDLOFullRangeByData($shifts[$shiftId]['dlo']);
        }
        return '';
    }

    public static function templateDLOFullRangeByData($arrDlo)
    {
        $out = array();
        if (count($arrDlo) > 1) {
            foreach ($arrDlo as $k => $d) {
                $data = Questionnaire::getDLOName($d) . ' ';
                list($from, $to) = explode('-', $data);
                $out[] = (!$k ? $from : $to);
            }
        } else {
            foreach ($arrDlo as $d) {
                $out[] = Questionnaire::getDLOName($d);
            }
        }

        return implode('-', $out);
    }

    public static function turnUp($shift, $reserve, $isMain = 0, $woId = 0)
    {
        // кол-во подтвержденных заявок по смене и НЕ ЗАРЕЗЕРВИРОВАННЫХ и ЗАБРОНИРОВАННЫХ
        $cqnormal = Questionnaire::model()->countByAttributes(array('shift_id' => $shift['id'], 'status' => Questionnaire::STATUS_OK, 'is_main' => 0), 'booking_id IS NOT NULL');

        Yii::log('кол-во подтвержденных заявок по смене и НЕ ЗАРЕЗЕРВИРОВАННЫХ и ЗАБРОНИРОВАННЫХ:' . $cqnormal.' КОЛ-ВО ЗАРЕЗЕРВИРОВАННЫХ:'.$reserve.' SHIFT_ID:'.$shift['id'].' is_main=0 status=2', 'profile', 'turn');

        //кол-во мест доступных для бронирования
        $cnt = ($shift['seats'] - $reserve - $cqnormal);
        Yii::log('кол-во мест доступных для бронирования:' . $cnt, 'profile', 'turn');
        for ($i = 1; $i <= $cnt; $i++) {
            // НЕ ЗАРЕЗЕРВИРОВАННАЯ заявка по смене и без ЗАБРОНИ
            $q = Yii::app()->db->createCommand()
                ->select('id')
                ->from('{{questionnaire}}')
                ->where('shift_id=:shift AND booking_id IS NULL', array('shift' => $shift['id']));
            if ($isMain) {
                $q->andWhere('is_main=1');
            } else {
                $q->andWhere('status=:st AND is_main=0', array('st' => Questionnaire::STATUS_OK));
            }
            if ($woId) {
                $q->andWhere('id!=:id', array(':id' => $woId));
            }
            $result = $q->order('is_main DESC, created ASC')
                ->queryRow();
            if ($result) {
                $n = 1;
                do {
                    // перебираем до первого свободного номера брани
                    $booking_id = Questionnaire::getPref($shift['id']) . $n;
                    if (!Questionnaire::model()->countByAttributes(array('booking_id' => $booking_id))) {
                        break;
                    }
                    $n++;
                } while (true);
                //назначаем первый найденный номер брони
                Yii::log('назначаем первый найденный номер брони BOOKING_ID:' . $booking_id.' questionnaire_ID:'.$result['id'], 'profile', 'turn');
                Yii::app()->db->createCommand()->update('{{questionnaire}}', array('booking_id' => $booking_id), 'id=:id', array(':id' => $result['id']));
            }
        }
    }

    public function infoCamp($camp, $info)
    {
        $result = Yii::app()->db->createCommand()
            ->select($info)
            ->from('sb_camp')
            ->where("id = $camp")
            ->queryRow();

        return $result[$info];
    }

    public function countSeats($id)
    {
        $result = Yii::app()->db->createCommand()
            ->select('shift_id')
            ->from('sb_questionnaire')
            ->where("shift_id = $id")
            ->queryAll();

        return count($result);
    }

    public function idDtoCamp($id, $dto)
    {
        $result = Yii::app()->db->createCommand()
            ->select('id')
            ->from('sb_shifts')
            ->where("camp = $id and dlo = $dto")
            ->queryRow();

        return $result['id'];
    }
}
