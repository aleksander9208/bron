<ul class="navbar-nav mr-auto">
    <li class="nav-item"><a class="nav-link <?php echo($action == 'index' ? 'active' : ''); ?>" href="<?php echo Yii::app()->createUrl('/admin'); ?>">Спортивные события</a></li>
    <li class="nav-item mr-4"><a class="nav-link <?php echo($action == 'myeventslist' ? 'active' : ''); ?>" href="<?php echo Yii::app()->createUrl('/admin/myeventslist'); ?>">Мои события</a></li>
    <li id="fb_user_name" class="nav-item font-weight-bold p-2">Иванов Иван</li>
</ul>