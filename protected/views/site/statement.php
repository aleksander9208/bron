<?php
if (Yii::app()->user->hasFlash('q_error')) {
    echo '<div id="page_profile_changer_send_alert" class="alert alert-danger" role="alert">' . Yii::app()->user->getFlash('q_error') . '</div>';
}
if (Yii::app()->user->hasFlash('q_done')) {
    echo '<div id="page_profile_changer_send_alert" class="alert alert-success" role="alert">Заявка успешон отправлена</div>';
}
?>

<?php echo CHtml::form(); ?>

<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'type'); ?></label>
    <?php echo CHtml::activeRadioButtonList($model, 'type', Questionnaire::getTypeName()); ?>
</div>


<!--UR START-->
<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'name_ur'); ?></label>
    <?php echo CHtml::activeTextField($model, 'name_ur', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('name_ur'))); ?>
</div>

<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'fio_ur_contact'); ?></label>
    <?php echo CHtml::activeTextField($model, 'fio_ur_contact', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('fio_ur_contact'))); ?>
</div>
<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'tel_ur_contact'); ?></label>
    <?php echo CHtml::activeTextField($model, 'tel_ur_contact', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('tel_ur_contact'))); ?>
</div>
<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'email_ur_contact'); ?></label>
    <?php echo CHtml::activeTextField($model, 'email_ur_contact', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('email_ur_contact'))); ?>
</div>
<!--UR END-->
<hr>
<!--FIZ START-->

<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'fio_parent'); ?></label>
    <?php echo CHtml::activeTextField($model, 'fio_parent', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('fio_parent'))); ?>
</div>

<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'residence'); ?></label>
    <?php echo CHtml::activeTextField($model, 'residence', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('residence'))); ?>
</div>
<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'place_of_work'); ?></label>
    <?php echo CHtml::activeTextField($model, 'place_of_work', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('place_of_work'))); ?>
</div>
<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'email_parent'); ?></label>
    <?php echo CHtml::activeTextField($model, 'email_parent', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('email_parent'))); ?>
</div>
<!--FIZ END-->
<hr>

<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'fio_child'); ?></label>
    <?php echo CHtml::activeTextField($model, 'fio_child', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('fio_child'))); ?>
</div>

<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'birthday_child'); ?></label>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'birthday_child',
        'attribute' => 'birthday_child',
        'model'=>$model,
        'options'=> array(
            'locale' => 'ru',
            'defaultTimeZone' => 'Europe/Moscow',
            'dateFormat' =>'yy-mm-dd',
        //    'defaultDate' => $model->birthday_child,
            'altFormat' =>'yy-mm-dd',
            'changeMonth' => true,
            'changeYear' => true,
            'appendText' => 'yyyy-mm-dd',
            'yearRange' => '-18:+0',
        ),
    ));

    ?>


</div>
<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'place_of_study'); ?></label>
    <?php echo CHtml::activeTextField($model, 'place_of_study', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('place_of_study'))); ?>
</div>

<div class="block form-group mb-4 wn_wog_is_oldyear_hide">
    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'tel_parent'); ?></label>
    <?php echo CHtml::activeTextField($model, 'tel_parent', array('class' => 'form-control col-lg-4', 'placeholder' => $model->getAttributeLabel('tel_parent'))); ?>
</div>

<?php
echo CHtml::textField('Shifts[]',Questionnaire::SHIFT_BONFIRE_2);
echo CHtml::textField('Shifts[]',Questionnaire::SHIFT_KIROVEC_1);

echo CHtml::textField('Dlos[]',Questionnaire::DLO_4);
echo CHtml::textField('Dlos[]',Questionnaire::DLO_1);


?>

<?php echo CHtml::submitButton('Подать заявку', array('class' => 'btn btn-success')); ?>

<?php echo CHtml::endForm(); ?>
