<?php

class ErrorsController extends CController {

    public $id = 'errors';

    public function __construct($id, $module = null) {
        mb_internal_encoding("UTF-8");

        return parent::__construct($id, $module = null);
    }

    public function actionIndex() {
        $error = Yii::app()->errorHandler->error;
        if(Yii::app()->request->isAjaxRequest){
            $this->layout = false;
            echo CHtml::encode($error['message']);
            Yii::app()->end();
        }

        $this->pageTitle = Yii::app()->name . ' - ' . (isset($error['code']) ? $error['code'] . ' - ' : '') . 'Страница не найдена';
        if ($error) {
            $this->render('error', array('error' => $error));
        }
    }

}