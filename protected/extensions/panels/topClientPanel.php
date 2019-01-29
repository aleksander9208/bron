<?php

class TopClientPanel extends CWidget
{

    public function run()
    {
        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;

        $this->render('/topClient', array('controller' => $controller, 'action' => $action, 'user' => Yii::app()->user));
    }

}