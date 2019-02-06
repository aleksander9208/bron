<ul class="navbar-nav mr-auto">
    <?php if (Yii::app()->user->checkAccess(User::ROLE_ADMIN)) { ?>
        <li class="nav-item"><a
                class="nav-link <?php echo(in_array($action, array('index', 'bid')) ? 'active' : ''); ?>"
                href="<?php echo Yii::app()->createUrl('/admin'); ?>"> Лист заявок </a></li>
        <li class="nav-item mr-4"><a class="nav-link <?php echo($action == 'stat' ? 'active' : ''); ?>"
                                     href="<?php echo Yii::app()->createUrl('/admin/stat'); ?>"> Статистика</a></li>

    <?php } else { ?>
        <li class="nav-item"><a
                class="nav-link <?php echo((($controller == 'profile') && in_array($action, array('index', 'bid'))) ? 'active' : ''); ?>"
                href="<?php echo Yii::app()->createUrl('/profile/index'); ?>"> Лист заявок </a></li>
    <?php } ?>
</ul>