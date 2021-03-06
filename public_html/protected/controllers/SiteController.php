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

        if (!Yii::app()->user->getIsGuest()) {
            $this->redirect(Yii::app()->createUrl('/site/addstatement'));
        }

        $this->forward('/auth/login');
    }

    public function actionAddStatement()
    {

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->createUrl('/statics/css/z.page.anketa.css'));
        $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.page.anketa.js'), CClientScript::POS_END);

        $title = 'Подача заявки';
        $this->pageTitle = $title;
        $model = new Questionnaire();

        if (!Yii::app()->user->getIsGuest()) {
            if (Yii::app()->user->role==User::ROLE_USER) {
                $model->fio_ur_contact = $model->fio_parent = Yii::app()->user->login;
                $model->ur_code = $model->code = Yii::app()->user->code;
            }
            $model->putData(Yii::app()->user->id);
        }
        if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
            $model->created = date('H:i:s d-m-Y');
        }

        $postQuestionnaire = Yii::app()->request->getPost('Questionnaire', array());
        $postShifts = Yii::app()->request->getPost('Shifts', array());

        if ($postQuestionnaire) {
            $transaction = Yii::app()->db->beginTransaction();
            foreach ($postShifts as $k => $ps) {
                    $model = new Questionnaire();
                    if (!Yii::app()->user->getIsGuest()) {
                        $model->fio_ur_contact = $model->fio_parent = Yii::app()->user->login;
                        $model->ur_code = $model->code = Yii::app()->user->code;
                    }
                    $model->attributes = $postQuestionnaire;
                    $model->shift_id = (int)$ps;
                    $model->code = $postQuestionnaire['code'];
                    if (!$model->save()) {
                        Yii::app()->user->setFlash('q_error',Yii::app()->user->getFlash('q_error') . implode('<br>', $model->error_arr));
                    }
            }
            if (!$postShifts) {
                $model = new Questionnaire();
                if (!Yii::app()->user->getIsGuest()) {
                    $model->fio_ur_contact = $model->fio_parent = Yii::app()->user->login;
                    $model->ur_code = $model->code = Yii::app()->user->code;
                }
                $model->attributes = $postQuestionnaire;
                $model->code = $postQuestionnaire['code'];
                if (!$model->save()) {
                    //$model->error_arr[] = 'Неуказана смена';
                    Yii::app()->user->setFlash('q_error',Yii::app()->user->getFlash('q_error') . implode('<br>', $model->error_arr));
                }
            }
            if (Yii::app()->user->hasFlash('q_error')) {
                $transaction->rollBack();
            } else {
                $transaction->commit();
                Yii::app()->user->setFlash('q_done', 'Заявка подана');
                if (!Yii::app()->user->getIsGuest()) {
                    $model->fio_ur_contact = $model->fio_parent = Yii::app()->user->login;
                    $model->ur_code = $model->code = Yii::app()->user->code;
                }
                $identity = new UserIdentity('','','');
                $identity->authenticateById($model->user_id);
                if (Yii::app()->user->getIsGuest() && !(boolean)Yii::app()->user->login($identity, AUTH_DURATION)) {
                    $this->refresh();
                } else {
                    $this->refresh();
                }
            }
        }

        $this->render('statement',
            array(
                'title' => $title,
                'model' => $model,
                'user' => Yii::app()->user,
                'shifts' => SiteService::getShifts(),
                'seats' => SiteService::seatsShifts(),
                'postShifts' => $postShifts,
            )
        );
    }


}
