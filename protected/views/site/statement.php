<div id="z_page_anketa" class="container-fluid z_anketa_block_<?php echo $model->type;?>">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>
            <div id="page_profile_changer_send_alert" class="alert <?php echo (Yii::app()->user->hasFlash('q_error')?'alert-danger':(Yii::app()->user->hasFlash('q_done')?'alert-success':'d-none')); ?>" role="alert">
                <?php echo (Yii::app()->user->hasFlash('q_error')?Yii::app()->user->getFlash('q_error'):''); ?>
                <?php echo (Yii::app()->user->hasFlash('q_done')?'Заявка успешно отправлена':''); ?>
            </div>
            <?php echo CHtml::form('', 'post', array('class' => 'needs-validation', 'id'=>'z_anketa_form')); ?>

            <?php if ($user->checkAccess(User::ROLE_ADMIN)) { ?>
                <div class="form-group">
                    <?php echo CHtml::activeLabel($model, 'created', array('for'=>'z_anketa_created')); ?>
                    <?php echo $model->created;
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'created',
                        'attribute' => 'created',
                        'model' => $model,
                        'language' => 'ru',
                        'options' => array(
                            'locale' => 'ru',
                            'defaultTimeZone' => 'Europe/Moscow',
                            'dateFormat' => 'dd-mm-yy 00:00:00',
                            'defaultDate' => date("d-m-Y 00:00:00"), //$model->birthday_child,
                            'altFormat' => 'dd-mm-yy 00:00:00',
                            'changeMonth' => true,
                            'changeYear' => true,
                            //'appendText' => 'yyyy-mm-dd',
                            'yearRange' => '-18:+0',
                        ),
                        'htmlOptions' => array(
                            'class' => 'form-control',
                            'id'=>'z_anketa_created',
                            'required'  =>'required',
                            'data-mask' =>'01234567890-: ',
                            'maxlength'=>19
                        ),
                    )); ?>
                </div>
            <?php } ?>

            <!--TYPE BLOCK START-->
            <div class="form-group" id="z_anketa_types">
                <div><?php echo CHtml::activeLabel($model, 'type'); ?></div>
                <div class="form-check form-check-inline">
                    <?php echo CHtml::activeRadioButton($model, 'type', array('value' => Questionnaire::TYPE_FIZ, 'id' => 'z_anketa_type_' . Questionnaire::TYPE_FIZ, 'class'=>'form-check-input')); ?>
                    <label class="form-check-label" for="z_anketa_type_<?php echo Questionnaire::TYPE_FIZ; ?>"><?php echo Questionnaire::getTypeName(Questionnaire::TYPE_FIZ); ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <?php echo CHtml::activeRadioButton($model, 'type', array('value' => Questionnaire::TYPE_UR, 'id' => 'z_anketa_type_' . Questionnaire::TYPE_UR, 'class'=>'form-check-input')); ?>
                    <label class="form-check-label" for="z_anketa_type_<?php echo Questionnaire::TYPE_UR; ?>"><?php echo Questionnaire::getTypeName(Questionnaire::TYPE_UR); ?></label>
                </div>
            </div>
            <!--TYPE BLOCK END-->

            <hr/>

            <!--UR START-->
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>">
                <?php echo CHtml::activeLabel($model, 'name_ur', array('for'=>'z_anketa_name_ur')); ?>
                <?php echo CHtml::activeTextField($model, 'name_ur', array((Questionnaire::TYPE_UR==$model->type?'_':'').'disabled'=>'disabled', 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name_ur'), 'required'=>'required', 'id'=>'z_anketa_name_ur')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>">
                <?php echo CHtml::activeLabel($model, 'fio_ur_contact', array('for'=>'z_anketa_fio_ur_contact')); ?>
                <?php echo CHtml::activeTextField($model, 'fio_ur_contact', array((Questionnaire::TYPE_UR==$model->type?'_':'').'disabled'=>'disabled', 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_fio_ur_contact', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>">
                <?php echo CHtml::activeLabel($model, 'tel_ur_contact', array('for'=>'z_anketa_tel_ur_contact')); ?>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">+7</div>
                    </div>
                    <?php echo CHtml::activeTextField($model, 'tel_ur_contact', array((Questionnaire::TYPE_UR==$model->type?'_':'').'disabled'=>'disabled', 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_tel_ur_contact', 'maxlength'=>15, 'data-mask'=>'0123456789')); ?>
                    <div class="invalid-feedback">Заполните поле корректно</div>
                </div>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>">
                <?php echo CHtml::activeLabel($model, 'email_ur_contact', array('for'=>'z_anketa_email_ur_contact')); ?>
                <?php echo CHtml::activeTextField($model, 'email_ur_contact', array((Questionnaire::TYPE_UR==$model->type?'_':'').'disabled'=>'disabled', 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_email_ur_contact')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>

            <hr class="z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>"/>
            <!--UR END-->

            <!--FIZ START-->
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'fio_parent', array('for'=>'z_anketa_fio_parent')); ?>
                <?php echo CHtml::activeTextField($model, 'fio_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_parent'), 'required'=>'required', 'id'=>'z_anketa_fio_parent', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'residence', array('for'=>'z_anketa_residence')); ?>
                <?php echo CHtml::activeTextField($model, 'residence', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('residence'), 'required'=>'required', 'id'=>'z_anketa_residence')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'place_of_work', array('for'=>'z_anketa_place_of_work')); ?>
                <?php echo CHtml::activeTextField($model, 'place_of_work', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('place_of_work'), 'required'=>'required', 'id'=>'z_anketa_place_of_work')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'email_parent', array('for'=>'z_anketa_email_parent')); ?>
                <?php echo CHtml::activeTextField($model, 'email_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email_parent'), 'required'=>'required', 'id'=>'z_anketa_email_parent')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <!--FIZ END-->

            <hr />

            <!--CHILD DATA START-->
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'fio_child', array('for'=>'z_anketa_fio_child')); ?>
                <?php echo CHtml::activeTextField($model, 'fio_child', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_child'), 'required'=>'required', 'id'=>'z_anketa_fio_child', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'birthday_child', array('for' => 'z_anketa_birthday_child')); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'birthday_child',
                    'attribute' => 'birthday_child',
                    'model' => $model,
                    'language' => 'ru',
                    'options' => array(
                        'locale' => 'ru',
                        'defaultTimeZone' => 'Europe/Moscow',
                        'dateFormat' => 'dd-mm-yy',
                        //    'defaultDate' => $model->birthday_child,
                        'altFormat' => 'dd-mm-yy',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => '-18:+0',
                    ),
                    'htmlOptions' => array(
                        'class' => 'form-control',
                        'id'    => 'z_anketa_birthday_child',
                        'required'  =>'required',
                        'data-mask' =>'01234567890-',
                        'maxlength'=>10
                    ),
                ));
                ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'place_of_study', array('for'=>'z_anketa_place_of_study')); ?>
                <?php echo CHtml::activeTextField($model, 'place_of_study', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('place_of_study'), 'required'=>'required', 'id'=>'z_anketa_place_of_study')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'tel_parent', array('for'=>'z_anketa_tel_parent')); ?>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">+7</div>
                    </div>
                    <?php echo CHtml::activeTextField($model, 'tel_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_parent'), 'required'=>'required', 'id'=>'z_anketa_tel_parent', 'maxlength'=>15, 'data-mask'=>'0123456789')); ?>
                    <div class="invalid-feedback">Заполните поле корректно</div>
                </div>
            </div>
            <!--CHILD DATA END-->

            <hr />

            <label for="z_anketa_table">Сводная таблица лагерей и смен</label>
            <table id="z_anketa_table" class="table table-bordered table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Лагерь</th>
                        <th scope="col" class="text-center">Рекомендуемый возраст</th>
                        <th scope="col" class="text-center"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_1); ?></th>
                        <th scope="col" class="text-center"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_2); ?></th>
                        <th scope="col" class="text-center"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_3); ?></th>
                        <th scope="col" class="text-center"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_4); ?></th>
                        <th scope="col" class="text-center"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_5); ?></th>
                        <th scope="col" class="text-center"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_6); ?></th>
                        <th scope="col" class="text-center"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_7); ?></th>
                        <th scope="col" class="text-center"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_8); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_KIROVEC); ?></th>
                        <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_KIROVEC_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_KIROVEC_1]['max_age'];?> лет</td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_1; ?>" data-shift="<?php echo Questionnaire::SHIFT_KIROVEC_1; ?>">
                            <?php echo SiteService::templateChecker('Смена 1',Questionnaire::SHIFT_KIROVEC_1, $seats[Questionnaire::SHIFT_KIROVEC_1]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_1]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_1]['min_age'],$shifts[Questionnaire::SHIFT_KIROVEC_1]['max_age'], $postShifts, '1'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_2; ?>" data-shift="<?php echo Questionnaire::SHIFT_KIROVEC_2; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 2',Questionnaire::SHIFT_KIROVEC_2, $seats[Questionnaire::SHIFT_KIROVEC_2]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_2]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_2]['min_age'],$shifts[Questionnaire::SHIFT_KIROVEC_2]['max_age'], $postShifts, '2,3'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_4; ?>" data-shift="<?php echo Questionnaire::SHIFT_KIROVEC_3; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 3',Questionnaire::SHIFT_KIROVEC_3, $seats[Questionnaire::SHIFT_KIROVEC_3]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_3]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_3]['min_age'],$shifts[Questionnaire::SHIFT_KIROVEC_3]['max_age'], $postShifts, '4,5'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_6; ?>" data-shift="<?php echo Questionnaire::SHIFT_KIROVEC_4; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 4',Questionnaire::SHIFT_KIROVEC_4, $seats[Questionnaire::SHIFT_KIROVEC_4]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_4]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_4]['min_age'],$shifts[Questionnaire::SHIFT_KIROVEC_4]['max_age'], $postShifts, '6,7'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_8; ?>" data-shift="<?php echo Questionnaire::SHIFT_KIROVEC_5; ?>">
                            <?php echo SiteService::templateChecker('Смена 5',Questionnaire::SHIFT_KIROVEC_5, $seats[Questionnaire::SHIFT_KIROVEC_5]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_5]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_5]['min_age'],$shifts[Questionnaire::SHIFT_KIROVEC_5]['max_age'], $postShifts, '8'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_BLUESCREEN); ?></th>
                        <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_BLUESCREEN_1]['min_age']; ?> до 10 лет</td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_1; ?>" data-shift="<?php echo Questionnaire::SHIFT_BLUESCREEN_1; ?>">
                            <?php echo SiteService::templateChecker('Смена 1',Questionnaire::SHIFT_BLUESCREEN_1, $seats[Questionnaire::SHIFT_BLUESCREEN_1]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_1]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_1]['min_age'],$shifts[Questionnaire::SHIFT_BLUESCREEN_1]['max_age'], $postShifts, '1'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_2; ?>" data-shift="<?php echo Questionnaire::SHIFT_BLUESCREEN_2; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 2',Questionnaire::SHIFT_BLUESCREEN_2, $seats[Questionnaire::SHIFT_BLUESCREEN_2]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_2]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_2]['min_age'],$shifts[Questionnaire::SHIFT_BLUESCREEN_2]['max_age'], $postShifts, '2,3'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_4; ?>" data-shift="<?php echo Questionnaire::SHIFT_BLUESCREEN_3; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 3',Questionnaire::SHIFT_BLUESCREEN_3, $seats[Questionnaire::SHIFT_BLUESCREEN_3]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_3]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_3]['min_age'],$shifts[Questionnaire::SHIFT_BLUESCREEN_3]['max_age'], $postShifts, '4,5'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_6; ?>" data-shift="<?php echo Questionnaire::SHIFT_BLUESCREEN_4; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 4',Questionnaire::SHIFT_BLUESCREEN_4, $seats[Questionnaire::SHIFT_BLUESCREEN_4]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_4]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_4]['min_age'],$shifts[Questionnaire::SHIFT_BLUESCREEN_4]['max_age'], $postShifts, '6,7'); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_EAST_4); ?></th>
                        <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_EAST_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_EAST_1]['max_age'];?> лет</td>
                        <td>&nbsp;</td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_2; ?>" data-shift="<?php echo Questionnaire::SHIFT_EAST_1; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 1',Questionnaire::SHIFT_EAST_1, $seats[Questionnaire::SHIFT_EAST_1]['seats'], $shifts[Questionnaire::SHIFT_EAST_1]['seats'], $shifts[Questionnaire::SHIFT_EAST_1]['min_age'],$shifts[Questionnaire::SHIFT_EAST_1]['max_age'], $postShifts, '2,3'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_4; ?>" data-shift="<?php echo Questionnaire::SHIFT_EAST_2; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 2',Questionnaire::SHIFT_EAST_2, $seats[Questionnaire::SHIFT_EAST_2]['seats'], $shifts[Questionnaire::SHIFT_EAST_2]['seats'], $shifts[Questionnaire::SHIFT_EAST_2]['min_age'],$shifts[Questionnaire::SHIFT_EAST_2]['max_age'], $postShifts, '4,5'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_6; ?>" data-shift="<?php echo Questionnaire::SHIFT_EAST_3; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 3',Questionnaire::SHIFT_EAST_3, $seats[Questionnaire::SHIFT_EAST_3]['seats'], $shifts[Questionnaire::SHIFT_EAST_3]['seats'], $shifts[Questionnaire::SHIFT_EAST_3]['min_age'],$shifts[Questionnaire::SHIFT_EAST_3]['max_age'], $postShifts, '6,7'); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_DIAMOND); ?></th>
                        <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_DIAMOND_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_DIAMOND_1]['max_age'];?> лет</td>
                        <td>&nbsp;</td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_2; ?>" data-shift="<?php echo Questionnaire::SHIFT_DIAMOND_1; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 1',Questionnaire::SHIFT_DIAMOND_1, $seats[Questionnaire::SHIFT_DIAMOND_1]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_1]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_1]['min_age'],$shifts[Questionnaire::SHIFT_DIAMOND_1]['max_age'], $postShifts, '2,3'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_4; ?>" data-shift="<?php echo Questionnaire::SHIFT_DIAMOND_2; ?>" >
                            <?php echo SiteService::templateChecker('Смена 2',Questionnaire::SHIFT_DIAMOND_2, $seats[Questionnaire::SHIFT_DIAMOND_2]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_2]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_2]['min_age'],$shifts[Questionnaire::SHIFT_DIAMOND_2]['max_age'], $postShifts, '4'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_5; ?>" data-shift="<?php echo Questionnaire::SHIFT_DIAMOND_3; ?>">
                            <?php echo SiteService::templateChecker('Смена 3',Questionnaire::SHIFT_DIAMOND_3, $seats[Questionnaire::SHIFT_DIAMOND_3]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_3]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_3]['min_age'],$shifts[Questionnaire::SHIFT_DIAMOND_3]['max_age'], $postShifts, '5'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_6; ?>" data-shift="<?php echo Questionnaire::SHIFT_DIAMOND_4; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 4',Questionnaire::SHIFT_DIAMOND_4, $seats[Questionnaire::SHIFT_DIAMOND_4]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_4]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_4]['min_age'],$shifts[Questionnaire::SHIFT_DIAMOND_4]['max_age'], $postShifts, '6,7'); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_BONFIRE); ?></th>
                        <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_BONFIRE_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_BONFIRE_1]['max_age'];?> лет</td>
                        <td>&nbsp;</td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_2; ?>" data-shift="<?php echo Questionnaire::SHIFT_BONFIRE_1; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 1',Questionnaire::SHIFT_BONFIRE_1, $seats[Questionnaire::SHIFT_BONFIRE_1]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_1]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_1]['min_age'],$shifts[Questionnaire::SHIFT_BONFIRE_1]['max_age'], $postShifts, '2,3'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_4; ?>" data-shift="<?php echo Questionnaire::SHIFT_BONFIRE_2; ?>" >
                            <?php echo SiteService::templateChecker('Смена 2',Questionnaire::SHIFT_BONFIRE_2, $seats[Questionnaire::SHIFT_BONFIRE_2]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_2]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_2]['min_age'],$shifts[Questionnaire::SHIFT_BONFIRE_2]['max_age'], $postShifts, '4'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_5; ?>" data-shift="<?php echo Questionnaire::SHIFT_BONFIRE_3; ?>">
                            <?php echo SiteService::templateChecker('Смена 3',Questionnaire::SHIFT_BONFIRE_3, $seats[Questionnaire::SHIFT_BONFIRE_3]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_3]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_3]['min_age'],$shifts[Questionnaire::SHIFT_BONFIRE_3]['max_age'], $postShifts, '5'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_6; ?>" data-shift="<?php echo Questionnaire::SHIFT_BONFIRE_4; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 4',Questionnaire::SHIFT_BONFIRE_4, $seats[Questionnaire::SHIFT_BONFIRE_4]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_4]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_4]['min_age'],$shifts[Questionnaire::SHIFT_BONFIRE_4]['max_age'], $postShifts, '6,7'); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_LIGHTHOUSE); ?></th>
                        <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['max_age'];?> лет</td>
                        <td>&nbsp;</td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_2; ?>" data-shift="<?php echo Questionnaire::SHIFT_LIGHTHOUSE_1; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 1',Questionnaire::SHIFT_LIGHTHOUSE_1, $seats[Questionnaire::SHIFT_LIGHTHOUSE_1]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['min_age'],$shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['max_age'], $postShifts, '2,3'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_4; ?>" data-shift="<?php echo Questionnaire::SHIFT_LIGHTHOUSE_2; ?>" colspan="2">
                            <?php echo SiteService::templateChecker('Смена 2',Questionnaire::SHIFT_LIGHTHOUSE_2, $seats[Questionnaire::SHIFT_LIGHTHOUSE_2]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_2]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_2]['min_age'],$shifts[Questionnaire::SHIFT_LIGHTHOUSE_2]['max_age'], $postShifts, '4,5'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_6; ?>" data-shift="<?php echo Questionnaire::SHIFT_LIGHTHOUSE_3; ?>">
                            <?php echo SiteService::templateChecker('Смена 3',Questionnaire::SHIFT_LIGHTHOUSE_3, $seats[Questionnaire::SHIFT_LIGHTHOUSE_3]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_3]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_3]['min_age'],$shifts[Questionnaire::SHIFT_LIGHTHOUSE_3]['max_age'], $postShifts, '6'); ?>
                        </td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_FLYGHT); ?></th>
                        <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_FLYGHT_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_FLYGHT_1]['max_age'];?> лет</td>
                        <td>&nbsp;</td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_2; ?>" data-shift="<?php echo Questionnaire::SHIFT_FLYGHT_1; ?>">
                            <?php echo SiteService::templateChecker('Смена 1',Questionnaire::SHIFT_FLYGHT_1, $seats[Questionnaire::SHIFT_FLYGHT_1]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_1]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_1]['min_age'],$shifts[Questionnaire::SHIFT_FLYGHT_1]['max_age'], $postShifts, '2'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_3; ?>" data-shift="<?php echo Questionnaire::SHIFT_FLYGHT_2; ?>">
                            <?php echo SiteService::templateChecker('Смена 2',Questionnaire::SHIFT_FLYGHT_2, $seats[Questionnaire::SHIFT_FLYGHT_2]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_2]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_2]['min_age'],$shifts[Questionnaire::SHIFT_FLYGHT_2]['max_age'], $postShifts, '3'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_4; ?>" data-shift="<?php echo Questionnaire::SHIFT_FLYGHT_3; ?>">
                            <?php echo SiteService::templateChecker('Смена 3',Questionnaire::SHIFT_FLYGHT_3, $seats[Questionnaire::SHIFT_FLYGHT_3]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_3]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_3]['min_age'],$shifts[Questionnaire::SHIFT_FLYGHT_3]['max_age'], $postShifts, '4'); ?>
                        </td>
                        <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_5; ?>" data-shift="<?php echo Questionnaire::SHIFT_FLYGHT_4; ?>">
                            <?php echo SiteService::templateChecker('Смена 4',Questionnaire::SHIFT_FLYGHT_4, $seats[Questionnaire::SHIFT_FLYGHT_4]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_4]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_4]['min_age'],$shifts[Questionnaire::SHIFT_FLYGHT_4]['max_age'], $postShifts, '5'); ?>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>

                </tbody>
            </table>

            <div class="form-group text-right">
                <?php echo CHtml::submitButton('Подать заявку на регистрацию', array('class' => 'btn btn-success')); ?>
            </div>

            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>