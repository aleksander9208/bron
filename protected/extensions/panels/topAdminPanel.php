<?php

class TopAdminPanel extends CWidget
{

    public function run()
    {
        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;

        $this->render('/topAdmin', array('controller' => $controller, 'action' => $action, 'user' => Yii::app()->user));
    }

}