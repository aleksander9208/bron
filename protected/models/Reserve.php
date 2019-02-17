<?php

class Reserve extends CActiveRecord
{
    public $error_str;
    public $error_arr = array();

    private $changedAttr = array();

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{questionnaire_rezerv}}';
    }

    public function rules()
    {
        return array(
            array('id', 'unique'),
            array('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27', 'required'),
            array('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27', 'numerical', 'integerOnly' => true),
            array('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27', 'safe'),
            array('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27', 'validateReserv')

        );
    }

    public function attributeLabels()
    {
        return array(
            'srez_1' => 'Резерв смены 1',
            'srez_2' => 'Резерв смены 2',
            'srez_3' => 'Резерв смены 3',
            'srez_4' => 'Резерв смены 4',
            'srez_5' => 'Резерв смены 5',
            'srez_6' => 'Резерв смены 1',
            'srez_7' => 'Резерв смены 2',
            'srez_8' => 'Резерв смены 3',
            'srez_9' => 'Резерв смены 4',
            'srez_10' => 'Резерв смены 1',
            'srez_11' => 'Резерв смены 2',
            'srez_12' => 'Резерв смены 3',
            'srez_13' => 'Резерв смены 1',
            'srez_14' => 'Резерв смены 2',
            'srez_15' => 'Резерв смены 3',
            'srez_16' => 'Резерв смены 4',
            'srez_17' => 'Резерв смены 1',
            'srez_18' => 'Резерв смены 2',
            'srez_19' => 'Резерв смены 3',
            'srez_20' => 'Резерв смены 4',
            'srez_21' => 'Резерв смены 1',
            'srez_22' => 'Резерв смены 2',
            'srez_23' => 'Резерв смены 3',
            'srez_24' => 'Резерв смены 1',
            'srez_25' => 'Резерв смены 2',
            'srez_26' => 'Резерв смены 3',
            'srez_27' => 'Резерв смены 4',
        );
    }

    public function safeAttributes()
    {
        return array(
            'srez_1',
            'srez_2',
            'srez_3',
            'srez_4',
            'srez_5',
            'srez_6',
            'srez_7',
            'srez_8',
            'srez_9',
            'srez_10',
            'srez_11',
            'srez_12',
            'srez_13',
            'srez_14',
            'srez_15',
            'srez_16',
            'srez_17',
            'srez_18',
            'srez_19',
            'srez_20',
            'srez_21',
            'srez_22',
            'srez_23',
            'srez_24',
            'srez_25',
            'srez_26',
            'srez_27'
        );
    }

    public function validateReserv($attribute)
    {
        $shifts = SiteService::getShifts();
        list($pref, $shiftId) = explode('_', $attribute);
        if (!isset($shifts[$shiftId])) {
            $this->addError($attribute, 'Указана несуществующая смена');
            return false;
        }
        if ($this->$attribute > $shifts[$shiftId]['seats']) {
            $this->addError($attribute, 'Нельзя резервироть мест больше чем доступно изначально');
            return false;
        }
        $cq = Questionnaire::model()->countByAttributes(array('shift_id' => $shiftId, 'status' => Questionnaire::STATUS_OK, 'is_main' => 1));
        if ($this->$attribute < $cq) {
            $this->addError($attribute, 'Нельзя выставить размер резерва меньше коичества уже зарезервированных заявок');
            return false;
        }
        $cqnormal = Questionnaire::model()->countByAttributes(array('shift_id' => $shiftId, 'status' => Questionnaire::STATUS_OK, 'is_main' => 0), 'booking_id IS NOT NULL');
        if ($this->$attribute > ($shifts[$shiftId]['seats'] - $cqnormal)) {
            $this->addError($attribute, 'Нельзя выставить размер резерва больше доступных свободных мест' . ($shifts[$shiftId]['seats'] - $cqnormal));
            return false;
        }

        if (!$this->getError($attribute) && isset($this->changedAttr[$attribute]) && ($this->changedAttr[$attribute] != $this->$attribute) && ($this->$attribute < $this->changedAttr[$attribute])) {
            $cqnormal = Questionnaire::model()->countByAttributes(array('shift_id' => $shiftId, 'status' => Questionnaire::STATUS_OK, 'is_main' => 0), 'booking_id IS NOT NULL');
            $cnt = ($shifts[$shiftId]['seats'] - $this->$attribute - $cqnormal);

            for ($i = 1; $i <= $cnt; $i++) {
                $result = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('{{questionnaire}}')
                    ->where('shift_id=:shift AND status=:st AND booking_id IS NULL', array('shift' => $shiftId, 'st' => Questionnaire::STATUS_OK))
                    ->order('is_main DESC, created ASC')
                    ->queryRow();
                if ($result) {
                    $n = 1;
                    do {
                        $booking_id = Questionnaire::getPref($shiftId) . $n;
                        if (!Questionnaire::model()->countByAttributes(array('booking_id' => $booking_id))) {
                            break;
                        }
                        $n++;
                    } while (true);
                    Yii::app()->db->createCommand()->update('{{questionnaire}}', array('booking_id' => $booking_id), 'id=:id', array(':id' => $result['id']));
                }
            }
        }

        return true;
    }


    public function beforeValidate()
    {
        if ($this->isNewRecord) {

        }

        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        if ($this->getErrors()) {
            foreach ($this->getErrors() as $n) {
                foreach ($n as $e) {
                    $this->error_arr[] = $e;
                }
            }
            $this->error_str = implode('.', $this->error_arr);
        }

        return parent::afterValidate();
    }

    public static function getReserveData()
    {
        return Yii::app()->db->createCommand()
            ->select('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27')
            ->from('{{questionnaire_rezerv}}')
            ->where('id=1')
            ->queryRow();
    }

    public function __set($var, $value)
    {
        if (in_array($var, $this->safeAttributes()) && !array_key_exists($var, $this->changedAttr)) {
            $this->changedAttr[$var] = $this->$var;
        }

        parent::__set($var, $value);
    }
}