<?php
class WebUser extends CWebUser {
    private $_model = null;

    function getRole() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->role;
        }
        return 'guest';
    }

    function getLogin() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->login;
        }
        return 'guest';
    }

    function getCode() {
        if($user = $this->getModel()){
            // в таблице User есть поле code
            return $user->code;
        }
        return 'guest';
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role,login,code'));
        }
        return $this->_model;
    }
}