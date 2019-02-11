<?php

class ProfileController extends Controller
{

    public $id = 'profile';
    public $layout = "main";

    public function __construct($id, $module = null)
    {
        // if (!Yii::app()->user->checkAccess(User::ROLE_USER) && Yii::app()->user->role != User::ROLE_USER) {
        if (Yii::app()->user->getIsGuest()) {
            $this->redirect(Yii::app()->createUrl('/site'));
        }

        return parent::__construct($id, $module = null);
    }

    public function actionIndex()
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.anketa_list.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.anketa_list.js'), CClientScript::POS_END);

        $title = 'Мои заявки';
        $questionnaire = new Questionnaire();
        $questionnaire->type = $questionnaire->status = null;
        $questionnaire->user_id = Yii::app()->user->id;


        $this->render('bidList', array('title' => $title, 'model' => $questionnaire));
    }

    public function actionbid($id = 0)
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.anketa_view.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.anketa_view.js'), CClientScript::POS_END);

        $this->pageTitle = Yii::app()->name . ' - ' . 'Заявка #' . (int)$id;
        $title = 'Анкета';
        $q = Questionnaire::model()->findByPk($id);
        if (!$q || ($q->user_id != Yii::app()->user->id)) {
            throw new CHttpException(401, 'Страница не найдена');
        }
        if ($q['booking_id'])
            $title .= ' №' . $q['booking_id'];

        $questionnairePost = Yii::app()->request->getPost('Questionnaire', array());
        if ($questionnairePost) {
            $q->scenario = 'user_up';
            $q->attributes = $questionnairePost;
            if ($q->save()) {
                Yii::app()->user->setFlash('bid', 'Запись успешно отредактированна');
                $this->refresh();
            }
        }
        $this->render('bid', array('title' => $title, 'model' => $q, 'shifts' => SiteService::getShifts()));
    }

    public function actionPrint($id = 0)
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.anketa_print.css'));
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.anketa_print.css?print'), 'print');
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.anketa_print.js'), CClientScript::POS_END);


        $this->pageTitle = Yii::app()->name . ' - ' . 'Печать';
        $title = 'Анкета';
        $q = Questionnaire::model()->findByPk($id);
        if (!$q || ($q->user_id != Yii::app()->user->id)) {
            throw new CHttpException(401, 'Страница не найдена');
        }
        if ($q['booking_id'])
            $title .= ' №' . $q['booking_id'];

        $this->layout = "print";

        $this->render('bidprint', array('title' => $title, 'model' => $q, 'shifts' => SiteService::getShifts()));
    }

    public function actionFreePrint()
    {
        $this->layout = "print";
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.freeprint.css'));
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.freeprint.css?print'), 'print');
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.freeprint.js'), CClientScript::POS_END);

        $text = Yii::app()->request->getParam('str', '');

        $this->render('print', array('text' => $text));
    }


}