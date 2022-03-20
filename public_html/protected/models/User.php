<?php

class User extends CActiveRecord
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'ban';

    public $error_str;
    public $error_arr = array();

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{user}}';
    }

    public function rules()
    {
        return array(
            array('id,login', 'unique'),
            array('login,password,created', 'required',),
            array('login', 'length', 'min' => 1, 'max' => 42),
            array('role', 'in', 'range' => array(self::ROLE_ADMIN, self::ROLE_USER, self::ROLE_BANNED)),
            array('login', 'length', 'min' => 1, 'max' => 42),
        );
    }

    public function attributeLabels()
    {
        return array(
            'login' => 'ФИО',
            'password' => 'Телефон',
            'created' => 'Дата создания',
            'code' => 'Кодовое слово',
            'role' => 'Роль',
        );
    }

    public function safeAttributes()
    {
        return array(
            'login',
        );
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            if (is_null($this->created)) {
                $this->created = date('Y-m-d H:i:s');
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

    public static function getRoles($role = false)
    {
        $arr = array(
            self::ROLE_ADMIN => 'admin',
            self::ROLE_USER => 'user',
            self::ROLE_BANNED => 'ban',
        );
        if ($role) {
            if (array_key_exists($role, $arr)) {
                return $arr[$role];
            }
            return $role;
        }
        return $arr;
    }

    public function getListUser()
    {

        return Yii::app()->db->createCommand()
            ->select('*')
            ->from('sb_user')
            ->queryAll();

    }

}