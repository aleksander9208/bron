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

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.anketa_admin_list.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.anketa_admin_list.js'), CClientScript::POS_END);

        $this->pageTitle = $title;
        $questionnaire = new Questionnaire();
        $questionnaire->type = $questionnaire->status = $questionnaire->paid = $questionnaire->is_main = $questionnaire->create_admin = null;
        $questionnairePost = Yii::app()->request->getParam('Questionnaire', array());

        $admFilter = Yii::app()->session->get('admin_filter',array());
        if ($questionnairePost) {
            $questionnaire->attributes = $questionnairePost;
            Yii::app()->session->add('admin_filter', $questionnairePost);
        } elseif($admFilter) {
            $questionnaire->attributes = $admFilter;
        }
        $admFilterSort = Yii::app()->session->get('admin_filter_sort',array());
        if (isset($_GET['sort']) && $_GET['sort']) {
            Yii::app()->session->add('admin_filter_sort', $_GET['sort']);
        } elseif($admFilter) {
            $_GET['sort'] = $admFilterSort;
        }

        $this->render('index', array('title' => $title, 'model' => $questionnaire));
    }

    public function actionbid($id = 0)
    {
        $title = 'Модерация анкеты';
        $this->pageTitle = 'Модерация анкеты. Заявка №' . (int)$id;
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
                    $str = 'Запись успешно отредактирована';
                    if ($q->status == Questionnaire::STATUS_RETURNED) {
                        $str = 'Отправлено на доработку';
                    }elseif($q->status == Questionnaire::STATUS_OK) {
                        $str ='Заявка зарегистрирована';
                    }
                    Yii::app()->user->setFlash('bid', $str);
                    $this->refresh();
                } else {
                    Yii::app()->user->setFlash('bid', 'Запись успешно добавлена');
                    $this->redirect(Yii::app()->createUrl('/admin/bid/' . $q->id));
                }
            }
        }
        $this->render('bid', array('title' => $title,  'model' => $q, 'shifts' => SiteService::getShifts()));
    }


    public function actionStat()
    {
        $title = 'Статистика';
        $statId = Yii::app()->request->getParam('stat_id', 1);
        $this->pageTitle = $title;

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.admin_statistics_'.$statId.'.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.admin_statistics.js'), CClientScript::POS_END);

        $questionnaire = new Questionnaire();
        $questionnaire->type = $questionnaire->status = $questionnaire->paid = $questionnaire->create_admin = null;
        $questionnairePost = Yii::app()->request->getParam('Questionnaire', array());
        $statFilter = Yii::app()->session->get('stat_filter',array());
        if ($questionnairePost) {
            $questionnaire->attributes = $questionnairePost;
            Yii::app()->session->add('stat_filter', $questionnairePost);
        } else {
            $questionnaire->attributes = $statFilter;
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
        $this->pageTitle = $title;

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.admin_reserve.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.admin_reserve.js'), CClientScript::POS_END);

        $r = Reserve::model()->findByPk(1);
        if (!$r) {
            throw new CHttpException(401, 'Резерв не найден в системе');
        }
        $reservePost = Yii::app()->request->getPost('Reserve', array());
        if ($reservePost) {
            $r->attributes = $reservePost;
            if ($r->save()) {
                //Сохранения редактирования

                Reserve::seatsCamp($reservePost);

                Yii::app()->user->setFlash('r_done', 'Запись успешно отредактирована');
                $this->refresh();
            } else {
                Yii::app()->user->setFlash('r_error', implode('<br>', $r->error_arr));
            }
        }

        $fillReserv = AdminService::getFillReserv();
        $this->render('reserve', array('title' => $title, 'model' => $r, 'shifts' => SiteService::getShifts(),'seats' => SiteService::seatsShifts(), 'rfill' => $fillReserv));
    }

    public function actionCamp()
    {
        $title = 'Редактировать лагеря';
        $this->pageTitle = $title;

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.admin_reserve.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.admin_reserve.js'), CClientScript::POS_END);

        $r = new Camp;

        $this->render('camp', array('title' => $title, 'model' => $r, 'shifts' => SiteService::getShifts(),'seats' => SiteService::seatsShifts()));

    }

    public function actionList()
    {
        $title = 'Список пользователей';
        $this->pageTitle = $title;

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.admin_reserve.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.admin_reserve.js'), CClientScript::POS_END);

        $this->render('list', array('title' => $title, 'model' => $r, 'shifts' => SiteService::getShifts(),'seats' => SiteService::seatsShifts()));

    }
}