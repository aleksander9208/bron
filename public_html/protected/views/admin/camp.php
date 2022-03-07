<div id="z_page_admin_camp" class="container-fluid">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>
            <div id="z_page_admin_camp_alert" class="alert <?php echo (Yii::app()->user->hasFlash('r_error')?'alert-danger':(Yii::app()->user->hasFlash('r_done')?'alert-success':'')); ?>" role="alert">
                <?php echo (Yii::app()->user->hasFlash('r_error')?Yii::app()->user->getFlash('r_error'):''); ?>
                <?php echo (Yii::app()->user->hasFlash('r_done')?Yii::app()->user->getFlash('r_done'):''); ?>
            </div>
            <?php echo CHtml::form('', 'post', array('class' => 'needs-validation', 'id' => 'z_anketa_form', 'novalidate' => 'novalidate')); ?>

            <label for="z_anketa_camp_table">Форма редактирования лагерей</label>

            <div class="form-group text-right">
                <?php echo CHtml::submitButton('Применить', array('class' => 'btn btn-success')); ?>
            </div>

            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>
