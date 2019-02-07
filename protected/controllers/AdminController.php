<?php

class AdminController extends Controller
{

    public $id = 'admin';
    public $layout = "admin";

    public function __construct($id, $module = null)
    {
        if (!Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
            $this->redirect(Yii::app()->createUrl('/site'));
        }

        return parent::__construct($id, $module = null);
    }


    public function actionIndex()
    {
        $title = 'Заявки к рассмотрению';

        $this->pageTitle = Yii::app()->name . ' - ' . $title;
        $questionnaire = new Questionnaire();
        $questionnaire->type = $questionnaire->status = $questionnaire->paid = null;
        $questionnairePost = Yii::app()->request->getParam('Questionnaire', array());
        if ($questionnairePost) {
            $questionnaire->attributes = $questionnairePost;
        }

        $this->render('index', array('title' => $title, 'model' => $questionnaire));
    }

    public function actionbid($id = 0)
    {
        $this->pageTitle = Yii::app()->name . ' - ' . 'Заявка #'.(int)$id;
        $q = Questionnaire::model()->findByPk($id);
        if (!$q) {
            throw new CHttpException(401, 'Страница не найдена');
        }
        $questionnairePost = Yii::app()->request->getPost('Questionnaire', array());
        if ($questionnairePost) {
            $q->scenario = 'mod';
            $q->attributes = $questionnairePost;
            if ($q->save()) {
                if ($id) {
                    Yii::app()->user->setFlash('bid', 'Запись успешно отредактированна');
                    $this->refresh();
                } else {
                    Yii::app()->user->setFlash('bid', 'Запись успешно добавлена');
                    $this->redirect(Yii::app()->createUrl('/admin/bid/' . $q->id));
                }
            }
        }
        $this->render('bid', array('model' => $q));
    }


    public function actionStat()
    {
        $title = 'Статистика';

        $this->pageTitle = Yii::app()->name . ' - ' . $title;
        $questionnaire = new Questionnaire();
        $questionnaire->type = $questionnaire->status = $questionnaire->paid = null;
        $questionnairePost = Yii::app()->request->getParam('Questionnaire', array());
        if ($questionnairePost) {
            $questionnaire->attributes = $questionnairePost;
        }
        $questionnaire->status = Questionnaire::STATUS_OK;

        $this->render('stat', array('title' => $title, 'model' => $questionnaire));
    }


}