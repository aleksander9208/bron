<div id="wna_page_finance" class="container-fluid">
    <div class="mb-4"></div>
    <div class="clearfix mb-4">
        <h1><?php echo CHtml::encode($title); ?></h1>
    </div>
    <div class="container" id="orderForm">
        <?php echo CHtml::form(); ?>
        <?php
        if (Yii::app()->user->hasFlash('q_error')) {
            echo '<div id="page_profile_changer_send_alert" class="alert alert-danger" role="alert">' . Yii::app()->user->getFlash('q_error') . '</div>';
        }
        if (Yii::app()->user->hasFlash('q_done')) {
            echo '<div id="page_profile_changer_send_alert" class="alert alert-success" role="alert">Заявка успешон отправлена</div>';
        }
        ?>


        <?php if ($user->checkAccess(User::ROLE_ADMIN)) { ?>
            <div class="row">
                <div class="col-12 form-inline">
                    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'created'); ?></label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'created',
                        'attribute' => 'created',
                        'model' => $model,
                        'language' => 'ru',
                        'options' => array(
                            'locale' => 'ru',
                            'defaultTimeZone' => 'Europe/Moscow',
                            'dateFormat' => 'yy-mm-dd',
                            'defaultDate' => date("Y-m-d"), //$model->birthday_child,
                            'altFormat' => 'yy-mm-dd',
                            'changeMonth' => true,
                            'changeYear' => true,
                            //  'appendText' => 'yyyy-mm-dd',
                            'yearRange' => '-18:+0',
                        ),
                        'htmlOptions' => array('class' => 'form-control  col-lg-4'),
                    )); ?>
                </div>
            </div>
        <?php } ?>
        <!--TYPE BLOCK START-->
        <div class="row">
            <div class="mx-auto">
                <div class="form-check form-check-inline">
                    <?php echo CHtml::activeRadioButton($model, 'type', array('value' => Questionnaire::TYPE_FIZ, 'id' => 'Questionnaire_type_' . Questionnaire::TYPE_FIZ)); ?>
                    <label class="form-check-label"
                           for="Questionnaire_type_2"> <?php echo Questionnaire::getTypeName(Questionnaire::TYPE_FIZ); ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <?php echo CHtml::activeRadioButton($model, 'type', array('value' => Questionnaire::TYPE_UR, 'id' => 'Questionnaire_type_' . Questionnaire::TYPE_UR)); ?>
                    <label class="form-check-label"
                           for="Questionnaire_type_1"> <?php echo Questionnaire::getTypeName(Questionnaire::TYPE_UR); ?></label>
                </div>
            </div>
        </div>
        <hr>
        <!--TYPE BLOCK END-->
        <!--UR START-->
        <div id="ur_block" class="<?php echo(($model->type == Questionnaire::TYPE_UR) ? '' : 'd-none '); ?>row">
            <div class="col-sm">
                <div class="block form-group mb-4 wn_wog_is_oldyear_hide ">
                    <label for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'name_ur'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'name_ur', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name_ur'))); ?>
                </div>

                <div class="block form-group mb-4 wn_wog_is_oldyear_hide">
                    <label
                        for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'fio_ur_contact'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'fio_ur_contact', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_ur_contact'))); ?>
                </div>
            </div>
            <div class="col-sm">
                <div class="block form-group mb-4 wn_wog_is_oldyear_hide">
                    <label
                        for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'tel_ur_contact'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'tel_ur_contact', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_ur_contact'))); ?>
                </div>
                <div class="block form-group mb-4 wn_wog_is_oldyear_hide">
                    <label
                        for="WogMembership_card_num"><?php echo CHtml::activeLabel($model, 'email_ur_contact'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'email_ur_contact', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email_ur_contact'))); ?>
                </div>
            </div>
        </div>
        <!--UR END-->

        <div class="row">
            <div class="col-sm">
                <!--FIZ START-->
                <div class="form-group">
                    <label
                        for="Questionnaire_fio_parent"><?php echo CHtml::activeLabel($model, 'fio_parent'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'fio_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_parent'))); ?>
                </div>
                <div class="form-group">
                    <label
                        for="Questionnaire_residence"><?php echo CHtml::activeLabel($model, 'residence'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'residence', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('residence'))); ?>
                </div>
                <div class="form-group">
                    <label
                        for="Questionnaire_place_of_work"><?php echo CHtml::activeLabel($model, 'place_of_work'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'place_of_work', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('place_of_work'))); ?>
                </div>
                <div class="form-group">
                    <label
                        for="Questionnaire_email_parent"><?php echo CHtml::activeLabel($model, 'email_parent'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'email_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email_parent'))); ?>
                </div>
                <!--FIZ END-->
            </div>
            <div class="col-sm">
                <!--CHILD DATA START-->
                <div class="form-group">
                    <label
                        for="Questionnaire_fio_child"><?php echo CHtml::activeLabel($model, 'fio_child'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'fio_child', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_child'))); ?>
                </div>

                <div class="form-group">
                    <label
                        for="Questionnaire_birthday_child"><?php echo CHtml::activeLabel($model, 'birthday_child'); ?></label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'birthday_child',
                        'attribute' => 'birthday_child',
                        'model' => $model,
                        'language' => 'ru',
                        'options' => array(
                            'locale' => 'ru',
                            'defaultTimeZone' => 'Europe/Moscow',
                            'dateFormat' => 'yy-mm-dd',
                            //    'defaultDate' => $model->birthday_child,
                            'altFormat' => 'yy-mm-dd',
                            'changeMonth' => true,
                            'changeYear' => true,
                            'yearRange' => '-18:+0',
                        ),
                        'htmlOptions' => array('class' => 'form-control  col-lg-4'),
                    ));

                    ?>
                </div>
                <div class="form-group">
                    <label
                        for="Questionnaire_place_of_study"><?php echo CHtml::activeLabel($model, 'place_of_study'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'place_of_study', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('place_of_study'))); ?>
                </div>

                <div class="form-group">
                    <label
                        for="Questionnaire_tel_parent"><?php echo CHtml::activeLabel($model, 'tel_parent'); ?></label>
                    <?php echo CHtml::activeTextField($model, 'tel_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_parent'))); ?>
                </div>
                <!--CHILD DATA END-->
            </div>
        </div>

        <!--CAMP DATA START-->
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="Questionnaire_camp_id">Лагерь</label>
                    <?php echo CHtml::dropDownList('Questionnaire[camp_id]', $model->camp_id, Questionnaire::getCAMPName(), array('class' => 'custom-select col-lg-4')); ?>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="shift">Смена</label>
                    <?php echo CHtml::dropDownList('Shifts[]', $model->shift_id, Questionnaire::getShiftsByParams($model->camp_id), array('class' => 'custom-select col-lg-4')); ?>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="shift">Период</label>
                    <?php echo CHtml::dropDownList('Dlos[]', 0, Questionnaire::getDLOSByParams($model->camp_id,$model->shift_id), array('class' => 'custom-select col-lg-4')); ?>
                </div>
            </div>
        </div>
        <!--CAMP DATA END-->

        <?php
        /*echo CHtml::textField('Shifts[]', Questionnaire::SHIFT_BONFIRE_2);
        echo CHtml::textField('Shifts[]', Questionnaire::SHIFT_KIROVEC_1);

        echo CHtml::textField('Dlos[]', Questionnaire::DLO_4);
        echo CHtml::textField('Dlos[]', Questionnaire::DLO_1);*/
        ?>
<hr>
        <div class="col-xs-12">
        <?php echo CHtml::submitButton('Подать заявление на регистрацию', array('class' => 'btn btn-success float-right')); ?>
</div>
        <?php echo CHtml::endForm(); ?>
    </div>
</div>