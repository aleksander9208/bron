<nav id="z_nav" class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand" href="./">Админ-панель</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo(in_array($action, array('index','bid')) ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo Yii::app()->createUrl('/admin'); ?>">Модерация <span class="badge badge-info"><?php echo ( $cmoder?$cmoder:''); ?></span></a>

            </li>
            <li class="nav-item <?php echo(in_array($action, array('reserve')) ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo Yii::app()->createUrl('/admin/reserve'); ?>">Резервирование</a>
            </li>
            <li class="nav-item <?php echo(in_array($action, array('stat')) ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo Yii::app()->createUrl('/admin/stat'); ?>">Статистика</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo Yii::app()->createUrl('/site/addstatement'); ?>">Подать заявку</a>
            </li>
        </ul>
        <span class="navbar-text mr-2"><?php echo Yii::app()->user->login; ?></span>
        <a id="fb_auth_signout" class="btn btn-outline-info" href="<?php echo Yii::app()->createUrl('/auth/logout'); ?>">Выход</a>
    </div>
</nav>