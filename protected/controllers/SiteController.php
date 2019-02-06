<?php

class SiteController extends Controller
{
    public $id = 'site';
    public $layout = "main";

    public function __construct($id, $module = null)
    {



        return parent::__construct($id, $module = null);
    }


    public function actionIndex() {

        $this->forward('/auth/login');
    }

    public function actionAddStatement()
    {

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.anketa.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.anketa.js'), CClientScript::POS_END);

        $title = 'Подача заявления';
        $model = new Questionnaire();
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
            if (!$postShifts || !$postDlos) {
                Yii::app()->user->setFlash('q_error', 'Неуказана смена или период');
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
