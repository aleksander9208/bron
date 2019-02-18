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
            ->select('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27')
            ->from('{{questionnaire_rezerv}}')
            ->where('id=1')
            ->queryRow();

        foreach ($shifts as $s) {
            $out[$s['id']] = array('all_seats' => $s['seats'], 'free_seats' => 0, 'seats' => $reserve['srez_' . $s['id']]);
        }
        $result = Yii::app()->db->createCommand()
            ->select('COUNT(id) as cnt,shift_id ')
            ->from('{{questionnaire}}')
            ->where('status=:status ', array('status' => Questionnaire::STATUS_OK))
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
        $out = array(
            Questionnaire::SHIFT_KIROVEC_1 => array(
                'id' => Questionnaire::SHIFT_KIROVEC_1,
                'camp' => Questionnaire::CAMP_KIROVEC,
                'seats' => 192,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_1
                )
            ),
            Questionnaire::SHIFT_KIROVEC_2 => array(
                'id' => Questionnaire::SHIFT_KIROVEC_2,
                'camp' => Questionnaire::CAMP_KIROVEC,
                'seats' => 192,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_KIROVEC_3 => array(
                'id' => Questionnaire::SHIFT_KIROVEC_3,
                'camp' => Questionnaire::CAMP_KIROVEC,
                'seats' => 192,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_4,
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_KIROVEC_4 => array(
                'id' => Questionnaire::SHIFT_KIROVEC_4,
                'camp' => Questionnaire::CAMP_KIROVEC,
                'seats' => 192,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_KIROVEC_5 => array(
                'id' => Questionnaire::SHIFT_KIROVEC_5,
                'camp' => Questionnaire::CAMP_KIROVEC,
                'seats' => 192,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_8
                )
            ),
            Questionnaire::SHIFT_BLUESCREEN_1 => array(
                'id' => Questionnaire::SHIFT_BLUESCREEN_1,
                'camp' => Questionnaire::CAMP_BLUESCREEN,
                'seats' => 112,
                'min_age' => 6,
                'max_age' => 11,
                'dlo' => array(
                    Questionnaire::DLO_1
                )
            ),
            Questionnaire::SHIFT_BLUESCREEN_2 => array(
                'id' => Questionnaire::SHIFT_BLUESCREEN_2,
                'camp' => Questionnaire::CAMP_BLUESCREEN,
                'seats' => 112,
                'min_age' => 6,
                'max_age' => 11,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_BLUESCREEN_3 => array(
                'id' => Questionnaire::SHIFT_BLUESCREEN_3,
                'camp' => Questionnaire::CAMP_BLUESCREEN,
                'seats' => 112,
                'min_age' => 6,
                'max_age' => 11,
                'dlo' => array(
                    Questionnaire::DLO_4,
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_BLUESCREEN_4 => array(
                'id' => Questionnaire::SHIFT_BLUESCREEN_4,
                'camp' => Questionnaire::CAMP_BLUESCREEN,
                'seats' => 112,
                'min_age' => 6,
                'max_age' => 11,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_EAST_1 => array(
                'id' => Questionnaire::SHIFT_EAST_1,
                'camp' => Questionnaire::CAMP_EAST_4,
                'seats' => 154,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_EAST_2 => array(
                'id' => Questionnaire::SHIFT_EAST_2,
                'camp' => Questionnaire::CAMP_EAST_4,
                'seats' => 154,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_4,
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_EAST_3 => array(
                'id' => Questionnaire::SHIFT_EAST_3,
                'camp' => Questionnaire::CAMP_EAST_4,
                'seats' => 154,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_DIAMOND_1 => array(
                'id' => Questionnaire::SHIFT_DIAMOND_1,
                'camp' => Questionnaire::CAMP_DIAMOND,
                'seats' => 168,
                'min_age' => 11,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_DIAMOND_2 => array(
                'id' => Questionnaire::SHIFT_DIAMOND_2,
                'camp' => Questionnaire::CAMP_DIAMOND,
                'seats' => 168,
                'min_age' => 11,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_4,

                )
            ),
            Questionnaire::SHIFT_DIAMOND_3 => array(
                'id' => Questionnaire::SHIFT_DIAMOND_3,
                'camp' => Questionnaire::CAMP_DIAMOND,
                'seats' => 168,
                'min_age' => 11,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_DIAMOND_4 => array(
                'id' => Questionnaire::SHIFT_DIAMOND_4,
                'camp' => Questionnaire::CAMP_DIAMOND,
                'seats' => 168,
                'min_age' => 11,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_BONFIRE_1 => array(
                'id' => Questionnaire::SHIFT_BONFIRE_1,
                'camp' => Questionnaire::CAMP_BONFIRE,
                'seats' => 192,
                'min_age' => 11,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_BONFIRE_2 => array(
                'id' => Questionnaire::SHIFT_BONFIRE_2,
                'camp' => Questionnaire::CAMP_BONFIRE,
                'seats' => 192,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_4
                )
            ),
            Questionnaire::SHIFT_BONFIRE_3 => array(
                'id' => Questionnaire::SHIFT_BONFIRE_3,
                'camp' => Questionnaire::CAMP_BONFIRE,
                'seats' => 192,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_BONFIRE_4 => array(
                'id' => Questionnaire::SHIFT_BONFIRE_4,
                'camp' => Questionnaire::CAMP_BONFIRE,
                'seats' => 192,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_LIGHTHOUSE_1 => array(
                'id' => Questionnaire::SHIFT_LIGHTHOUSE_1,
                'camp' => Questionnaire::CAMP_LIGHTHOUSE,
                'seats' => 88,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_LIGHTHOUSE_2 => array(
                'id' => Questionnaire::SHIFT_LIGHTHOUSE_2,
                'camp' => Questionnaire::CAMP_LIGHTHOUSE,
                'seats' => 88,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_4,
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_LIGHTHOUSE_3 => array(
                'id' => Questionnaire::SHIFT_LIGHTHOUSE_3,
                'camp' => Questionnaire::CAMP_LIGHTHOUSE,
                'seats' => 88,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_6
                )
            ),
            Questionnaire::SHIFT_FLYGHT_1 => array(
                'id' => Questionnaire::SHIFT_FLYGHT_1,
                'camp' => Questionnaire::CAMP_FLYGHT,
                'seats' => 132,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_2
                )
            ),
            Questionnaire::SHIFT_FLYGHT_2 => array(
                'id' => Questionnaire::SHIFT_FLYGHT_2,
                'camp' => Questionnaire::CAMP_FLYGHT,
                'seats' => 132,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_3
                )
            ),
            Questionnaire::SHIFT_FLYGHT_3 => array(
                'id' => Questionnaire::SHIFT_FLYGHT_3,
                'camp' => Questionnaire::CAMP_FLYGHT,
                'seats' => 132,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_4,
                )
            ),
            Questionnaire::SHIFT_FLYGHT_4 => array(
                'id' => Questionnaire::SHIFT_FLYGHT_4,
                'camp' => Questionnaire::CAMP_FLYGHT,
                'seats' => 132,
                'min_age' => 6,
                'max_age' => 17,
                'dlo' => array(
                    Questionnaire::DLO_5
                )
            ),
        );

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
        $checked = ((in_array($shiftId, $shiftsPost)) ? true : false);
        return '' .
        '<div class="custom-control custom-switch">' .
        CHtml::checkBox('Shifts[]', $checked, array('class' => 'custom-control-input', 'id' => 'z_anketa_' . $shiftId, 'value' => $shiftId, 'data-pgroup' => $period_group)) .
        CHtml::label($shiftName, 'z_anketa_' . $shiftId, array('class' => 'custom-control-label')) .
        self::templateSeatsCount($seatsFrom, $seatsTo) .
        //'<div class="z_anketa_age">(от ' .$ageFrom . ' до ' .$ageTo . ' лет)</div>'.
        '</div>';
    }

    public static function templateSeatsCount($seatsFrom, $seatsTo)
    {
        if ($seatsFrom<$seatsTo)
            return '<div class="z_anketa_counts">'.$seatsFrom.' из '. $seatsTo.'</div>';
                else
            return '<div class="z_anketa_counts">Резерв</div>';
        //return '<div class="z_anketa_counts">' . ($seatsFrom > $seatsTo ? $seatsTo : $seatsFrom) . ' из ' . $seatsTo . ($seatsFrom > $seatsTo ? '. В резерве: ' . abs($seatsTo - $seatsFrom) : '') . '</div>';
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

}