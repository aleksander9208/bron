<?php

class AuthController extends Controller
{
    public $id = 'auth';
    public $defaultAction = 'Login';
    public $layout = "main";

    public function actionIndex()
    {
        $this->renderText('index');
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if (!Yii::app()->user->getIsGuest()) {
            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
        }
        $this->pageTitle =  'Авторизация - '.Yii::app()->name;

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/fb.page.auth.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/fb.page.auth.js'), CClientScript::POS_END);


        $model = new LoginForm;
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate()) {
                $this->redirect(Yii::app()->createAbsoluteUrl('/'));
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->session->clear();
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->createAbsoluteUrl('/'));
        //$this->redirect(Yii::app()->homeUrl);
    }
}