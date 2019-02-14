<?php

class Questionnaire extends CActiveRecord
{
    const STATUS_IN_MODER = 0;
    const STATUS_RETURNED = 1;
    const STATUS_OK = 2;
    const STATUS_CANCELED = 3;

    const TYPE_FIZ = 0;
    const TYPE_UR = 1;

    const CAMP_KIROVEC = 1; //кировец
    const CAMP_BLUESCREEN = 2; // голубой экран
    const CAMP_EAST_4 = 3;// восток 4
    const CAMP_DIAMOND = 4; //алмаз
    const CAMP_BONFIRE = 5; // костер
    const CAMP_LIGHTHOUSE = 6; //маяк
    const CAMP_FLYGHT = 7; //полет


    const SHIFT_KIROVEC_1 = 1;
    const SHIFT_KIROVEC_2 = 2;
    const SHIFT_KIROVEC_3 = 3;
    const SHIFT_KIROVEC_4 = 4;
    const SHIFT_KIROVEC_5 = 5;
    const SHIFT_BLUESCREEN_1 = 6;
    const SHIFT_BLUESCREEN_2 = 7;
    const SHIFT_BLUESCREEN_3 = 8;
    const SHIFT_BLUESCREEN_4 = 9;
    const SHIFT_EAST_1 = 10;
    const SHIFT_EAST_2 = 11;
    const SHIFT_EAST_3 = 12;
    const SHIFT_DIAMOND_1 = 13;
    const SHIFT_DIAMOND_2 = 14;
    const SHIFT_DIAMOND_3 = 15;
    const SHIFT_DIAMOND_4 = 16;
    const SHIFT_BONFIRE_1 = 17;
    const SHIFT_BONFIRE_2 = 18;
    const SHIFT_BONFIRE_3 = 19;
    const SHIFT_BONFIRE_4 = 20;
    const SHIFT_LIGHTHOUSE_1 = 21;
    const SHIFT_LIGHTHOUSE_2 = 22;
    const SHIFT_LIGHTHOUSE_3 = 23;
    const SHIFT_FLYGHT_1 = 24;
    const SHIFT_FLYGHT_2 = 25;
    const SHIFT_FLYGHT_3 = 26;
    const SHIFT_FLYGHT_4 = 27;

    const DLO_1 = 1;
    const DLO_2 = 2;
    const DLO_3 = 3;
    const DLO_4 = 4;
    const DLO_5 = 5;
    const DLO_6 = 6;
    const DLO_7 = 7;
    const DLO_8 = 8;

    public $fromDate, $toDate;
    public $error_str;
    public $error_arr = array();
    public $camp_id = 0;
    public $shift_name;


