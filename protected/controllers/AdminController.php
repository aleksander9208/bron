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
        $title = 'Спортивные события';

        $this->pageTitle = Yii::app()->name . ' - ' . $title;
        $this->breadcrumbs = array('Админ-панель' => array(Yii::app()->createUrl('/admin')), $title => array(Yii::app()->createUrl('/admin')));

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/fb.page.admin_events.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/fb.page.admin_events.js'), CClientScript::POS_END);

        $adminService = new AdminService();

        $this->render('index', array('title' => $title, 'info_data' =>  $adminService->getEventsList(),'events_my'=> $adminService->getMyEventsList() ));
    }

    public function actionMyEventsList()
    {
        $title = 'Мои события';
        $this->pageTitle = Yii::app()->name . ' - ' . $title;

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/fb.page.admin_collection.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/fb.page.admin_collection.js'), CClientScript::POS_END);

        $adminService = new AdminService();

        $this->render('myEventsList', array('title' => $title,'events'=> $adminService->getMyEventsList()));
    }


}