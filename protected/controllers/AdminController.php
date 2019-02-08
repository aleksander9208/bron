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
        $this->pageTitle = Yii::app()->name . ' - ' . 'Заявка #' . (int)$id;
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
        $this->render('bid', array('model' => $q, 'shifts' => SiteService::getShifts()));
    }


    public function actionStat()
    {
        $title = 'Статистика';
        $statId = Yii::app()->request->getParam('stat_id', 1);
        $this->pageTitle = Yii::app()->name . ' - ' . $title;
        $questionnaire = new Questionnaire();
        $questionnaire->type = $questionnaire->status = $questionnaire->paid = null;
        $questionnairePost = Yii::app()->request->getParam('Questionnaire', array());
        if ($questionnairePost) {
            $questionnaire->attributes = $questionnairePost;
        }
        $questionnaire->status = Questionnaire::STATUS_OK;


        switch ($statId) {
            case 2:
            case 3:
            case 4:
            case 5:
            $statData = AdminService::getStatCamp($statId);
                break;
            default:
                $statData = array();

        }

        $this->render('stat', array('title' => $title, 'model' => $questionnaire, 'statId' => $statId, 'statData' => $statData));
    }

    public function actionReserve()
    {
        $title = 'Резервирование';
        $this->pageTitle = Yii::app()->name . ' - ' . $title;
        $r = Reserve::model()->findByPk(1);
        if (!$r) {
            throw new CHttpException(401, 'Резерв не найден в системе');
        }
        $reservePost = Yii::app()->request->getPost('Reserve', array());
        if ($reservePost) {
            $r->attributes = $reservePost;
            if ($r->save()) {
                Yii::app()->user->setFlash('r_done', 'Запись успешно отредактированна');
                $this->refresh();
            } else {
                Yii::app()->user->setFlash('r_error', implode('<br>', $r->error_arr));
            }
        }

        $this->render('reserve', array('title' => $title, 'model' => $r, 'shifts' => SiteService::getShifts()));
    }


}