    private $changedAttr = array();

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{questionnaire}}';
    }

    public function rules()
    {
        return array(
            array('id', 'unique'),
            array('fio_child', 'validateChild'),
            array('created,fio_child,birthday_child,place_of_study,status,type, fio_parent,residence,place_of_work,tel_parent,email_parent,shift_id', 'required'),
            array('shift_id', 'validateShift'),
            // array('fio_parent,residence,place_of_work,tel_parent,email_parent', 'required', 'on' => 'fl'),
            array('name_ur,fio_ur_contact,tel_ur_contact,email_ur_contact', 'required', 'on' => 'ur'),
            array('booking_id', 'required', 'on' => 'booking'),
            array('booking_id', 'validateBooking'),
            array('is_main', 'validateIsMain'),
            array('user_id', 'validateUser'),
            array('birthday_child', 'validateBirthday'),
            array('name_ur,fio_ur_contact,email_ur_contact,fio_parent,email_parent,fio_child,place_of_study', 'length', 'max' => 255),
            array('residence,place_of_work', 'length', 'max' => 255),
            array('status', 'in', 'range' => array_keys(self::getStatusName())),
            array('type', 'in', 'range' => array(self::TYPE_FIZ, self::TYPE_UR)),
            array('status', 'validateStatus'),
            array('paid,create_admin,name_ur_check,fio_ur_contact_check,tel_ur_contact_check,email_ur_contact_check,fio_parent_check,residence_check,place_of_work_check,tel_parent_check,email_parent_check,fio_child_check,birthday_child_check,place_of_study_check', 'in', 'range' => array(0, 1)),
            array('is_main,shift_name,camp_id, fromDate,toDate, type, fio_parent,residence,place_of_work,tel_parent,email_parent,fio_child,birthday_child,place_of_study,name_ur,fio_ur_contact,tel_ur_contact,email_ur_contact', 'safe'),
            array('booking_id,paid,comment,name_ur_check,fio_ur_contact_check,tel_ur_contact_check,email_ur_contact_check,fio_parent_check,residence_check,place_of_work_check,tel_parent_check,email_parent_check,fio_child_check,birthday_child_check,place_of_study_check,status,paid,create_admin', 'safe', 'on' => 'mod'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'type' => 'Тип заявителя',
            'user_id' => 'Пользователь',
            'created' => 'Дата подачи',
            'name_ur' => 'Название юридического лица',
            'fio_ur_contact' => 'Ф.И.О. контактного лица',
            'tel_ur_contact' => 'Телефон контактного лица',
            'email_ur_contact' => 'E-mail контактного лица',

            'fio_parent' => 'Ф.И.О. родителя',
            'residence' => 'Место жительства по регистрации',
            'place_of_work' => 'Место работы',
            'tel_parent' => 'Телефон родителя/опекуна',
            'email_parent' => 'E-mail родителя/опекуна',

            'fio_child' => 'Ф.И.О. ребенка',
            'birthday_child' => 'Дата рождения ребенка',
            'place_of_study' => 'Место учебы ребенка',

            'shift_id' => 'Смена',
            'comment' => 'Комментарий',
            'paid' => 'Выкуплена',
            'create_admin' => 'Создана админом',
            'camp_id' => 'Лагерь',
            'booking_id' => 'Номер брони',
            'dlo_id' => 'Период',
            'is_main' => 'Зарезервирован'
        );
    }

    public function safeAttributes()
    {
        return array(
            'fio_parent',
            'residence',
            'place_of_work',
            'tel_parent',
            'email_parent',
            'fio_child',
            'birthday_child',
            'place_of_study',
            'name_ur',
            'fio_ur_contact',
            'tel_ur_contact',
            'email_ur_contact',
            'type',
            'fromDate',
            'toDate',
            'camp_id',
            'booking_id',
            'shift_name',
            'is_main'
        );
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->status = self::STATUS_IN_MODER;
            $this->is_main = 0;
            $this->booking_id = null;
            if (is_null($this->created)) {
                $this->created = date('Y-m-d H:i:s');
            }
            if ($this->type == self::TYPE_UR) {
                $this->scenario = 'ur';
            } else {
                $this->scenario = 'fl';
                $this->name_ur = $this->fio_ur_contact = $this->tel_ur_contact = $this->email_ur_contact = null;
            }
            if (!Yii::app()->user->getIsGuest() && Yii::app()->user->role != User::ROLE_ADMIN) {
                $this->user_id = (int)Yii::app()->user->id;
            }


            if (Yii::app()->user->role == User::ROLE_ADMIN) {
                $this->create_admin = 1;
            }

            if ($this->shift_id) {
                $shifts = SiteService::getShifts();
                $this->dlo_id = (int)(isset($shifts[$this->shift_id]['dlo'][0]) ? $shifts[$this->shift_id]['dlo'][0] : 0);
                $this->camp_id = self::getCAMPByShift($this->shift_id);
            }

        } elseif ($this->scenario == 'mod') {
            if (isset($this->changedAttr['status']) && ($this->changedAttr['status'] != $this->status) && ($this->status == self::STATUS_OK)) {
                if (is_null($this->booking_id)) {
                    $shifts = SiteService::getShifts();
                    if (Questionnaire::model()->countByAttributes(array('shift_id' => $this->shift_id, 'status' => self::STATUS_OK)) < $shifts[$this->shift_id]['seats']) {
                        $n = 1;
                        do {
                            $this->booking_id = $this->getPref($this->shift_id) . $n;
                            if (!Questionnaire::model()->countByAttributes(array('booking_id' => $this->booking_id))) {
                                break;
                            }
                            $n++;
                        } while (true);
                    }
                }
                $this->name_ur_check = 0;
                $this->fio_ur_contact_check = 0;
                $this->tel_ur_contact_check = 0;
                $this->email_ur_contact_check = 0;
                $this->fio_parent_check = 0;
                $this->residence_check = 0;
                $this->place_of_work_check = 0;
                $this->tel_parent_check = 0;
                $this->email_parent_check = 0;
                $this->fio_child_check = 0;
                $this->birthday_child_check = 0;
                $this->place_of_study_check = 0;
            }
        } elseif ($this->scenario == 'user_up') { //исправление ошибок пользователем или отменой заявки
            if (isset($this->changedAttr['status']) && ($this->changedAttr['status'] != $this->status) && ($this->status == self::STATUS_IN_MODER)) {
                $this->name_ur_check = 0;
                $this->fio_ur_contact_check = 0;
                $this->tel_ur_contact_check = 0;
                $this->email_ur_contact_check = 0;
                $this->fio_parent_check = 0;
                $this->residence_check = 0;
                $this->place_of_work_check = 0;
                $this->tel_parent_check = 0;
                $this->email_parent_check = 0;
                $this->fio_child_check = 0;
                $this->birthday_child_check = 0;
                $this->place_of_study_check = 0;
                $this->created = date('Y-m-d H:i:s');
            }
        } else { //простое редактирование пользователем

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

    public function beforeSave()
    {
        $this->created = date('Y-m-d H:i:s', strtotime($this->created));
        $this->birthday_child = date('Y-m-d H:i:s', strtotime($this->birthday_child));

        return parent::beforeSave();
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {

        }

        return parent::afterSave();
    }

    /*public function afterFind()
    {
        $this->camp_id = self::getCAMPByShift($this->shift_id);

        return parent::afterFind();
    }*/

    public function validateUser($attribute)
    {
        if ($this->isNewRecord && !$this->$attribute) {
            $login = trim($this->type == self::TYPE_UR ? $this->fio_ur_contact : $this->fio_parent);
            $tel = ($this->type == self::TYPE_UR ? $this->tel_ur_contact : $this->tel_parent);
            Yii::log('FIND USER BY LOGIN:' . $login, 'profile', 'debug');
            $user = User::model()->findByAttributes(array('login' => $login));
            if (!$user) {
                Yii::log('NOT FOUND USER:' . $login, 'profile', 'debug');
                $u = new User();
                $u->login = $login;
                $u->password = md5($tel);
                $u->role = User::ROLE_USER;
                if (!$u->save()) {
                    $this->addError($attribute, $u->error_str);
                    Yii::log('CREATE USER ERR:' . $u->error_str, 'profile', 'debug');
                    return false;
                } else {
                    Yii::log('CREATE USER OK:' . $u->id, 'profile', 'debug');
                    $this->user_id = $u->id;
                }
            } else {
                Yii::log('FOUND USER BY LOGIN:' . $login . ' ID:' . $user->id, 'profile', 'debug');
                $this->user_id = $user->id;
            }
        }

        return true;
    }


    public function validateStatus($attribute)
    {

        if (($this->$attribute == 'user_up') && !in_array($this->$attribute, array(self::STATUS_IN_MODER, self::STATUS_CANCELED))) {
            $this->addError($attribute, 'Не верный статус заявки');
            return false;
        }

        return true;
    }

    public function validateIsMain($attribute)
    {

        if ($this->$attribute) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->status != self::STATUS_OK)) {
                $this->addError($attribute, 'Нельзя ставить в резерв не одобренные заявки');
                return false;
            }
            $change = (isset($this->changedAttr[$attribute]) && ($this->changedAttr[$attribute] != $this->$attribute));
            if ($change && !Yii::app()->user->getIsGuest() && Yii::app()->user->role != User::ROLE_ADMIN) {
                $this->$attribute = $this->changedAttr[$attribute];
                $this->addError($attribute, 'Только администратор может ');
                return false;
            }
            $reserve = Yii::app()->db->createCommand()
                ->select('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27')
                ->from('{{questionnaire_rezerv}}')
                ->where('id=1')
                ->queryRow();

            if ($reserve['srez_' . $this->shift_id] < 1) {
                $this->addError($attribute, 'Нет резерва для данной смены');
                return false;
            }


            $qr = Questionnaire::model()->countByAttributes(array('status' => self::STATUS_OK, 'shift_id' => $this->Shift_id, 'is_main' => 1));
            if ($reserve['srez_' . $this->shift_id] <= $qr) {
                $this->addError($attribute, 'Лимит резерва для данной смены исчерпан');
                return false;
            }
        }

        return true;
    }

    public function validateBirthday($attribute)
    {
        if ($this->isNewRecord && $this->$attribute) {
            $year = date("Y");
            $shifts = SiteService::getShifts();
            $age = ($year - date("Y", strtotime($this->$attribute)));
            if (($shifts[$this->shift_id]['min_age'] > $age) || ($shifts[$this->shift_id]['max_age'] < $age)) {
                $this->addError('shift_id', 'Возраст ребенка не подходит для выбранной смены');
                return false;
            }

        }

        return true;
    }

    public function validateChild($attribute)
    {
        if ($this->isNewRecord) {
            $q = Questionnaire::model()->findByAttributes(array('fio_child' => $this->$attribute, 'shift_id' => $this->shift_id));
            if ($q && ($q->status != self::STATUS_CANCELED)) {
                $this->addError($attribute, 'Заявка уже была принята ранее');
                return false;
            }
        }

        return true;
    }

    public function validateShift($attribute)
    {
        if (!$this->$attribute) {
            $this->addError($attribute, 'Невыбрана смена');

            return false;
        }
        if ($this->$attribute && !self::getCAMPByShift($this->$attribute)) {
            $this->addError($attribute, 'Указанна несуществующая смена');

            return false;
        }
        if ($this->isNewRecord) {
            $dlos = self::getDLOSByParams(false, $this->$attribute);
            foreach ($dlos as $d) {
                foreach (self::getShiftsByParams(false, $d) as $shiftId) {
                    if ($shiftId != $this->$attribute) {
                        $cq = Questionnaire::model()->countByAttributes(array('fio_child' => $this->fio_child, 'shift_id' => $shiftId), 'status!=:stat', array('stat' => Questionnaire::STATUS_CANCELED));
                        if ($cq) {
                            $this->addError($attribute, 'Заявка уже принята ранее');

                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }

    public function validateBooking($attribute)
    {

        if (!$this->isNewRecord) {
            $change = (isset($this->changedAttr[$attribute]) && ($this->changedAttr[$attribute] != $this->$attribute));
            if ($change && (Yii::app()->user->role != User::ROLE_ADMIN)) {
                $this->addError($attribute, 'Нет прав на именения номера брони');

                return false;
            }

            if ($change && Questionnaire::model()->countByAttributes(array($attribute => $this->$attribute, 'status' => self::STATUS_OK))) {
                $this->addError($attribute, 'Такой номер брони уже был задан ранее');

                return false;
            }

        }

        return true;
    }

    public function validateDlo($attribute)
    {
        $dlos = self::getDLOName();

        if (!isset($dlos[$this->$attribute])) {
            $this->addError($attribute, 'Указанна несуществующий период');

            return false;
        }

        $dlos = self::getDLOSByParams(false, $this->$attribute);
        if (in_array($this->$attribute, $dlos)) {
            $this->addError($attribute, 'Указанна несуществующий период для выбранной смены');

            return false;
        }

        return true;
    }

    public static function getStatusName($status = false)
    {
        $arr = array(
            self::STATUS_IN_MODER => 'На модерации',
            self::STATUS_RETURNED => 'На доработке',
            self::STATUS_OK => 'Одобрен',
            self::STATUS_CANCELED => 'Отменена заявителем',
        );
        if (is_numeric($status)) {
            if (array_key_exists($status, $arr)) {
                return $arr[$status];
            }
            return $status;
        }
        return $arr;
    }

    public static function getTypeName($type = false)
    {
        $arr = array(
            self::TYPE_FIZ => 'Физическое лицо',
            self::TYPE_UR => 'Юридическое лицо',
        );
        if (is_numeric($type)) {
            if (array_key_exists($type, $arr)) {
                return $arr[$type];
            }
            return $type;
        }
        return $arr;
    }

    public static function getCAMPName($campID = false)
    {
        $arr = array(
            self::CAMP_KIROVEC => '«Кировец»',
            self::CAMP_BLUESCREEN => '«Голубой экран»',
            self::CAMP_EAST_4 => '«Восток-4»',
            self::CAMP_DIAMOND => '«Алмаз»',
            self::CAMP_BONFIRE => '«Костер»',
            self::CAMP_LIGHTHOUSE => '«Маяк»',
            self::CAMP_FLYGHT => '«Полет»',
        );
        if (is_numeric($campID)) {
            if (array_key_exists($campID, $arr)) {
                return $arr[$campID];
            }
            return $campID;
        }
        return $arr;
    }

    public static function getCAMPByShift($shiftId)
    {
        switch ($shiftId) {
            case self::SHIFT_KIROVEC_1:
            case self::SHIFT_KIROVEC_2:
            case self::SHIFT_KIROVEC_3:
            case self::SHIFT_KIROVEC_4:
            case self::SHIFT_KIROVEC_5:
                return self::CAMP_KIROVEC;
                break;
            case self::SHIFT_BLUESCREEN_1:
            case self::SHIFT_BLUESCREEN_2:
            case self::SHIFT_BLUESCREEN_3:
            case self::SHIFT_BLUESCREEN_4:
                return self::CAMP_BLUESCREEN;
                break;
            case self::SHIFT_EAST_1:
            case self::SHIFT_EAST_2:
            case self::SHIFT_EAST_3:
                return self::CAMP_EAST_4;
                break;
            case self::SHIFT_DIAMOND_1:
            case self::SHIFT_DIAMOND_2:
            case self::SHIFT_DIAMOND_3:
            case self::SHIFT_DIAMOND_4:
                return self::CAMP_DIAMOND;
                break;
            case self::SHIFT_BONFIRE_1:
            case self::SHIFT_BONFIRE_2:
            case self::SHIFT_BONFIRE_3:
            case self::SHIFT_BONFIRE_4:
                return self::CAMP_BONFIRE;
                break;
            case self::SHIFT_LIGHTHOUSE_1:
            case self::SHIFT_LIGHTHOUSE_2:
            case self::SHIFT_LIGHTHOUSE_3:
                return self::CAMP_LIGHTHOUSE;
                break;
            case self::SHIFT_FLYGHT_1:
            case self::SHIFT_FLYGHT_2:
            case self::SHIFT_FLYGHT_3:
            case self::SHIFT_FLYGHT_4:
                return self::CAMP_FLYGHT;
                break;
            default:
                return 0;
        }
    }

    public static function geShiftIdsByCampId($campId)
    {
        switch ($campId) {
            case self::CAMP_KIROVEC:
                return array();
                break;

            case self::SHIFT_KIROVEC_1:
            case self::SHIFT_KIROVEC_2:
            case self::SHIFT_KIROVEC_3:
            case self::SHIFT_KIROVEC_4:
            case self::SHIFT_KIROVEC_5:
                return self::CAMP_KIROVEC;
                break;
            case self::SHIFT_BLUESCREEN_1:
            case self::SHIFT_BLUESCREEN_2:
            case self::SHIFT_BLUESCREEN_3:
            case self::SHIFT_BLUESCREEN_4:
                return self::CAMP_BLUESCREEN;
                break;
            case self::SHIFT_EAST_1:
            case self::SHIFT_EAST_2:
            case self::SHIFT_EAST_3:
                return self::CAMP_EAST_4;
                break;
            case self::SHIFT_DIAMOND_1:
            case self::SHIFT_DIAMOND_2:
            case self::SHIFT_DIAMOND_3:
            case self::SHIFT_DIAMOND_4:
                return self::CAMP_DIAMOND;
                break;
            case self::SHIFT_BONFIRE_1:
            case self::SHIFT_BONFIRE_2:
            case self::SHIFT_BONFIRE_3:
            case self::SHIFT_BONFIRE_4:
                return self::CAMP_BONFIRE;
                break;
            case self::SHIFT_LIGHTHOUSE_1:
            case self::SHIFT_LIGHTHOUSE_2:
            case self::SHIFT_LIGHTHOUSE_3:
                return self::CAMP_LIGHTHOUSE;
                break;
            case self::SHIFT_FLYGHT_1:
            case self::SHIFT_FLYGHT_2:
            case self::SHIFT_FLYGHT_3:
            case self::SHIFT_FLYGHT_4:
                return self::CAMP_FLYGHT;
                break;
            default:
                return 0;
        }
    }

    public static function getShiftName($shiftId)
    {
        switch ($shiftId) {
            case self::SHIFT_KIROVEC_1:
            case self::SHIFT_BLUESCREEN_1:
            case self::SHIFT_EAST_1:
            case self::SHIFT_DIAMOND_1:
            case self::SHIFT_BONFIRE_1:
            case self::SHIFT_LIGHTHOUSE_1:
            case self::SHIFT_FLYGHT_1:
                return 'Смена 1';
                break;
            case self::SHIFT_KIROVEC_2:
            case self::SHIFT_BLUESCREEN_2:
            case self::SHIFT_EAST_2:
            case self::SHIFT_DIAMOND_2:
            case self::SHIFT_BONFIRE_2:
            case self::SHIFT_LIGHTHOUSE_2:
            case self::SHIFT_FLYGHT_2:
                return 'Смена 2';
                break;
            case self::SHIFT_KIROVEC_3:
            case self::SHIFT_BLUESCREEN_3:
            case self::SHIFT_EAST_3:
            case self::SHIFT_DIAMOND_3:
            case self::SHIFT_BONFIRE_3:
            case self::SHIFT_LIGHTHOUSE_3:
            case self::SHIFT_FLYGHT_3:
                return 'Смена 3';
                break;
            case self::SHIFT_KIROVEC_4:
            case self::SHIFT_BLUESCREEN_4:
            case self::SHIFT_DIAMOND_4:
            case self::SHIFT_BONFIRE_4:
            case self::SHIFT_FLYGHT_4:
                return 'Смена 4';
                break;
            case self::SHIFT_KIROVEC_5:
                return 'Смена 5';
                break;
            default:
                return '';
        }
    }


    public static function getShiftsByParams($campId = false, $dloId = false, $full = false, $age = false)
    {
        $out = array();
        $shifts = SiteService::getShifts();
        foreach ($shifts as $shiftId => $s) {
            if (is_numeric($campId) && $s['camp'] != $campId) {
                continue;
            }
            if (is_numeric($age) && ($s['min_age'] > $age) && ($s['max_age'] < $age)) {
                continue;
            }
            if (is_numeric($dloId) && !in_array($dloId, $s['dlo'])) {
                continue;
            }
            if ($full) {
                $out[] = $s;
            } else {
                $out[] = $shiftId;
            }

        }
        return $out;
    }

    public static function getCampsByParams($shiftId = false, $dloId = false, $age = false)
    {
        $out = array();
        $shifts = SiteService::getShifts();
        foreach ($shifts as $k => $s) {
            if (is_numeric($shiftId) && $s['id'] != $shiftId) {
                continue;
            }
            if (is_numeric($dloId) && !in_array($dloId, $s['dlo'])) {
                continue;
            }
            if (is_numeric($age) && ($s['min_age'] > $age) && ($s['max_age'] < $age)) {
                continue;
            }
            $out[] = $s['camp'];
        }

        return array_unique($out);
    }

    public static function getDLOSByParams($campId = false, $shiftId = false, $age = false)
    {
        $out = array();
        $shifts = SiteService::getShifts();
        foreach ($shifts as $k => $s) {
            if (is_numeric($campId) && $s['camp'] != $campId) {
                continue;
            }
            if (is_numeric($shiftId) && $s['id'] != $shiftId) {
                continue;
            }
            if (is_numeric($age) && ($s['min_age'] > $age) && ($s['max_age'] < $age)) {
                continue;
            }
            foreach ($s['dlo'] as $d) {
                $out[] = $d;
            }
        }

        return array_unique($out);
    }

    public static function getDLOName($dloId = false)
    {
        $arr = array(
            self::DLO_1 => '01.06-10.06',
            self::DLO_2 => '12.06-21.06',
            self::DLO_3 => '23.06-02.07',
            self::DLO_4 => '05.07-14.07',
            self::DLO_5 => '16.07-25.07',
            self::DLO_6 => '28.07-06.08',
            self::DLO_7 => '08.08-17.08',
            self::DLO_8 => '19.08-28.08',
        );
        if (is_numeric($dloId)) {
            if (array_key_exists($dloId, $arr)) {
                return $arr[$dloId];
            }
            return $dloId;
        }
        return $arr;
    }


    public function getBidList($route, $stat = false)
    {
        $criteria = new CDbCriteria;
        $sort = new CSort();
        if ($stat) {
            $sort->defaultOrder = 't.is_main DESC, t.created ASC';
            $ids = array();
            $qIds = array();
            foreach (self::getCAMPName() as $campId => $campName) {
                $shiftsIds = self::getShiftsByParams($campId);
                foreach ($shiftsIds as $s) {
                    $ids[] = $s;
                }
            }
            $result = Yii::app()->db->createCommand()
                ->select('id, shift_id, is_main')
                ->from('{{questionnaire}}')
                ->where(array('in', 'shift_id', $ids))
                ->andWhere('status=:status', array('status' => Questionnaire::STATUS_OK))
                ->order('is_main DESC, created ASC')
                ->queryAll();
            $reserve = Yii::app()->db->createCommand()
                ->select('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27')
                ->from('{{questionnaire_rezerv}}')
                ->where('id=1')
                ->queryRow();
            $shifts = SiteService::getShifts();
            foreach ($shifts as $sId => $s) {
                $cnt[$s['id']] = 0;
            }
            foreach ($result as $r) {
                if ($r['is_main']) {
                    $reserve['srez_' . (int)$r['shift_id']] -= 1;
                    $qIds[] = $r['id'];
                } else {
                    $cnt[$r['shift_id']] += 1;
                }
                if ($shifts[$r['shift_id']]['seats'] >= (int)($reserve['srez_' . (int)$r['shift_id']] + $cnt[$r['shift_id']])) {
                    $qIds[] = $r['id'];

                }
            }

            $criteria->addInCondition('t.id', $qIds);

        } else {
            $sort->defaultOrder = 't.id DESC';
        }
        $sort->route = $route;

        if (is_numeric($this->id)) {
            $criteria->compare('t.id', $this->id);
        }

        if (is_numeric($this->type)) {
            $criteria->compare('t.type', $this->type);
        }
        if (is_numeric($this->status)) {
            $criteria->compare('t.status', $this->status);
        }
        if (is_numeric($this->user_id)) {
            $criteria->compare('t.user_id', $this->user_id);
        }
        if (is_numeric($this->paid)) {
            $criteria->compare('t.paid', $this->paid);
        }

        if (is_numeric($this->shift_name)) {
            switch ($this->shift_name) {
                case 1:
                    $criteria->addInCondition('t.shift_id', array(self::SHIFT_KIROVEC_1, self::SHIFT_BLUESCREEN_1, self::SHIFT_EAST_1, self::SHIFT_DIAMOND_1, self::SHIFT_BONFIRE_1, self::SHIFT_LIGHTHOUSE_1, self::SHIFT_FLYGHT_1));
                    break;
                case 2:
                    $criteria->addInCondition('t.shift_id', array(self::SHIFT_KIROVEC_2, self::SHIFT_BLUESCREEN_2, self::SHIFT_EAST_2, self::SHIFT_DIAMOND_2, self::SHIFT_BONFIRE_2, self::SHIFT_LIGHTHOUSE_2, self::SHIFT_FLYGHT_2));
                    break;
                case 3:
                    $criteria->addInCondition('t.shift_id', array(self::SHIFT_KIROVEC_3, self::SHIFT_BLUESCREEN_3, self::SHIFT_EAST_3, self::SHIFT_DIAMOND_3, self::SHIFT_BONFIRE_3, self::SHIFT_LIGHTHOUSE_3, self::SHIFT_FLYGHT_3));
                    break;
                case 4:
                    $criteria->addInCondition('t.shift_id', array(self::SHIFT_KIROVEC_4, self::SHIFT_BLUESCREEN_4, self::SHIFT_DIAMOND_4, self::SHIFT_BONFIRE_4, self::SHIFT_FLYGHT_4));
                    break;
                case 5:
                    $criteria->addInCondition('t.shift_id', array(self::SHIFT_KIROVEC_5));
                    break;
            }
        }

        if (is_numeric($this->camp_id) && $this->camp_id) {
            $criteria->compare('t.camp_id', $this->camp_id);
        }

        if (is_null($this->fromDate)) {
            $this->fromDate = '01-01-2019';//date('Y-m-d', '2016-01-01');
        }

        if (is_null($this->toDate)) {
            $this->toDate = date('d-m-Y');
        }
        if (is_numeric($this->create_admin)) {
            $criteria->compare('t.create_admin', $this->create_admin);
        }


        $rev_data_start = implode('-', array_reverse(explode('-', $this->fromDate)));
        $rev_data_end = implode('-', array_reverse(explode('-', $this->toDate)));
        $criteria->addCondition(array('t.created >=:start', 't.created<=:end'));
        $criteria->params['start'] = date('Y-m-d 00:00:00', strtotime($rev_data_start));
        $criteria->params['end'] = date('Y-m-d 23:59:59', strtotime($rev_data_end));

        $criteria->compare('t.fio_child', $this->fio_child, true);
        $criteria->compare('t.fio_ur_contact', $this->fio_ur_contact, true);
        $criteria->compare('t.fio_parent', $this->fio_parent, true);
        $criteria->compare('t.tel_parent', $this->tel_parent, true);
        $criteria->compare('t.booking_id', $this->booking_id, true);
         if (is_numeric($this->is_main)) {
             $criteria->compare('t.is_main', $this->is_main);
         }

        return new CActiveDataProvider('Questionnaire', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => ($stat ? 2000 : 20),
                'route' => $route,
            ),
            'sort' => $sort,
        ));
    }

    public function putData($userId)
    {
        $result = Yii::app()->db->createCommand()
            ->select('*')
            ->from('{{questionnaire}}')
            ->where('user_id=:user', array('user' => $userId))
            ->order('id DESC')
            ->queryRow();
        if ($result) {
            $this->type = $result['type'];
            if ($result['type'] == self::TYPE_FIZ) {
                $this->residence = $result['residence'];
                $this->email_parent = $result['email_parent'];
                $this->tel_parent = $result['tel_parent'];
            } else {
                $this->fio_parent = null;
            }
            $this->place_of_work = $result['place_of_work'];
            $this->name_ur = $result['name_ur'];
            $this->tel_ur_contact = $result['tel_ur_contact'];
            $this->email_ur_contact = $result['email_ur_contact'];

            if (Yii::app()->user->role==User::ROLE_ADMIN) {
                $this->fio_parent =  $this->residence = null;
                $this->email_parent = $this->tel_parent = $this->place_of_work=  null;
            }
        }
    }

    protected function getPref($shiftId)
    {
        switch ($shiftId) {
            case self::SHIFT_KIROVEC_1:
                return '1К';
                break;
            case self::SHIFT_KIROVEC_2:
                return '2К';
                break;
            case self::SHIFT_KIROVEC_3:
                return '3К';
                break;
            case self::SHIFT_KIROVEC_4:
                return '4К';
                break;
            case self::SHIFT_KIROVEC_5:
                return '5К';
                break;
            case self::SHIFT_BLUESCREEN_1:
                return '1Г';
                break;
            case self::SHIFT_BLUESCREEN_2:
                return '2Г';
                break;
            case self::SHIFT_BLUESCREEN_3:
                return '3Г';
                break;
            case self::SHIFT_BLUESCREEN_4:
                return '4Г';
                break;
            case self::SHIFT_EAST_1:
                return '1В';
                break;
            case self::SHIFT_EAST_2:
                return '1В';
                break;
            case self::SHIFT_EAST_3:
                return '1В';
                break;
            case self::SHIFT_DIAMOND_1:
                return '1А';
                break;
            case self::SHIFT_DIAMOND_2:
                return '2А';
                break;
            case self::SHIFT_DIAMOND_3:
                return '3А';
                break;
            case self::SHIFT_DIAMOND_4:
                return '4А';
                break;
            case self::SHIFT_BONFIRE_1:
                return '1КС';
                break;
            case self::SHIFT_BONFIRE_2:
                return '2КС';
                break;
            case self::SHIFT_BONFIRE_3:
                return '3КС';
                break;
            case self::SHIFT_BONFIRE_4:
                return '4КС';
                break;
            case self::SHIFT_LIGHTHOUSE_1:
                return '1М';
                break;
            case self::SHIFT_LIGHTHOUSE_2:
                return '2М';
                break;
            case self::SHIFT_LIGHTHOUSE_3:
                return '3М';
                break;
            case self::SHIFT_FLYGHT_1:
                return '1П';
                break;
            case self::SHIFT_FLYGHT_2:
                return '2П';
                break;
            case self::SHIFT_FLYGHT_3:
                return '3П';
                break;
            case self::SHIFT_FLYGHT_4:
                return '4П';
                break;
            default:
                return '';
        }
    }

    public function __set($var, $value)
    {
        if (in_array($var, array('status', 'booking_id', 'is_main')) && !array_key_exists($var, $this->changedAttr)) {
            $this->changedAttr[$var] = $this->$var;
        }

        parent::__set($var, $value);
    }

}