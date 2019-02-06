<div id="z_page_anketa" class="container-fluid z_anketa_block_<?php echo $model->type;?>">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>
            <div id="page_profile_changer_send_alert" class="alert <?php echo (Yii::app()->user->hasFlash('q_error')?'alert-danger':(Yii::app()->user->hasFlash('q_done')?'alert-success':'')); ?>" role="alert">
                <?php echo (Yii::app()->user->hasFlash('q_error')?Yii::app()->user->getFlash('q_error'):''); ?>
                <?php echo (Yii::app()->user->hasFlash('q_done')?'Заявка успешон отправлена':''); ?>
            </div>
            <?php echo CHtml::form('', 'post', array('class' => 'needs-validation', 'id'=>'z_anketa_form')); ?>

            <?php if ($user->checkAccess(User::ROLE_ADMIN)) { ?>
                <div class="form-group">
                    <?php echo CHtml::activeLabel($model, 'created', array('for'=>'z_anketa_created')); ?>
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
                        'htmlOptions' => array(
                            'class' => 'form-control',
                            'id'=>'z_anketa_created'
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

            <!--FIZ START-->
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_FIZ; ?>">
                <?php echo CHtml::activeLabel($model, 'fio_parent', array('for'=>'z_anketa_fio_parent')); ?>
                <?php echo CHtml::activeTextField($model, 'fio_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_parent'), 'required'=>'required', 'id'=>'z_anketa_fio_parent', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-')); ?>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_FIZ; ?>">
                <?php echo CHtml::activeLabel($model, 'residence', array('for'=>'z_anketa_residence')); ?>
                <?php echo CHtml::activeTextField($model, 'residence', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('residence'), 'required'=>'required', 'id'=>'z_anketa_residence')); ?>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_FIZ; ?>">
                <?php echo CHtml::activeLabel($model, 'place_of_work', array('for'=>'z_anketa_place_of_work')); ?>
                <?php echo CHtml::activeTextField($model, 'place_of_work', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('place_of_work'), 'required'=>'required', 'id'=>'z_anketa_place_of_work')); ?>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_FIZ; ?>">
                <?php echo CHtml::activeLabel($model, 'email_parent', array('for'=>'z_anketa_email_parent')); ?>
                <?php echo CHtml::activeTextField($model, 'email_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email_parent'), 'required'=>'required', 'id'=>'z_anketa_email_parent')); ?>
            </div>
            <!--FIZ END-->

            <!--UR START-->
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>">
                <?php echo CHtml::activeLabel($model, 'name_ur', array('for'=>'z_anketa_name_ur')); ?>
                <?php echo CHtml::activeTextField($model, 'name_ur', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name_ur'), 'required'=>'required', 'id'=>'z_anketa_name_ur')); ?>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>">
                <?php echo CHtml::activeLabel($model, 'fio_ur_contact', array('for'=>'z_anketa_fio_ur_contact')); ?>
                <?php echo CHtml::activeTextField($model, 'fio_ur_contact', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_fio_ur_contact', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-')); ?>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>">
                <?php echo CHtml::activeLabel($model, 'tel_ur_contact', array('for'=>'z_anketa_tel_ur_contact')); ?>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">+7</div>
                    </div>
                    <?php echo CHtml::activeTextField($model, 'tel_ur_contact', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_tel_ur_contact', 'maxlength'=>10, 'data-mask'=>'0123456789')); ?>
                </div>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>">
                <?php echo CHtml::activeLabel($model, 'email_ur_contact', array('for'=>'z_anketa_email_ur_contact')); ?>
                <?php echo CHtml::activeTextField($model, 'email_ur_contact', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_email_ur_contact')); ?>
            </div>
            <!--UR END-->

            <hr />

            <!--CHILD DATA START-->
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'fio_child', array('for'=>'z_anketa_fio_child')); ?>
                <?php echo CHtml::activeTextField($model, 'fio_child', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_child'), 'required'=>'required', 'id'=>'z_anketa_fio_child', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-')); ?>
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
                        'dateFormat' => 'yy-mm-dd',
                        //    'defaultDate' => $model->birthday_child,
                        'altFormat' => 'yy-mm-dd',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => '-18:+0',
                    ),
                    'htmlOptions' => array(
                        'class' => 'form-control',
                        'id'    => 'z_anketa_birthday_child',
                        'required'=>'required'
                    ),
                ));

                ?>
            </div>
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'place_of_study', array('for'=>'z_anketa_place_of_study')); ?>
                <?php echo CHtml::activeTextField($model, 'place_of_study', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('place_of_study'), 'required'=>'required', 'id'=>'z_anketa_place_of_study')); ?>
            </div>
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'tel_parent', array('for'=>'z_anketa_tel_parent')); ?>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">+7</div>
                    </div>
                    <?php echo CHtml::activeTextField($model, 'tel_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_parent'), 'required'=>'required', 'id'=>'z_anketa_tel_parent', 'maxlength'=>10, 'data-mask'=>'0123456789')); ?>
                </div>
            </div>
            <!--CHILD DATA END-->

            <hr />

            <!--CAMP DATA START-->
            <div class="form-group">
                <label for="z_anketa_camp">Лагерь</label>
                <?php echo CHtml::dropDownList('Questionnaire[camp_id]', $model->camp_id, Questionnaire::getCAMPName(), array('class' => 'custom-select', 'id'=>'z_anketa_camp')); ?>
            </div>

            <div class="form-group">
                <label for="z_anketa_shift">Смена</label>
                <?php echo CHtml::dropDownList('Shifts[]', $model->shift_id, Questionnaire::getShiftsByParams($model->camp_id), array('class' => 'custom-select', 'id'=>'z_anketa_shift')); ?>
            </div>

            <div class="form-group">
                <label for="z_anketa_period">Период</label>
                <?php echo CHtml::dropDownList('Dlos[]', 0, Questionnaire::getDLOSByParams($model->camp_id,$model->shift_id), array('class' => 'custom-select', 'id'=>'z_anketa_period')); ?>
            </div>
            <!--CAMP DATA END-->


            <div class="form-group">
                <div class="row border-bottom">
                    <div class="form-group col-md-2 font-weight-bold">Лагерь</div>
                    <div class="form-group col-md-2 font-weight-bold">Смена №1</div>
                    <div class="form-group col-md-2 font-weight-bold">Смена №2</div>
                    <div class="form-group col-md-2 font-weight-bold">Смена №3</div>
                    <div class="form-group col-md-2 font-weight-bold">Смена №4</div>
                    <div class="form-group col-md-2 font-weight-bold">Смена №5</div>
                </div>
                <div class="row border-bottom">
                    <div class="form-group col-md-2 my-2 font-italic">Кировец</div>
                    <div class="form-group col-md-2 my-2">
                        <div class="z_anketa_period"> с 01.06 по 20.06</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="z_anketa_dlo_1_1">
                            <label class="custom-control-label" for="z_anketa_dlo_1_1">10 из 100</label>
                        </div>
                    </div>
                    <div class="form-group col-md-2 my-2">
                        <div class="z_anketa_period"> с 21.06 по 01.07</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="z_anketa_dlo_1_2">
                            <label class="custom-control-label" for="z_anketa_dlo_1_2">12 из 36</label>
                        </div>
                    </div>
                    <div class="form-group col-md-2 my-2">
                        <div class="z_anketa_period"> с 02.07 по 10.07</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="z_anketa_dlo_1_3">
                            <label class="custom-control-label" for="z_anketa_dlo_1_3">6 из 40</label>
                        </div>
                    </div>
                    <div class="form-group col-md-2 my-2">
                        <div class="z_anketa_period"> с 10.07 по 01.08</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="z_anketa_dlo_1_4" checked="checked" />
                            <label class="custom-control-label" for="z_anketa_dlo_1_4">10 из 10</label>
                        </div>
                        <div class="z_anketa_rezerv">Ререзв: 12 человек</div>
                    </div>
                    <div class="form-group col-md-2 my-2">
                        <div class="z_anketa_period"> с 02.08 по 31.08</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="z_anketa_dlo_1_5">
                            <label class="custom-control-label" for="z_anketa_dlo_1_5">76 из 100</label>
                        </div>
                    </div>
                </div>
                <div class="row border-bottom">
                    <div class="form-group col-md-2 my-2 font-italic">Голубой экран</div>
                    <div class="form-group col-md-2 my-2">
                        <div class="z_anketa_period"> с 05.06 по 22.06</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="z_anketa_dlo_2_1">
                            <label class="custom-control-label" for="z_anketa_dlo_2_1">5 из 23</label>
                        </div>
                    </div>
                    <div class="form-group col-md-2 my-2">
                        <div class="z_anketa_period"> с 23.06 по 29.06</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="z_anketa_dlo_2_2">
                            <label class="custom-control-label" for="z_anketa_dlo_2_2">2 из 22</label>
                        </div>
                    </div>
                    <div class="form-group col-md-2 my-2">
                        <div class="z_anketa_period"> с 30.06 по 12.07</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="z_anketa_dlo_2_3">
                            <label class="custom-control-label" for="z_anketa_dlo_2_3">23 из 52</label>
                        </div>
                    </div>
                    <div class="form-group col-md-2 my-2">
                        <div class="z_anketa_period"> с 13.07 по 01.08</div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="z_anketa_dlo_2_4">
                            <label class="custom-control-label" for="z_anketa_dlo_2_4">43 из 45</label>
                        </div>
                    </div>
                    <div class="form-group col-md-2 my-2"></div>
                </div>
            </div>
            <?php
                Questionnaire::DLO_4
            ?>

            <div class="form-group text-right">
                <?php echo CHtml::submitButton('Подать заявление на регистрацию', array('class' => 'btn btn-success')); ?>
            </div>

            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>