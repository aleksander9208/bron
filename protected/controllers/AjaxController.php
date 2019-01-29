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
        // if (!in_array($action->id, array('upload'))) {
        echo json_encode($this->out);
        // }

        return parent::afterAction($action);
    }

    public function actionIndex()
    {
        $this->renderText('Ajax');
    }

    public function actionAddShowEvent()
    {
        $se = new ShowEvent();
        $se->attributes = $_POST;
        if (!$se->save()) {
            $this->out['errors'] = $se->error_arr;
        } else {
            $this->out['data'] = array('event_id' => $se->id);
        }
    }

    public function actionDropEvent()
    {
        $eventId = Yii::app()->request->getParam('id', 0);
        if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) {
            if (Yii::app()->request->isPostRequest) {
                $se = ShowEvent::model()->deleteByPk($eventId);
                if (!$se) {
                    $this->out['errors'] = array('Запись не найдена');
                }
            } else {
                $this->out['errors'] = array('Парамерты не заданы');
            }
        } else {
            throw new CHttpException(401, 'Страница не найдена');
        }
    }

    public function actionAddBet()
    {
        if ((Yii::app()->user->role != User::ROLE_BANNED) && Yii::app()->user->checkAccess(User::ROLE_USER)) {
            if (Yii::app()->request->isPostRequest) {
                $bet = new ClientBet();
                $bet->attributes = $_POST;
                if (!$bet->save()) {
                    $this->out['errors'] = $bet->error_arr;
                } else {
                      $this->out['data'] = $bet->liveMess;
                }
            } else {
                $this->out['errors'] = array('Парамерты не заданы');
            }
        } else {
            throw new CHttpException(401, 'Страница не найдена');
        }
    }


    public function actionGetAmountRange()
    {
        $siteService = new SiteService();
        $eventIdPost = Yii::app()->request->getParam('event', 0);
        $factorIdPost = Yii::app()->request->getParam('factor', 0);
        if ((Yii::app()->user->role != User::ROLE_BANNED) && Yii::app()->user->checkAccess(User::ROLE_USER)) {
            $result = $siteService->getAmountMinMax($eventIdPost, $factorIdPost);
            if ($result['errors']) {
                $this->out['errors'] = $result['errors'];
            } else {
                $this->out['data'] = $result['data'];
                $this->out['data']['event_id'] = (int)$eventIdPost;
                $this->out['data']['factor_id'] = (int)$factorIdPost;
            }
        } else {
            throw new CHttpException(401, 'Страница не найдена');
        }
    }


}


