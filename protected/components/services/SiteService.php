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
            ->where('status=:status AND shift_id=:shift', array('status' => Questionnaire::STATUS_OK, 'shift' => (int)$shift))
            ->order('is_main DESC, created ASC')
            ->limit($seats)
            ->queryRow();
        if ($full) {
            return array('incamp' => ($result['incamp'] ? true : false), 'all_seats' => $seats, 'free_seats' => (int)($seats - $result['cnt']), 'seats' => (int)($seats - (int)($seats - $result['cnt'])));
        }

        return ($result['incamp'] ? true : false);
    }

    public static function seatsShifts($shiftId = false)
    {
        $shifts = SiteService::getShifts();
        $out = array();
        foreach ($shifts as $s) {
            $out[$s['id']] = array('all_seats' => 0, 'free_seats' => 0, 'seats' => 0);
        }
        $shifts = SiteService::getShifts();
        $result = Yii::app()->db->createCommand()
            ->select('COUNT(id) as cnt,shift_id ')
            ->from('{{questionnaire}}')
            ->where('status=:status ', array('status' => Questionnaire::STATUS_OK))
            ->group('shift_id')
            ->order('is_main DESC, created ASC')
            ->queryAll();

        foreach ($result as $r) {
            $seats = (int)((isset($shifts[$r['shift_id']]['seats'])) ? $shifts[$r['shift_id']]['seats'] : 0);
            $out[$r['shift_id']] = array('all_seats' => $seats, 'free_seats' => (int)($seats - $r['cnt']), 'seats' => (int)($seats - (int)($seats - $r['cnt'])));
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
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_1
                )
            ),
            Questionnaire::SHIFT_KIROVEC_2 => array(
                'id' => Questionnaire::SHIFT_KIROVEC_2,
                'camp' => Questionnaire::CAMP_KIROVEC,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_KIROVEC_3 => array(
                'id' => Questionnaire::SHIFT_KIROVEC_3,
                'camp' => Questionnaire::CAMP_KIROVEC,

                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_4,
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_KIROVEC_4 => array(
                'id' => Questionnaire::SHIFT_KIROVEC_4,
                'camp' => Questionnaire::CAMP_KIROVEC,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_KIROVEC_5 => array(
                'id' => Questionnaire::SHIFT_KIROVEC_5,
                'camp' => Questionnaire::CAMP_KIROVEC,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_8
                )
            ),
            Questionnaire::SHIFT_BLUESCREEN_1 => array(
                'id' => Questionnaire::SHIFT_BLUESCREEN_1,
                'camp' => Questionnaire::CAMP_BLUESCREEN,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_1
                )
            ),
            Questionnaire::SHIFT_BLUESCREEN_2 => array(
                'id' => Questionnaire::SHIFT_BLUESCREEN_2,
                'camp' => Questionnaire::CAMP_BLUESCREEN,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_BLUESCREEN_3 => array(
                'id' => Questionnaire::SHIFT_BLUESCREEN_3,
                'camp' => Questionnaire::CAMP_BLUESCREEN,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_4,
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_BLUESCREEN_4 => array(
                'id' => Questionnaire::SHIFT_BLUESCREEN_4,
                'camp' => Questionnaire::CAMP_BLUESCREEN,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_EAST_1 => array(
                'id' => Questionnaire::SHIFT_EAST_1,
                'camp' => Questionnaire::CAMP_EAST_4,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_EAST_2 => array(
                'id' => Questionnaire::SHIFT_EAST_2,
                'camp' => Questionnaire::CAMP_EAST_4,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_4,
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_EAST_3 => array(
                'id' => Questionnaire::SHIFT_EAST_3,
                'camp' => Questionnaire::CAMP_EAST_4,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_DIAMOND_1 => array(
                'id' => Questionnaire::SHIFT_DIAMOND_1,
                'camp' => Questionnaire::CAMP_DIAMOND,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_DIAMOND_2 => array(
                'id' => Questionnaire::SHIFT_DIAMOND_2,
                'camp' => Questionnaire::CAMP_DIAMOND,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_4,

                )
            ),
            Questionnaire::SHIFT_DIAMOND_3 => array(
                'id' => Questionnaire::SHIFT_DIAMOND_3,
                'camp' => Questionnaire::CAMP_DIAMOND,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_DIAMOND_4 => array(
                'id' => Questionnaire::SHIFT_DIAMOND_4,
                'camp' => Questionnaire::CAMP_DIAMOND,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_BONFIRE_1 => array(
                'id' => Questionnaire::SHIFT_BONFIRE_1,
                'camp' => Questionnaire::CAMP_BONFIRE,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_BONFIRE_2 => array(
                'id' => Questionnaire::SHIFT_BONFIRE_2,
                'camp' => Questionnaire::CAMP_BONFIRE,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_4
                )
            ),
            Questionnaire::SHIFT_BONFIRE_3 => array(
                'id' => Questionnaire::SHIFT_BONFIRE_3,
                'camp' => Questionnaire::CAMP_BONFIRE,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_BONFIRE_4 => array(
                'id' => Questionnaire::SHIFT_BONFIRE_4,
                'camp' => Questionnaire::CAMP_BONFIRE,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_6,
                    Questionnaire::DLO_7,
                )
            ),
            Questionnaire::SHIFT_LIGHTHOUSE_1 => array(
                'id' => Questionnaire::SHIFT_LIGHTHOUSE_1,
                'camp' => Questionnaire::CAMP_LIGHTHOUSE,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_2,
                    Questionnaire::DLO_3,
                )
            ),
            Questionnaire::SHIFT_LIGHTHOUSE_2 => array(
                'id' => Questionnaire::SHIFT_LIGHTHOUSE_2,
                'camp' => Questionnaire::CAMP_LIGHTHOUSE,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_4,
                    Questionnaire::DLO_5,
                )
            ),
            Questionnaire::SHIFT_LIGHTHOUSE_3 => array(
                'id' => Questionnaire::SHIFT_LIGHTHOUSE_3,
                'camp' => Questionnaire::CAMP_LIGHTHOUSE,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_6
                )
            ),
            Questionnaire::SHIFT_FLYGHT_1 => array(
                'id' => Questionnaire::SHIFT_FLYGHT_1,
                'camp' => Questionnaire::CAMP_FLYGHT,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_2
                )
            ),
            Questionnaire::SHIFT_FLYGHT_2 => array(
                'id' => Questionnaire::SHIFT_FLYGHT_2,
                'camp' => Questionnaire::CAMP_FLYGHT,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_3
                )
            ),
            Questionnaire::SHIFT_FLYGHT_3 => array(
                'id' => Questionnaire::SHIFT_FLYGHT_3,
                'camp' => Questionnaire::CAMP_FLYGHT,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
                'dlo' => array(
                    Questionnaire::DLO_4,
                )
            ),
            Questionnaire::SHIFT_FLYGHT_4 => array(
                'id' => Questionnaire::SHIFT_FLYGHT_4,
                'camp' => Questionnaire::CAMP_FLYGHT,
                'seats' => 100,
                'min_age' => 1,
                'max_age' => 18,
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

    public static function templateChecker($shiftName, $shiftId, $seatsFrom, $seatsTo, $shiftsPost, $seatsReserv=0)
    {
        $checked = ((in_array($shiftId, $shiftsPost)) ? true : false);
        return ''.
            '<div class="custom-control custom-switch">' .
                CHtml::checkBox('Shifts[]', $checked, array('class' => 'custom-control-input', 'id' => 'z_anketa_' . $shiftId, 'value' => $shiftId)) .
                CHtml::label($shiftName, 'z_anketa_' . $shiftId, array('class' => 'custom-control-label')) .
                '<div class="z_anketa_counts">'.$seatsFrom . ' из ' . $seatsTo.($seatsReserv>0?'. В резерве: '.$seatsReserv:'').'</div>'.
            '</div>';
    }


}