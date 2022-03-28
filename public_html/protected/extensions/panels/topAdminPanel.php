<?php

class TopAdminPanel extends CWidget
{

    public function run()
    {
        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;
        $cntModerOrder = Questionnaire::model()->countByAttributes(array('status' => Questionnaire::STATUS_IN_MODER));
        $this->render('/topAdmin', array('controller' => $controller, 'action' => $action, 'user' => Yii::app()->user, 'cmoder' => $cntModerOrder));
    }

}