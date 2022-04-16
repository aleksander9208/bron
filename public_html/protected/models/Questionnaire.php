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
    const SHIFT_BLUESCREEN_1 = 5;
    const SHIFT_BLUESCREEN_2 = 6;
    const SHIFT_BLUESCREEN_3 = 7;
    const SHIFT_BLUESCREEN_4 = 8;
    const SHIFT_BLUESCREEN_5 = 20;
    const SHIFT_EAST_1 = 9;
    const SHIFT_EAST_2 = 10;
    const SHIFT_EAST_3 = 11;
    const SHIFT_EAST_4 = 28;
    const SHIFT_DIAMOND_1 = 12;
    const SHIFT_DIAMOND_2 = 13;
    const SHIFT_DIAMOND_3 = 14;
    const SHIFT_DIAMOND_4 = 15;
    const SHIFT_BONFIRE_1 = 16;
    const SHIFT_BONFIRE_2 = 17;
    const SHIFT_BONFIRE_3 = 18;
    const SHIFT_BONFIRE_4 = 19;
    //const SHIFT_BONFIRE_5 = 20;
    const SHIFT_LIGHTHOUSE_1 = 21;
    const SHIFT_LIGHTHOUSE_2 = 22;
    const SHIFT_LIGHTHOUSE_3 = 23;
    const SHIFT_LIGHTHOUSE_4 = 29;
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

    public $is_reserve; //вспомогательное поле



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
            array('created,fio_child,birthday_child,status,type, fio_parent,residence,tel_parent,shift_id', 'required'),
            //array('created,fio_child,birthday_child,place_of_study,status,type, fio_parent,residence,place_of_work,tel_parent,email_parent,shift_id', 'required'),
            array('shift_id', 'validateShift'),
            array('booking_id', 'required', 'on' => 'booking'),
            array('booking_id', 'validateBooking'),
            array('is_main', 'validateIsMain'),
            // array('fio_parent,residence,place_of_work,tel_parent,email_parent', 'required', 'on' => 'fl'),
            array('name_ur,fio_ur_contact,tel_ur_contact,email_ur_contact', 'required', 'on' => 'ur'),
            array('user_id', 'validateUser'),
            array('birthday_child', 'validateBirthday'),
            array('name_ur,fio_ur_contact,email_ur_contact,fio_parent,fio_child', 'length', 'max' => 255),
            //array('name_ur,fio_ur_contact,email_ur_contact,fio_parent,email_parent,fio_child,place_of_study', 'length', 'max' => 255),
            ///array('residence,place_of_work', 'length', 'max' => 255),
            array('residence', 'length', 'max' => 255),
            array('status', 'in', 'range' => array_keys(self::getStatusName())),
            array('type', 'in', 'range' => array(self::TYPE_FIZ, self::TYPE_UR)),
            array('status', 'validateStatus'),
            //array('paid,create_admin,name_ur_check,fio_ur_contact_check,tel_ur_contact_check,email_ur_contact_check,fio_parent_check,residence_check,place_of_work_check,tel_parent_check,email_parent_check,fio_child_check,birthday_child_check,place_of_study_check', 'in', 'range' => array(0, 1)),
            array('paid,create_admin,name_ur_check,fio_ur_contact_check,tel_ur_contact_check,email_ur_contact_check,fio_parent_check,residence_check,tel_parent_check,fio_child_check,birthday_child_check,', 'in', 'range' => array(0, 1)),
            //array('is_main,shift_name,camp_id, fromDate,toDate, type, fio_parent,residence,place_of_work,tel_parent,email_parent,fio_child,birthday_child,place_of_study,name_ur,fio_ur_contact,tel_ur_contact,email_ur_contact,comment,is_reserve', 'safe'),
            array('is_main,shift_name,camp_id, fromDate,toDate, type, fio_parent,residence,tel_parent,fio_child,birthday_child,name_ur,fio_ur_contact,tel_ur_contact,email_ur_contact,comment,is_reserve', 'safe'),
            //array('booking_id,paid,comment,name_ur_check,fio_ur_contact_check,tel_ur_contact_check,email_ur_contact_check,fio_parent_check,residence_check,place_of_work_check,tel_parent_check,email_parent_check,fio_child_check,birthday_child_check,place_of_study_check,status,paid,create_admin', 'safe', 'on' => 'mod'),
            array('booking_id,paid,comment,name_ur_check,fio_ur_contact_check,tel_ur_contact_check,email_ur_contact_check,fio_parent_check,residence_check,tel_parent_check,fio_child_check,birthday_child_check,status,paid,create_admin', 'safe', 'on' => 'mod'),
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

            'fio_parent' => 'Ф.И.О. заявителя/опекуна',
            'residence' => 'Город места жительства заявителя/опекуна',
            'code' => 'Кодовое слово',
            'ur_code' => 'Кодовое слово',
            //'place_of_work' => 'Место работы',
            'tel_parent' => 'Телефон заявителя/опекуна',
            //'email_parent' => 'E-mail родителя/опекуна',

            'fio_child' => 'Имя ребенка',
            'birthday_child' => 'Дата рождения ребенка',
            //'place_of_study' => 'Место учебы ребенка',

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
            'code',
            'ur_code',
            'residence',
            //'place_of_work',
            'tel_parent',
            //'email_parent',
            'fio_child',
            'birthday_child',
            //'place_of_study',
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
            'is_main',
            'is_reserve'
        );
    }

    public function beforeValidate()
    {
        $shifts = SiteService::getShifts();
        if ($this->isNewRecord) {
            $this->status = self::STATUS_IN_MODER;
            $this->is_main = 0;
            $this->booking_id = null;
            if (!is_null($this->fio_child)) {
                $this->fio_child = trim(preg_replace("/\s{2,}/", " ", $this->fio_child));
            }
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
                $this->dlo_id = (int)(isset($shifts[$this->shift_id]['dlo'][0]) ? $shifts[$this->shift_id]['dlo'][0] : 0);
                $this->camp_id = self::getCAMPByShift($this->shift_id);
            }

        } elseif ($this->scenario == 'mod') {
            if (isset($this->changedAttr['status']) && ($this->changedAttr['status'] != $this->status) && ($this->status == self::STATUS_OK)) {
                if (is_null($this->booking_id)) {
                    $reserve = Reserve::getReserveData();
                    $cntMainFALSE = (!$this->is_main && ((Questionnaire::model()->countByAttributes(array('shift_id' => $this->shift_id, 'status' => self::STATUS_OK, 'is_main' => 0), 'booking_id IS NOT NULL') + (int)$reserve['srez_' . $this->shift_id]) < $shifts[$this->shift_id]['seats']));
                    $cntMainTRUE = ($this->is_main && (Questionnaire::model()->countByAttributes(array('shift_id' => $this->shift_id, 'status' => self::STATUS_OK, 'is_main' => 1), 'id!=:id AND booking_id IS NOT NULL', array('id' => $this->id)) < ( int)$reserve['srez_' . $this->shift_id]));
                    //если есть свобожные места для брони то добавляем бронь
                    //ИЛИ
                    //если есть свободные места среди зарезервированных и наша заявка отмечена как зарезервированная (is_main_1)
                    if ($cntMainFALSE || $cntMainTRUE) {
                        $n = 1;
                        do {
                            $this->booking_id = self::getPref($this->shift_id) . $n;
                            if (!Questionnaire::model()->countByAttributes(array('booking_id' => $this->booking_id))) {
                                break;
                            }
                            $n++;
                        } while (true);
                        Yii::log("ЗАЯВКА (ID:".$this->id.") ОДОБРЯЕТСЯ с ПРИСВОЕНИЕМ БРОНИ:".$this->booking_id.' (shift:'.$this->shift_id.' is_main:'.$this->is_main.')', 'profile', 'turn');
                    }
                }
                $this->name_ur_check = 0;
                $this->fio_ur_contact_check = 0;
                $this->tel_ur_contact_check = 0;
                $this->email_ur_contact_check = 0;
                $this->fio_parent_check = 0;
                $this->residence_check = 0;
                //$this->place_of_work_check = 0;
                $this->tel_parent_check = 0;
                //$this->email_parent_check = 0;
                $this->fio_child_check = 0;
                $this->birthday_child_check = 0;
                //$this->place_of_study_check = 0;
            }
        } elseif ($this->scenario == 'user_up') { //исправление ошибок пользователем или отменой заявки
            if (isset($this->changedAttr['status']) && ($this->changedAttr['status'] != $this->status) && ($this->status == self::STATUS_IN_MODER)) {
                $this->name_ur_check = 0;
                $this->fio_ur_contact_check = 0;
                $this->tel_ur_contact_check = 0;
                $this->email_ur_contact_check = 0;
                $this->fio_parent_check = 0;
                $this->residence_check = 0;
                //$this->place_of_work_check = 0;
                $this->tel_parent_check = 0;
                //$this->email_parent_check = 0;
                $this->fio_child_check = 0;
                $this->birthday_child_check = 0;
                //$this->place_of_study_check = 0;
                $this->created = date('Y-m-d H:i:s');
            }

        } else { //простое редактирование пользователем

        }

        if (!$this->isNewRecord && in_array($this->scenario, array('user_up', 'mod')) && isset($this->changedAttr['status']) && ($this->changedAttr['status'] != $this->status) && ($this->status == self::STATUS_CANCELED)) { //омена заявки
            Yii::log('ОТМЕНА ЗАЯВКИ: status=4', 'profile', 'turn');
            if ($this->booking_id) {
                Yii::log('ОТМЕНА ЗАЯВКИ: ЕСТЬ БРОНЬ', 'profile', 'turn');
                if (!Yii::app()->user->getIsGuest() && Yii::app()->user->role == User::ROLE_ADMIN) {
                    $this->comment .= 'Отмена по иницативе администратора [' . date("H:i:s d-m-Y") . ']';
                    Yii::log($this->comment .' USER_ID:'.Yii::app()->user->id, 'profile', 'turn');
                }
                $this->booking_id = null;
                $queary = ($this->is_main ? 'is_main=1' : '(status=:status AND is_main=0)');
                $result = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('{{questionnaire}}')
                    ->where('status=:status AND shift_id=:shift AND (booking_id IS NULL) AND ' . $queary . ' AND id!=:id', array('status' => Questionnaire::STATUS_OK, 'shift' => (int)$this->shift_id, 'id' => $this->id))
                    ->order('is_main DESC, created ASC')
                    ->queryRow();
                if ($result) {
                    Yii::log("НАЙДЕНА ЗАЯВКА (ID:".$result['id'].") НА ПОЛУЧЕНИЕ БРОНИ (SHIFT_ID:".(int)$this->shift_id.")", 'profile', 'turn');
                    $n = 1;
                    do {
                        $booking_id = self::getPref($this->shift_id) . $n;
                        if (!Questionnaire::model()->countByAttributes(array('booking_id' => $booking_id))) {
                            break;
                        }
                        $n++;
                    } while (true);
                    Yii::log("БРОНЬ (".$booking_id.") НАЗНАЧЕНА ЗАЯВКЕ (ID:".$result['id'].") НА ПОЛУЧЕНИЕ БРОНИ (SHIFT_ID:".(int)$this->shift_id.")", 'profile', 'turn');
                    Yii::app()->db->createCommand()->update('{{questionnaire}}', array('booking_id' => $booking_id), 'id=:id', array(':id' => $result['id']));
                } else {
                    Yii::log("НЕ НАЙДЕНА ЗАЯВКА НА ПОЛУЧЕНИЕ БРОНИ (SHIFT_ID:".(int)$this->shift_id.")", 'profile', 'turn');

                    if ($this->is_main) {
                        Yii::log(" ЗАЯВКА НА ПОЛУЧЕНИЕ БРОНИ СРЕДИ ОБЫЧНЫХ ЗАЯВОК (SHIFT_ID:".(int)$this->shift_id.")", 'profile', 'turn');
                        $result = Yii::app()->db->createCommand()
                            ->select('id')
                            ->from('{{questionnaire}}')
                            ->where('status=:status AND shift_id=:shift AND (booking_id IS NULL) AND (status=:status AND is_main=0) AND id!=:id', array('status' => Questionnaire::STATUS_OK, 'shift' => (int)$this->shift_id, 'id' => $this->id))
                            ->order('is_main DESC, created ASC')
                            ->queryRow();
                        if ($result) {
                            Yii::log("НАЙДЕНА ЗАЯВКА (ID:".$result['id'].") НА ПОЛУЧЕНИЕ БРОНИ (SHIFT_ID:".(int)$this->shift_id.")", 'profile', 'turn');
                            $n = 1;
                            do {
                                $booking_id = self::getPref($this->shift_id) . $n;
                                if (!Questionnaire::model()->countByAttributes(array('booking_id' => $booking_id))) {
                                    break;
                                }
                                $n++;
                            } while (true);
                            Yii::log("БРОНЬ (".$booking_id.") НАЗНАЧЕНА ЗАЯВКЕ (ID:".$result['id'].") НА ПОЛУЧЕНИЕ БРОНИ (SHIFT_ID:".(int)$this->shift_id.")", 'profile', 'turn');
                            Yii::app()->db->createCommand()->update('{{questionnaire}}', array('booking_id' => $booking_id), 'id=:id', array(':id' => $result['id']));
                        }
                    }
                }
            }
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
        if (!$this->isNewRecord && isset($this->changedAttr['fio_parent']) && ($this->changedAttr['fio_parent'] != $this->fio_parent)) {
            Yii::app()->db->createCommand()->update('{{user}}', array('login' => $this->fio_parent, 'code' => $this->code,), 'id=:id', array(':id' => $this->user_id));
        }

        return parent::afterSave();
    }

    public function afterFind()
    {
        if ($this->status == self::STATUS_OK) {
            $this->is_reserve = ($this->booking_id ? 1 : 0);
        }

        return parent::afterFind();
    }

    public function validateUser($attribute)
    {
        if ($this->isNewRecord && !$this->$attribute) {
            $login = trim($this->type == self::TYPE_UR ? $this->fio_ur_contact : $this->fio_parent);
            $code = trim($this->code == self::TYPE_UR ? $this->ur_code : $this->code);
            $tel = ($this->type == self::TYPE_UR ? $this->tel_ur_contact : $this->tel_parent);
            Yii::log('FIND USER BY LOGIN:' . $login, 'profile', 'debug');
            $user = User::model()->findByAttributes(array('login' => $login, 'code'=> $code,));
            if (!$user) {
                Yii::log('NOT FOUND USER:' . $login, 'profile', 'debug');
                $u = new User();
                $u->login = $login;
                $u->code = $code;
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
            if ($this->isNewRecord || (!$this->isNewRecord && ($this->status != self::STATUS_OK) && $this->status != self::STATUS_CANCELED)) {
                $this->addError($attribute, 'Нельзя ставить в резерв не одобренные заявки');
                return false;
            }
            $change = (isset($this->changedAttr[$attribute]) && ($this->changedAttr[$attribute] != $this->$attribute));
            if ($change && !Yii::app()->user->getIsGuest() && Yii::app()->user->role != User::ROLE_ADMIN) {
                $this->$attribute = $this->changedAttr[$attribute];
                $this->addError($attribute, 'Только администратор может ставить в резерв');
                return false;
            }
            $reserve = Reserve::getReserveData();

            if ($reserve['srez_' . $this->shift_id] < 1) {
                $this->addError($attribute, 'Нет резерва для данной смены');
                return false;
            }


            $qr = Questionnaire::model()->countByAttributes(array('status' => self::STATUS_OK, 'shift_id' => $this->shift_id, 'is_main' => 1));
            if ($reserve['srez_' . $this->shift_id] <= $qr) {
                $this->addError($attribute, 'Лимит резерва для данной смены исчерпан');
                return false;
            }
        }

        if (!$this->isNewRecord && $this->scenario == 'up_main') {
            if (($this->status == self::STATUS_OK) && isset($this->changedAttr['is_main']) && ($this->changedAttr['is_main'] != $this->is_main)) { //если привилегировывают резервную заявку ставим при возможности ее в очеред
                $reserve = Reserve::getReserveData();
                if ($this->is_main) {
                    if (!$this->booking_id) {
                        $cq = Questionnaire::model()->countByAttributes(array('shift_id' => $this->shift_id, 'status' => self::STATUS_OK, 'is_main' => 1));
                        if ($cq < $reserve['srez_' . $this->shift_id]) {
                            $n = 1;
                            do {
                                $booking_id = self::getPref($this->shift_id) . $n;
                                if (!Questionnaire::model()->countByAttributes(array('booking_id' => $booking_id))) {
                                    break;
                                }
                                $n++;
                            } while (true);
                            $this->booking_id = $booking_id;
                        }
                    }
                } else {
                    $shifts = SiteService::getShifts();
                    $cq = Questionnaire::model()->countByAttributes(array('shift_id' => $this->shift_id, 'status' => self::STATUS_OK, 'is_main' => 0), 'booking_id IS NOT NULL');
                    if ($cq >= ($shifts[$this->shift_id]['seats'] - $reserve['srez_' . $this->shift_id])) {
                        $this->booking_id = null;
                    }
                }
            }
        }

        return true;
    }

    public function validateBirthday($attribute)
    {
        $out = true;
        if ($this->isNewRecord && $this->$attribute && $this->shift_id) {
            $out = false;
            $birthday_child = strtotime($this->$attribute);
            $shifts = SiteService::getShifts();
            $period_str = explode('-', Questionnaire::getDLOName($shifts[$this->shift_id]['dlo'][0]));
            if (count($period_str)==2)
            {
                $period_time_min = strtotime($period_str[0].'.'.(date('Y') - $shifts[$this->shift_id]['max_age'] - 1) );
                $period_time_max = strtotime($period_str[1].'.'.(date('Y') - $shifts[$this->shift_id]['min_age']) );
                $out = (
                    $birthday_child>$period_time_min &&
                    $birthday_child<=$period_time_max
                );
            }
            if ($out == false)
                $this->addError('shift_id', 'Возраст ребенка не подходит для выбранной смены');
            /*
            $year = date("Y");
            $shifts = SiteService::getShifts();
            $monthMin = sprintf("%02d", Questionnaire::getDLOMonthStart($shifts[$this->shift_id]['dlo'][0]));
            $monthMax = sprintf("%02d", Questionnaire::getDLOMonthStart($shifts[$this->shift_id]['dlo'][0],true));
            $t = strtotime($this->$attribute);
            $yearChild = date("Y", $t);
            $monthChild = date("m", $t);
            $age = ($year - $yearChild);
            $cmonth = (($age * 12) + $monthChild);
            if (((($shifts[$this->shift_id]['min_age'] * 12) + $monthMin) > $cmonth) || ((($shifts[$this->shift_id]['max_age'] * 12) + $monthMax) < $cmonth)) {
                $this->addError('shift_id', 'Возраст ребенка не подходит для выбранной смены');
                return false;
            }*/
        }

        return $out;
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
            if ($change && (Yii::app()->user->role != User::ROLE_ADMIN) && ($this->status != self::STATUS_CANCELED)) {
                $this->addError($attribute, 'Нет прав на изменения номера брони');

                return false;
            }

            if ($change && $this->$attribute && Questionnaire::model()->countByAttributes(array($attribute => $this->$attribute, 'status' => self::STATUS_OK), 'id!=:id', array('id' => $this->id))) {
                $this->addError($attribute, 'Такой номер брони уже был задан ранее');

                return false;
            }

        }
        if ($this->scenario == 'booking') {
            $change = (array_key_exists($attribute, $this->changedAttr) && ($this->changedAttr[$attribute] != $this->$attribute));
            if ($change && $this->status != self::STATUS_OK) {
                $this->addError($attribute, 'Нельзя назначтать номер брони по неодобренной заявке');

                return false;
            }

            if ($change && mb_strtolower($this->$attribute) == 'резерв') {
                $this->addError($attribute, 'Запрещено назначтать идентификатор "Резерв"');

                return false;
            }
            if (!$this->getError($attribute)) {
                $shifts = SiteService::getShifts();
                $reserve = Yii::app()->db->createCommand()
                    ->select('srez_1,srez_2,srez_3,srez_4,srez_5,srez_6,srez_7,srez_8,srez_9,srez_10,srez_11,srez_12,srez_13,srez_14,srez_15,srez_16,srez_17,srez_18,srez_19,srez_20,srez_21,srez_22,srez_23,srez_24,srez_25,srez_26,srez_27,srez_28,srez_29,srez_30,srez_31,srez_32,srez_33,srez_34,srez_35')
                    ->from('{{questionnaire_rezerv}}')
                    ->where('id=1')
                    ->queryRow();
                $cqnormal = Questionnaire::model()->countByAttributes(array('shift_id' => $this->shift_id, 'status' => Questionnaire::STATUS_OK, 'is_main' => 0), 'booking_id IS NOT NULL');
                if ($shifts[$this->shift_id]['seats'] <= ($reserve['srez_' . $this->shift_id] + $cqnormal)) {
                    $this->addError($attribute, 'Нельзя выставить номер бронирования, т.к. нет доступных свободных мест (всего выделено:' . $shifts[$this->shift_id]['seats'] . ', в резерве:' . $reserve['srez_' . $this->shift_id] . ', принятые:' . $cqnormal . ')');
                    return false;
                }
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

    public static function getStatusName($status = false, $id = false)
    {
        $arr = array(
            self::STATUS_IN_MODER => 'Ваша заявка обрабатывается',
            self::STATUS_RETURNED => 'На доработке',
            self::STATUS_OK => 'Ваш номер брони на путевку '.$id.'',
            self::STATUS_CANCELED => 'Отменена',
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

        $result = Yii::app()->db->createCommand()
            ->select('*')
            ->from('sb_camp')
            ->queryAll();

        $arr = array();

        foreach ($result as $camp) {
            $arr[$camp['id']] = $camp['camp'];
        }

        if (is_numeric($campID)) {
            if (array_key_exists($campID, $arr)) {
                return $arr[$campID];
            }
            return $campID;
        }
        return $arr;
    }

    public static function getAddress($campID = false)
    {

        $result = Yii::app()->db->createCommand()
            ->select('*')
            ->from('sb_camp')
            ->queryAll();

        $arr = array();

        foreach ($result as $camp) {
            $arr[$camp['id']] = $camp;
        }

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
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
                return 1;
                break;
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
                return 2;
                break;
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
                return 3;
                break;
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                return 4;
                break;
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
                return 5;
                break;
            case 28:
            case 29:
            case 30:
            case 31:
                return 6;
                break;
            case 32:
            case 33:
            case 34:
            case 35:
                return 7;
                break;
            default:
                return 0;
        }
    }

    public static function geShiftIdsByCampId($campId)
    {
        switch ($campId) {
            case 1:
                return array(1, 2, 3, 4, 5, 6);
                break;
            case 2:
                return array(7, 8, 9, 10, 11);
                break;
            case 3:
                return array(12, 13, 14, 15, 16);
                break;
            case 4:
                return array(17, 18, 19, 20, 21);
                break;
            case 5:
                return array(22, 23, 24, 25, 26, 27);
                break;
            case 6:
                return array(28, 29, 30, 31);
                break;
            case 7:
                return array(31, 32, 33, 34);
                break;
            default:
                return 0;
        }
    }

    public static function getShiftName($shiftId)
    {
        switch ($shiftId) {
            case 1:
            case 32:
            case 22:
            case 28:
            case 7:
            case 17:
            case 12:
                return 'Смена 1';
                break;
            case 2:
            case 33:
            case 29:
            case 23:
            case 18:
            case 13:
            case 8:
                return 'Смена 2';
                break;
            case 3:
            case 14:
            case 34:
            case 30:
            case 24:
            case 9:
                return 'Смена 3';
                break;
            case 4:
            case 20:
            case 10:
            case 25:
            case 31:
            case 35:
            case 15:
                return 'Смена 4';
                break;
            case 5:
            case 21:
            case 26:
            case 11:
            case 16:
                return 'Смена 5';
                break;
            case 27:
            case 6:
                return 'Смена 6';
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

    public static function getDLOName($dloId = false, $numer = false)
    {

        $result = Yii::app()->db->createCommand()
            ->select('*')
            ->from('sb_smena')
            ->queryAll();
        $arr = array();

        foreach ($result as $smena) {
            $arr[$smena['id']] = ($numer===false?$smena['date']:$smena['smena'].' смена');
        }
        if (is_numeric($dloId)) {
            if (array_key_exists($dloId, $arr)) {
                return $arr[$dloId];
            }
            return $dloId;
        }
        return $arr;
    }

    public static function getDLOMonthStart($dloId = false,$max = false)
    {
        $arr = array(
            self::DLO_1 => ($max?6:6),
            self::DLO_2 => ($max?7:6),
            self::DLO_3 => ($max?7:6),
            self::DLO_4 => ($max?7:7),
            self::DLO_5 => ($max?8:7),
            self::DLO_6 => ($max?8:7),
            self::DLO_7 => ($max?8:8),
            self::DLO_8 => ($max?8:8)
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
                ->andWhere('status=:status AND booking_id IS NOT NULL', array('status' => Questionnaire::STATUS_OK))
                ->order('is_main DESC, created ASC')
                ->queryAll();
            $reserve = Reserve::getReserveData();
            $shifts = SiteService::getShifts();
            $cnt = array();
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
                    $criteria->addInCondition('t.shift_id', array(1, 32, 22, 28, 7, 17, 12));
                    break;
                case 2:
                    $criteria->addInCondition('t.shift_id', array(2, 33, 29, 23, 18, 13, 8));
                    break;
                case 3:
                    $criteria->addInCondition('t.shift_id', array(3, 14, 34, 30, 24, 9));
                    break;
                case 4:
                    $criteria->addInCondition('t.shift_id', array(4, 20, 10, 25, 31, 35, 15));
                    break;
                case 5:
                    $criteria->addInCondition('t.shift_id', array(5, 21, 26, 11, 16));
                    break;
                case 6:
                    $criteria->addInCondition('t.shift_id', array(6, 27));
                    break;
            }
        }

        if (is_numeric($this->camp_id) && $this->camp_id) {
            $criteria->compare('t.camp_id', $this->camp_id);
        }

        if (is_null($this->fromDate)) {
            $this->fromDate = '01-01-2021';//date('Y-m-d', '2016-01-01');
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
        $criteria->compare('t.code', $this->fio_parent, true);
        $criteria->compare('t.tel_parent', $this->tel_parent, true);
        $criteria->compare('t.booking_id', $this->booking_id, true);
        $criteria->compare('t.comment', $this->comment, true);

        if (is_numeric($this->is_main)) {
            $criteria->compare('t.is_main', $this->is_main);
        }

        if (is_numeric($this->is_reserve)) {
            $criteria->compare('t.status', self::STATUS_OK);
            if ($this->is_reserve) {
                $criteria->addCondition(array('t.booking_id IS NULL'));
            } else {
                $criteria->addCondition(array('t.booking_id IS NOT NULL'));
            }
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
                //$this->email_parent = $result['email_parent'];
                $this->tel_parent = $result['tel_parent'];
            } else {
                $this->fio_parent = null;
            }
            //$this->place_of_work = $result['place_of_work'];
            $this->name_ur = $result['name_ur'];
            $this->tel_ur_contact = $result['tel_ur_contact'];
            $this->email_ur_contact = $result['email_ur_contact'];

            if (Yii::app()->user->role == User::ROLE_ADMIN) {
                $this->fio_parent = $this->residence = null;
                //$this->email_parent = $this->tel_parent = $this->place_of_work = null;
                $this->tel_parent = null;
            }
        }
    }

    public static function getPref($shiftId)
    {
        switch ($shiftId) {
            case 1:
                return '1К';
                break;
            case 2:
                return '2К';
                break;
            case 3:
                return '3К';
                break;
            case 4:
                return '4К';
                break;
            case 5:
                return '5К';
                break;
            case 6:
                return '6К';
                break;
            case 7:
                return '1Г';
                break;
            case 8:
                return '2Г';
                break;
            case 9:
                return '3Г';
                break;
            case 10:
                return '4Г';
                break;
            case 11:
                return '5Г';
                break;
            case 12:
                return '1В';
                break;
            case 13:
                return '2В';
                break;
            case 14:
                return '3В';
                break;
            case 15:
                return '4В';
            case 16:
                return '5В';
                break;
            case 17:
                return '1А';
                break;
            case 18:
                return '2А';
                break;
            case 19:
                return '3А';
                break;
            case 20:
                return '4А';
                break;
            case 21:
                return '5А';
                break;
            case 22:
                return '1КС';
                break;
            case 23:
                return '2КС';
                break;
            case 24:
                return '3КС';
                break;
            case 25:
                return '4КС';
                break;
            case 26:
                return '5КС';
                break;
            case 27:
                return '6КС';
                break;
            case 28:
                return '1М';
                break;
            case 29:
                return '2М';
                break;
            case 30:
                return '3М';
                break;
            case 31:
                return '4М';
                break;
            case 32:
                return '1П';
                break;
            case 33:
                return '2П';
                break;
            case 34:
                return '3П';
                break;
            case 35:
                return '4П';
                break;
            default:
                return '';
        }
    }

    public function __set($var, $value)
    {
        if (in_array($var, array('status', 'booking_id', 'is_main', 'user_id', 'fio_parent')) && !array_key_exists($var, $this->changedAttr)) {
            $this->changedAttr[$var] = $this->$var;
        }

        parent::__set($var, $value);
    }



    //TODO новы методы, надо будет остальное все переписать от статики
    public static function getCamp()
    {

        $result = Yii::app()->db->createCommand('select * from sb_camp')
            ->queryAll();

        foreach($result as $camp) {
            $arr[] = [
                'NAME' => $camp['name'],
                'AGE' => $camp['age'],
                'ADDRESS' => $camp['address'],
            ];
        }

        return $arr;
    }

    public static function getNameChange($name = '')
    {

        $where = '';

        if (isset($name)) {
            $where .= "where name_camp like '%$name%' ";
        }

        $result = Yii::app()->db->createCommand(
            "select * from sb_change ". $where ." "
        )
            ->queryAll();

        foreach($result as $change) {
            $arr[] = [
                'NAME' => $change['name_change'],
                'DATE' => $change['change_date'],
                'DAY' => $change['count_day'],
                'CAMP' => $change['name_camp'],
            ];
        }

        $array = self::array_unique_key($arr, 'NAME');

        return $array;
    }

    public static function array_unique_key($array, $key) {
        $tmp = $key_array = array();
        $i = 0;

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $tmp[$i] = $val;
            }
            $i++;
        }
        return $tmp;
    }

}
