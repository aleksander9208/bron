<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/bootstrap/bootstrap.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/z.style.css" type="text/css" media="screen" />

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/z.core.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/z.tasks.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/z.module.ajax.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/z.boot.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/bootstrap/bootstrap.bundle.js"></script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    </head>
    <body id="fb_wrap" class="h-100">
        <div id="fb_preloader" class="d-none">
            <div class="spinner-border" role="status"> </div>
        </div>
        <?php if (Yii::app()->user->getIsGuest()) { ?>
            <div id="z_nav" class="container-fluid mb-5">
                <div class="row mb-2">
                    <div class="col">
                        Вы вошли как: <strong><?php echo Yii::app()->user->login; ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <a class="nav-item btn btn-primary mr-2 active" href="<?php echo Yii::app()->createUrl('/site/addstatement'); ?>">Подать заявку</a>
                    </div>
                    <div class="col-4 text-right">
                        <a class="nav-item btn btn-primary" href="<?php echo Yii::app()->createUrl('/auth/logout'); ?>">Выход</a>
                        <?php //$this->widget('application.extensions.panels.topPanel'); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="container-fluid">
            <?php echo $content; ?>
        </div>
    </body>
</html>