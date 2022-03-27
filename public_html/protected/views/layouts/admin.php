<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/bootstrap/bootstrap.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/z.style.css" type="text/css" media="screen" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>


</head>
<body id="fb_wrap" class="h-100">
    <div id="fb_preloader" class="d-none">
        <div class="spinner-border" role="status"> </div>
    </div>
    <?php $this->widget('application.extensions.panels.topAdminPanel'); ?>
    <div id="fb_pages" class="container-fluid pt-3 h-100">
        <?php echo $content; ?>
    </div>
</body>
</html>