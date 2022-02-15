<?php

class TopPanel extends CWidget
{

    public function run()
    {
        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;

        $this->render('/top', array('controller' => $controller, 'action' => $action, 'user' => Yii::app()->user));
    }

}