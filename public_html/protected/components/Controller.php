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
        if (Yii::app()->controller->id!=='ajax') {

            $cs = Yii::app()->getClientScript();
            $cs->registerCoreScript('jquery');
            $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/jquery/jquery.tablesorter.js?v='.RELEASE_VERSION));
            $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/jquery/jquery.mask.js?v='.RELEASE_VERSION));
            $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.core.js?v='.RELEASE_VERSION));
            $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.tasks.js?v='.RELEASE_VERSION));
            $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.module.ajax.js?v='.RELEASE_VERSION));
            $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/z.boot.js?v='.RELEASE_VERSION));
            $cs->registerScriptFile(Yii::app()->createUrl('/statics/js/bootstrap/bootstrap.bundle.js?v='.RELEASE_VERSION));

            Yii::app()->getClientScript()->registerScript('inline', "if (typeof window.z == 'object') {window.z.debug = ".(YII_DEBUG?"true":"false")."; window.z.path = '".(Yii::app()->createUrl('/')==''?'/':Yii::app()->createUrl('/'))."'; window.z.role = '".(Yii::app()->user->getIsGuest()?'guest':'user')."'; window.z.user_id = ".(Yii::app()->user->getIsGuest()?0:Yii::app()->user->id)."; }", CClientScript::POS_END);
        }

        return parent::beforeAction($action);
    }
}