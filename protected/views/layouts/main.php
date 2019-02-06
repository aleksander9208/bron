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
        <?php if (!Yii::app()->user->getIsGuest()) { ?>
        <nav id="fb_nav" class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <a class="navbar-brand" href="./"><?php echo Yii::app()->user->login; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#fb_nav_items" aria-controls="fb_nav_items" aria-expanded="false" aria-label="Меню">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="fb_nav_items">
                <?php $this->widget('application.extensions.panels.topPanel'); ?>
                <a id="fb_auth_signout" class="btn btn-outline-info my-2 my-sm-0" href="<?php echo Yii::app()->createUrl('/auth/logout'); ?>">Выход</a>
            </div>
        </nav>
        <?php } ?>
        <div class="container-fluid">
            <?php echo $content; ?>
        </div>
    </body>
</html>