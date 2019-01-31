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
            ->order('created ASC')
            ->limit($seats)
            ->queryRow();
        if ($full) {
            return array('incamp' => ($result['incamp'] ? true : false), 'all_seats' => $seats, 'free_seats' => (int)($seats - $result['cnt']));
        }

        return ($result['incamp'] ? true : false);
    }

    public static function getShifts()
    {
        return array(
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
    }


}