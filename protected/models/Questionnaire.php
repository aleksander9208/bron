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
            array('user_id,created,fio_child,birthday_child,place_of_study,status,type, fio_parent,residence,place_of_work,tel_parent,email_parent,shift_id', 'required'),
            array('shift_id', 'validateShift'),
            // array('fio_parent,residence,place_of_work,tel_parent,email_parent', 'required', 'on' => 'fl'),
            array('name_ur,fio_ur_contact,tel_ur_contact,email_ur_contact', 'required', 'on' => 'ur'),
            array('booking_id', 'required', 'on' => 'booking'),
            array('booking_id', 'validateBooking'),
            array('user_id', 'validateUser'),
            array('birthday_child', 'validateBirthday'),
            array('name_ur,fio_ur_contact,email_ur_contact,fio_parent,email_parent,fio_child,place_of_study', 'length', 'max' => 255),
            array('residence,place_of_work', 'length', 'max' => 255),
            array('status', 'in', 'range' => array_keys(self::getSatusName())),
            array('type', 'in', 'range' => array(self::TYPE_FIZ, self::TYPE_UR)),
            array('status', 'validateStatus'),
            array('paid,create_admin,name_ur_check,fio_ur_contact_check,tel_ur_contact_check,email_ur_contact_check,fio_parent_check,residence_check,place_of_work_check,tel_parent_check,email_parent_check,fio_child_check,birthday_child_check,place_of_study_check', 'in', 'range' => array(0, 1)),
            array('camp_id, fromDate,toDate, type, fio_parent,residence,place_of_work,tel_parent,email_parent,fio_child,birthday_child,place_of_study,name_ur,fio_ur_contact,tel_ur_contact,email_ur_contact', 'safe'),
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
            'booking_id' => 'Номер брони'
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
            'booking_id'
        );
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->status = self::STATUS_IN_MODER;
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
            $this->user_id = (int)Yii::app()->user->id;
            if (Yii::app()->user->role == User::ROLE_ADMIN) {
                $this->create_admin = 1;
            }

            if ($this->shift_id) {
                $shifts = SiteService::getShifts();
                $this->dlo_id = (int)(isset($shifts[$this->shift_id]['dlo'][0]) ? $shifts[$this->shift_id]['dlo'][0] : 0);
            }

        } elseif ($this->scenario == 'mod') {
            if (isset($this->changedAttr['status']) && ($this->changedAttr['status'] != $this->status) && ($this->status == self::STATUS_OK)) {
                if (is_null($this->booking_id)) {
                    $this->booking_id = hexdec(uniqid());
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

        return parent::beforeSave();
    }

    public function afterSave()
    {
        if ($this->isNewRecord) {

        }

        return parent::afterSave();
    }

    public function afterFind()
    {
        $this->camp_id = self::getCAMPByShift($this->shift_id);

        return parent::afterFind();
    }

    public function validateUser($attribute)
    {
        if ($this->isNewRecord && !$this->$attribute) {
            $login = trim($this->type == self::TYPE_UR ? $this->fio_ur_contact : $this->fio_parent);
            $tel = ($this->type == self::TYPE_UR ? $this->tel_ur_contact : $this->tel_parent);
            $user = User::model()->findByAttributes(array('login' => $login));
            if (!$user) {
                $u = new User();
                $u->login = $login;
                $u->password = md5($tel);
                $u->role = User::ROLE_USER;
                if (!$u->save()) {
                    $this->addError($attribute, $u->error_str);
                    return false;
                } else {
                    $this->user_id = $u->id;
                }
            } else {
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

    public function validateBirthday($attribute)
    {
        if ($this->isNewRecord && $this->$attribute) {
            $year = date("Y");
            /* $years = array();
             for ($i = ($year - 18); $i <= $year; $i++) {
                 $years[] = $i;
             }
             if (!in_array(date("Y", strtotime($this->$attribute)), $years)) {
                 $this->addError($attribute, 'Нельзя подать заявку на взрослого человека');
                 return false;
             }*/
            $shifts = SiteService::getShifts();
            $age = ($year - date("Y", strtotime($this->$attribute)));
            if (($shifts[$this->shift_id]['min_age'] > $age) || ($shifts[$this->shift_id]['max_age'] < $age)) {
                $this->addError($attribute, 'Возраст ребенка не подходит для выбранной смены' . $age);
                return false;
            }

        }

        return true;
    }

    public function validateChild($attribute)
    {
        if ($this->isNewRecord) {
            $cq = Questionnaire::model()->countByAttributes(array('fio_child' => $this->$attribute, 'shift_id' => $this->shift_id));
            if ($cq) {
                $this->addError($attribute, 'Указанный ребенок был ранее указан в другой заявке');
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
            $this->addError($attribute, 'Указанна несуществующая смена' . var_export($this->$attribute, true));

            return false;
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

    public static function getSatusName($status = false)
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
            self::CAMP_KIROVEC => 'Кировец',
            self::CAMP_BLUESCREEN => 'Голубой экран',
            self::CAMP_EAST_4 => 'Восток-4',
            self::CAMP_DIAMOND => 'Алмаз',
            self::CAMP_BONFIRE => 'Костер',
            self::CAMP_LIGHTHOUSE => 'Маяк',
            self::CAMP_FLYGHT => 'Полет',
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
        foreach ($shifts as $k => $s) {
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
                $out[] = $k;
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
            self::DLO_6 => '28.08-06.08',
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


    public function getBidList($route)
    {
        $sort = new CSort();
        $sort->defaultOrder = 't.id DESC';
        $sort->route = $route;
        $criteria = new CDbCriteria;
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

        if (is_numeric($this->camp_id)) {
            switch ($this->camp_id) {
                case self::CAMP_KIROVEC:
                case self::CAMP_BLUESCREEN:
                case self::CAMP_EAST_4:
                case self::CAMP_DIAMOND:
                case self::CAMP_BONFIRE:
                case self::CAMP_LIGHTHOUSE:
                case self::CAMP_FLYGHT:
                    $criteria->addInCondition('t.shift_id', self::getShiftsByParams($this->camp_id));
                    break;
            }
        }

        if (is_null($this->fromDate)) {
            $this->fromDate = '2019-01-01';//date('Y-m-d', '2016-01-01');
        }
        if (is_null($this->toDate)) {
            $this->toDate = date('Y-m-d');
        }
        $criteria->addCondition(array('t.created >=:start', 't.created<=:end'));
        $criteria->params['start'] = date('Y-m-d 00:00:00', strtotime($this->fromDate));
        $criteria->params['end'] = date('Y-m-d 23:59:59', strtotime($this->toDate));

        $criteria->compare('t.fio_child', $this->fio_child, true);
        $criteria->compare('t.fio_ur_contact', $this->fio_ur_contact, true);
        $criteria->compare('t.fio_parent', $this->fio_parent, true);
        $criteria->compare('t.tel_parent', $this->tel_parent, true);
        $criteria->compare('t.booking_id', $this->booking_id, true);

        return new CActiveDataProvider('Questionnaire', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
                'route' => $route,
            ),
            'sort' => $sort,
        ));
    }

    public function __set($var, $value)
    {
        if (in_array($var, array('status', 'booking_id')) && !array_key_exists($var, $this->changedAttr)) {
            $this->changedAttr[$var] = $this->$var;
        }

        parent::__set($var, $value);
    }

}