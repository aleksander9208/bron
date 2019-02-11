<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/bootstrap/bootstrap.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/z.style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/peremena.style.css" type="text/css" media="screen" />

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/statics/js/jquery/jquery.mask.js"></script>
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

        <div id="inner-wrapper">
            <div id="page">
                <div id="menu-wrapper">
                    <div id="menu">
                        <div class="menu-placeholder">
                            <a href="http://www.cdo-peremena.ru/" id="logo"></a>
                            <div id="menu-left" class="inner-menu">
                                <ul class="navigation">
                                    <li class="item entry-1">
                                        <a id="menu-47" title="О нас" href="http://www.cdo-peremena.ru/meroprijatija">О нас</a>
                                    </li>
                                    <li class="item entry-2">
                                        <a id="menu-26" title="Программы" href="http://www.cdo-peremena.ru/programs">Программы</a>
                                    </li>
                                    <li class="item entry-3">
                                        <a id="menu-1" title="Лагеря" href="http://www.cdo-peremena.ru/camps/camps">Лагеря</a>
                                    </li>
                                </ul>
                            </div>
                            <div id="menu-right" class="inner-menu">
                                <ul class="navigation">
                                    <li class="item entry-4">
                                        <a id="menu-21" title="Родителям" href="http://www.cdo-peremena.ru/roditeljam">Родителям</a>
                                    </li>
                                    <li class="item entry-5">
                                        <a id="menu-22" title="Новости" class="active" href="http://www.cdo-peremena.ru/news/news">Новости</a>
                                    </li>
                                    <li class="item entry-6">
                                        <a id="menu-43" title="События" href="http://www.cdo-peremena.ru/sobitiya/events">События</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="content">

                        <?php if (!Yii::app()->user->getIsGuest()) { ?>
                            <?php $this->widget('application.extensions.panels.topPanel'); ?>
                        <?php } ?>
                        <div class="container-fluid">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
                <div id="bottom-wrapper">
                    <div id="bottom-wrapper2">
                        <div id="bottom">
                            <a href="http://www.cdo-peremena.ru/" id="bottom-logo"></a>
                            <div id="bottom-menu" class="ru">
                                <ul class="h_menu">
                                    <li>
                                        <a id="menu-47" title="О нас" href="http://www.cdo-peremena.ru/meroprijatija">О нас</a>
                                    </li>
                                    <li>
                                        <a id="menu-26" title="Программы" href="http://www.cdo-peremena.ru/programs">Программы</a>
                                    </li>
                                    <li>
                                        <a id="menu-1" title="Лагеря" href="http://www.cdo-peremena.ru/camps/camps">Лагеря</a>
                                    </li>
                                    <li>
                                        <a id="menu-21" title="Родителям" href="http://www.cdo-peremena.ru/roditeljam">Родителям</a>
                                    </li>
                                    <li>
                                        <a id="menu-22" title="Новости" class="active" href="http://www.cdo-peremena.ru/news/news">Новости</a>
                                    </li>
                                    <li>
                                        <a id="menu-43" title="События" href="http://www.cdo-peremena.ru/sobitiya/events">События</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>