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

  /*  public function actionIndex()
    {
        $title = 'Порядок подачи заявления';
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
    }*/

    public function actionIndex()
    {
        $title = 'Подать заявление';
        $model = new Questionnaire();
        echo Yii::app()->user->role;
        $postQuestionnaire = Yii::app()->request->getPost('Questionnaire', array());
        $postShifts = Yii::app()->request->getPost('Shifts', array());
        $postDlos = Yii::app()->request->getPost('Dlos', array());
        if ($postQuestionnaire) {
            $transaction = Yii::app()->db->beginTransaction();
            foreach ($postShifts as $k => $ps) {
                if (isset($postDlos[$k])) {
                    $model = new Questionnaire();
                    $model->attributes = $postQuestionnaire;
                    $model->shift_id = (int)$ps;
                    $model->dlo_id = (int)$postDlos[$k];
                    if (!$model->save()) {
                        Yii::app()->user->setFlash('q_error',Yii::app()->user->getFlash('q_error') . implode('<br>', $model->error_arr));
                    }
                }
            }
            if (Yii::app()->user->hasFlash('q_error')) {
                $transaction->rollBack();
            } else {
                $transaction->commit();
                Yii::app()->user->setFlash('q_done', 'Успех');
                $identity = new UserIdentity('','');
                $identity->authenticateById($model->user_id);
                if (Yii::app()->user->getIsGuest() && !(boolean)Yii::app()->user->login($identity, AUTH_DURATION)) {
                    $this->refresh();
                } else {
                    $this->redirect(Yii::app()->createUrl('/profile'));
                }
            }
        }
        $this->render('statement',
            array(
                'title' => $title,
                'model' => $model,
                'user' => Yii::app()->user,
            )
        );
    }


}
