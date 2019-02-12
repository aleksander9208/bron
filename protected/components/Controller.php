<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();


    public function beforeAction($action) {
        //echo Yii::app()->controller->id.' => '.$action->id;

        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');

        if (Yii::app()->controller->id!=='ajax') {
            Yii::app()->getClientScript()->registerScript('inline', "if (typeof fb == 'object') {fb.debug = ".(YII_DEBUG?"true":"false")."; fb.path = '".Yii::app()->createUrl('/')."'; fb.role = '".(Yii::app()->user->getIsGuest()?'guest':'user')."'; fb.user_id = ".(Yii::app()->user->getIsGuest()?0:Yii::app()->user->id)."; }", CClientScript::POS_END);
        }

        return parent::beforeAction($action);
    }
}