<?php

class SiteController extends Controller
{
    public $id = 'site';
    public $layout = "user";

    public function __construct($id, $module = null)
    {

        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');

        return parent::__construct($id, $module = null);
    }

    public function actionIndex()
    {
        $title = 'Подать заявление';
        $this->pageTitle = Yii::app()->name . ' - ' . $title;

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/fb.page.main.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/fb.page.main.js'), CClientScript::POS_END);

        $this->render('index',
            array(
                'title' => $title,
                'role' => Yii::app()->user->role,
            )
        );
    }






}
