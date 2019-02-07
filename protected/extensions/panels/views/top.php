<div id="z_nav" class="container-fluid mb-5">
    <div class="row mb-2">
        <div class="col">
            Вы вошли как: <strong><?php echo Yii::app()->user->login; ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <a class="nav-item btn btn-primary mr-2 <?php echo(in_array($action, array('addstatement')) ? 'active' : ''); ?>" href="<?php echo Yii::app()->createUrl('/site/addstatement'); ?>">Подать заявку</a>
            <a class="nav-item btn btn-primary mr-2 <?php echo((($controller == 'profile') && in_array($action, array('index', 'bid'))) ? 'active' : ''); ?>" href="<?php echo Yii::app()->createUrl('/profile'); ?>">Мои заявки</a>
        </div>
        <div class="col-4 text-right">
            <a class="nav-item btn btn-primary" href="<?php echo Yii::app()->createUrl('/auth/logout'); ?>">Выход</a>
        </div>
    </div>
</div>