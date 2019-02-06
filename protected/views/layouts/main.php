<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
        <div id="fb_pages" class="container-fluid h-100">
            <?php echo $content; ?>
        </div>
    </body>
</html>