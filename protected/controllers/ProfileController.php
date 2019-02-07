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

    public function actionbid($id = 0)
    {
        $this->pageTitle = Yii::app()->name . ' - ' . 'Заявка #' . (int)$id;
        $q = Questionnaire::model()->findByPk($id);
        if (!$q || ($q->user_id != Yii::app()->user->id)) {
            throw new CHttpException(401, 'Страница не найдена');
        }
        $questionnairePost = Yii::app()->request->getPost('Questionnaire', array());
        if ($questionnairePost) {
            $q->scenario = 'user_up';
            $q->attributes = $questionnairePost;
            if ($q->save()) {
                Yii::app()->user->setFlash('bid', 'Запись успешно отредактированна');
                $this->refresh();
            }
        }
        $this->render('bid', array('model' => $q,'shifts' => SiteService::getShifts()));
    }


}