<ul class="navbar-nav mr-auto">
    <li class="nav-item"><a class="nav-link <?php echo($action == 'index' ? 'active' : ''); ?>" href="<?php echo Yii::app()->createUrl('/site'); ?>">Cобытия</a></li>
    <li class="nav-item"><a class="nav-link <?php echo($action == 'mybets' ? 'active' : ''); ?>" href="<?php echo Yii::app()->createUrl('/site/mybets'); ?>">Мои ставки</a></li>
    <li id="fb_user_name" class="nav-item font-weight-bold p-2">Клиент №<?php echo  (int)$user->id; ?></li>
</ul>