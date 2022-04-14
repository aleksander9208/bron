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
            $this->redirect(Yii::app()->createAbsoluteUrl('/site/addstatement'));
        }
        $this->pageTitle = 'Авторизация';// . Yii::app()->name;

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.auth.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.auth.js'), CClientScript::POS_END);


        $model = new LoginForm;
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate()) {
                if (!Yii::app()->user->getIsGuest()) {
                    switch (Yii::app()->user->role) {
                        case User::ROLE_USER:
                            $this->redirect(Yii::app()->createAbsoluteUrl('/profile'));
                            break;
                        case User::ROLE_ADMIN:
                            $this->redirect(Yii::app()->createAbsoluteUrl('/admin'));
                            break;
                        default:
                            $this->redirect(Yii::app()->createAbsoluteUrl('/'));
                    }
                }


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