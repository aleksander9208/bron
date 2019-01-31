<?php

class AjaxController extends Controller
{
    public $out = array();
    public $data = array();
    public $errors = array();

    public function __construct($id, $module = null)
    {
        $this->layout = false;
        header('Content-type: text/html; charset=utf-8');
        header('Content-type: text/json');
        header('Content-type: application/json');

        return parent::__construct($id, $module = null);
    }

    public function beforeAction($action)
    {
        $this->out = array('status' => false, 'data' => $this->data, 'errors' => $this->errors);

        return parent::beforeAction($action);
    }

    public function afterAction($action)
    {
        if (!$this->out['errors']) {
            $this->out['status'] = true;
        }
        echo json_encode($this->out);

        return parent::afterAction($action);
    }

    public function actionIndex()
    {
        $this->renderText('Ajax');
    }

    public function actionSetPaid()
    {
        if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
            $questionnaireId = Yii::app()->request->getParam('questionnaire_id', 0);
            $paid = Yii::app()->request->getParam('paid', 0);
            if (Yii::app()->request->isPostRequest) {
                Yii::app()->db->createCommand()->update('{{questionnaire}}', array('paid' => (int)$paid), 'id=:id', array('id' => (int)$questionnaireId));
                $this->out['data'] = array('questionnaire_id' => (int)$questionnaireId, 'paid' => (int)$paid);
            } else {
                $this->out['errors'] = array('Парамерты не заданы');
            }
        } else {
            throw new CHttpException(401, 'Страница не найдена');
        }
    }

    public function actionGetCampsList()
    {
        $shiftId = Yii::app()->request->getParam('shift', false);
        $dloId = Yii::app()->request->getParam('dloId', false);
        $age = Yii::app()->request->getParam('age', false);
        $campsIds = Questionnaire::getCampsByParams($shiftId, $dloId, $age);
        $this->out['data']['camps'] = array();
        foreach ($campsIds as $c) {
            $this->out['data']['camps'][] = array('id' => $c, 'name' => Questionnaire::getCAMPName($c));
        }
    }

    public function actionGetShiftList()
    {
        $shiftId = Yii::app()->request->getParam('shift', false);
        $dloId = Yii::app()->request->getParam('dloId', false);
        $age = Yii::app()->request->getParam('age', false);
        $campsIds = Questionnaire::getCampsByParams($shiftId, $dloId, $age);
        $this->out['data']['camps'] = array();
        foreach ($campsIds as $c) {
            $this->out['data']['camps'][] = array('id' => $c, 'name' => Questionnaire::getCAMPName($c));
        }
    }


}


