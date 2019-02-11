<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    public $username;
    public $password;

    public $errors_str;
    public $errors_arr = array();

    private $_identity;

    public function rules()
    {
        return array(
            array('username, password', 'required'),
            array('password', 'authenticate'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'username' => 'ФИО',
            'password' => 'Телефон',

        );
    }

    public function beforeValidate()
    {

        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        if ($this->getErrors()) {
            foreach ($this->getErrors() as $n) {
                foreach ($n as $e) {
                    $this->errors_arr[] = $e;
                }
            }
            $this->errors_str = implode("\n", $this->errors_arr);
        }

        return parent::afterValidate();
    }

    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->$attribute);

            if ($this->_identity->authenticate() && ($this->_identity->errorCode == UserIdentity::ERROR_NONE)) {
                if ((boolean)Yii::app()->user->login($this->_identity, AUTH_DURATION)) {
                    return true;
                }
            }
            $this->addError('password', 'Учетная запись не найдена');

            return false;
        }
        return true;
    }

}
