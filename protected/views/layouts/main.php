<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/images/favicon.ico" type="image/x-icon" />
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/images/favicon.ico" type="image/x-icon" />


        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/bootstrap/bootstrap.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/fb.style.css" type="text/css" media="screen" />

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/jquery/jquery.sortelements.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/fb.core.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/fb.tasks.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/fb.module.ajax.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/fb.boot.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/bootstrap/bootstrap.bundle.js"></script>
    </head>
    <body id="fb_wrap" class="h-100">
        <div id="fb_preloader" class="d-none">
            <div class="spinner-border" role="status"> </div>
        </div>

        <div id="fb_pages" class="container-fluid h-100">
            <?php echo $content; ?>
        </div>
    </body>
</html>