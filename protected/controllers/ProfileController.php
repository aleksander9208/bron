<?php

class ProfileController extends Controller
{

    public $id = 'profile';
    public $layout = "main";

    public function __construct($id, $module = null)
    {
        if (!Yii::app()->user->checkAccess(User::ROLE_USER) && Yii::app()->user->role != User::ROLE_USER) {
            $this->redirect(Yii::app()->createUrl('/site'));
        }

        return parent::__construct($id, $module = null);
    }

    public function actionIndex()
    {
        $title = 'Мои заявки';
        $questionnaire = new Questionnaire();
        $questionnaire->type = $questionnaire->status = null;
        $questionnaire->user_id = Yii::app()->user->id;
        $this->render('bidList', array('title' => $title, 'model' => $questionnaire));
    }


}