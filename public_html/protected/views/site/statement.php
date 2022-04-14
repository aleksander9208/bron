<div id="z_page_anketa" class="container-fluid z_anketa_block_<?php echo $model->type;?>">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>
            <div id="page_profile_changer_send_alert" class="alert <?php echo (Yii::app()->user->hasFlash('q_error')?'alert-danger':(Yii::app()->user->hasFlash('q_done')?'alert-success':'d-none')); ?>" role="alert">
                <?php echo (Yii::app()->user->hasFlash('q_error')?Yii::app()->user->getFlash('q_error'):''); ?>
                <?php echo (Yii::app()->user->hasFlash('q_done')?'Заявка успешно отправлена':''); ?>
            </div>
            <?php echo CHtml::form('', 'post', array('class' => 'needs-validation '.(Yii::app()->user->getFlash('q_done')?'d-none':''), 'id'=>'z_anketa_form')); ?>

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
                            'dateFormat' => date('H:i:s').' dd-mm-yy',
                            'defaultDate' => date("H:i:s d-m-Y"), //$model->birthday_child,
                            'altFormat' => '00:00:00 dd-mm-yy',
                            'changeMonth' => true,
                            'changeYear' => true,
                            //'appendText' => 'yyyy-mm-dd',
                            'yearRange' => '-18:+1',
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
                <?php echo CHtml::activeLabel($model, 'code', array('for'=>'z_anketa_code')); ?>
                <?php echo CHtml::activeTextField(
                        $model,
                        'code',
                        array(
                            'class' => 'form-control',
                            'placeholder' => $model->getAttributeLabel('code'),
                            'id'=>'z_anketa_code',
                            'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-',
                            'value'=> $model->code
                        )); ?>
                <div class="info-code">Запомните кодовое слово для последующего входа в личный кабинет</div>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <div class="form-group z_anketa_block_<?php echo Questionnaire::TYPE_UR; ?>">
                <?php echo CHtml::activeLabel($model, 'tel_ur_contact', array('for'=>'z_anketa_tel_ur_contact')); ?>
                <div class="input-group">
                    <?php echo CHtml::activeTextField($model, 'tel_ur_contact', array((Questionnaire::TYPE_UR==$model->type?'_':'').'disabled'=>'disabled', 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_tel_ur_contact', 'maxlength'=>11, 'data-mask'=>'0123456789')); ?>
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
                <?php echo CHtml::activeTextField(
                        $model,
                        'fio_parent',
                        array(
                            'class' => 'form-control',
                            'placeholder' => $model->getAttributeLabel('fio_parent'),
                            'required'=>'required',
                            'id'=>'z_anketa_fio_parent',
                            'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-'
                        )); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>

            <div class="form-group z_anketa_block_2">
                <?php echo CHtml::activeLabel($model, 'code', array('for'=>'z_anketa_code')); ?>
                <?php echo
                    CHtml::activeTextField(
                            $model,
                            'code',
                            array(
                                'class' => 'form-control',
                                'placeholder' => $model->getAttributeLabel('code'),
                                'id'=>'z_anketa_code',
                                'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-',
                                'value'=> $model->code
                            )); ?>
                <div class="info-code">Запомните кодовое слово для последующего входа в личный кабинет</div>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>

            <!--
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
            -->
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
                <?php echo CHtml::activeLabel($model, 'residence', array('for'=>'z_anketa_residence')); ?>
                <?php echo CHtml::activeTextField($model, 'residence', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('residence'), 'required'=>'required', 'id'=>'z_anketa_residence')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div>
            <!--
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'place_of_study', array('for'=>'z_anketa_place_of_study')); ?>
                <?php echo CHtml::activeTextField($model, 'place_of_study', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('place_of_study'), 'required'=>'required', 'id'=>'z_anketa_place_of_study')); ?>
                <div class="invalid-feedback">Заполните поле корректно</div>
            </div> 
            -->
            <div class="form-group">
                <?php echo CHtml::activeLabel($model, 'tel_parent', array('for'=>'z_anketa_tel_parent')); ?>
                <div class="input-group">
                    <?php echo CHtml::activeTextField($model, 'tel_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_parent'), 'required'=>'required', 'id'=>'z_anketa_tel_parent', 'maxlength'=>11, 'data-mask'=>'0123456789')); ?>
                    <div class="invalid-feedback">Заполните поле корректно</div>
                </div>
            </div>
            <!--CHILD DATA END-->

            <hr />
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="z_anketa_opd" required='required'>
                    <label class="custom-control-label" for="z_anketa_opd">Согласен на&nbsp;обработку персональных данных в&nbsp;соответствии с&nbsp;Федеральным законом &laquo;О&nbsp;персональных данных&raquo; от&nbsp;27.07.2006&nbsp;г. &#8470;&nbsp;152-ФЗ</label>
                </div>
            </div>

            <label for="z_anketa_table">Сводная таблица лагерей и смен</label>

            <table id="z_anketa_table" class="table table-bordered table-striped table-hover table-sm">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Лагерь</th>
                    <th scope="col" class="text-center">Рекомендуемый возраст</th>
                </tr>
                </thead>
                <tbody>

                    <?php

                        //получаем количество лагерей
                        $countCamp = Questionnaire::getCAMPName();

                    for($i=1; $i <= count($countCamp); $i++) {

                        if($i > 5) break;
                        $camp = Questionnaire::getAddress($i);

                        $idSmenaOne = SiteService::idDtoCamp($i, 1);
                        $idSmenaTwo = SiteService::idDtoCamp($i, 2);
                        $idSmenaThree = SiteService::idDtoCamp($i, 3);
                        $idSmenaFour = SiteService::idDtoCamp($i, 4);
                        $idSmenaFive = SiteService::idDtoCamp($i, 5);
                        $idSmenaSix = SiteService::idDtoCamp($i, 6);
                    ?>
                        <tr>
                            <th scope="row" class="align-middle text-center">
                                <?php echo Questionnaire::getCAMPName($i); ?><br/>
                                <small><?= $camp['address'] ?></small>
                            </th>

                            <td class="text-center">
                                от <?php echo $camp['min_age']; ?>
                                до <?php echo  $camp['max_age'];?> лет
                            </td>

                            <? if($shifts[$idSmenaOne]['date']) { ?>
                                <td class="text-center"
                                    data-dlo="<?= $idSmenaOne; ?>"
                                    data-shift="<?= $idSmenaOne; ?>"
                                >
                                    <div><?= $shifts[$idSmenaOne]['day'] ?> дней</div>
                                    <strong>
                                        <?= $shifts[$idSmenaOne]['date'] ?>
                                    </strong>
                                    <br/>
                                    <?php echo SiteService::templateChecker(
                                            '',
                                        $idSmenaOne,
                                            $seats[$idSmenaOne]['seats'],
                                            $shifts[$idSmenaOne]['seats'],
                                            $shifts[$idSmenaOne]['min_age'],
                                            $shifts[$idSmenaOne]['max_age'],
                                            $postShifts,
                                            '1');
                                    ?>
                                </td>
                            <? } ?>

                            <? if($shifts[$idSmenaTwo]['date']) { ?>
                                <td class="text-center"
                                    data-dlo="<?= $idSmenaTwo; ?>"
                                    data-shift="<?= $idSmenaTwo; ?>"
                                >
                                    <div><?= $shifts[$idSmenaTwo]['day'] ?> дней</div>
                                    <strong>
                                        <?= $shifts[$idSmenaTwo]['date'] ?>
                                    </strong>
                                    <br/>
                                    <?php echo SiteService::templateChecker(
                                        '',
                                        $idSmenaTwo,
                                        $seats[$idSmenaTwo]['seats'],
                                        $shifts[$idSmenaTwo]['seats'],
                                        $shifts[$idSmenaTwo]['min_age'],
                                        $shifts[$idSmenaTwo]['max_age'],
                                        $postShifts,
                                        '1');
                                    ?>
                                </td>
                            <? } ?>

                            <? if($shifts[$idSmenaThree]['date']) { ?>
                                <td class="text-center"
                                    data-dlo="<?= $idSmenaThree; ?>"
                                    data-shift="<?= $idSmenaThree; ?>"
                                >
                                    <div><?= $shifts[$idSmenaThree]['day'] ?> дней</div>
                                    <strong>
                                        <?= $shifts[$idSmenaThree]['date'] ?>
                                    </strong>
                                    <br/>
                                    <?php echo SiteService::templateChecker(
                                        '',
                                        $idSmenaThree,
                                        $seats[$idSmenaThree]['seats'],
                                        $shifts[$idSmenaThree]['seats'],
                                        $shifts[$idSmenaThree]['min_age'],
                                        $shifts[$idSmenaThree]['max_age'],
                                        $postShifts,
                                        '1');
                                    ?>
                                </td>
                            <? } ?>

                            <? if($shifts[$idSmenaFour]['date']) { ?>
                                <td class="text-center"
                                    data-dlo="<?= $idSmenaFour; ?>"
                                    data-shift="<?= $idSmenaFour; ?>"
                                >
                                    <div><?= $shifts[$idSmenaFour]['day'] ?> дней</div>
                                    <strong>
                                        <?= $shifts[$idSmenaFour]['date'] ?>
                                    </strong>
                                    <br/>
                                    <?php echo SiteService::templateChecker(
                                        '',
                                        $idSmenaFour,
                                        $seats[$idSmenaFour]['seats'],
                                        $shifts[$idSmenaFour]['seats'],
                                        $shifts[$idSmenaFour]['min_age'],
                                        $shifts[$idSmenaFour]['max_age'],
                                        $postShifts,
                                        '1');
                                    ?>
                                </td>
                            <? } ?>

                            <? if($shifts[$idSmenaFive]['date']) { ?>
                                <td class="text-center"
                                    data-dlo="<?= $idSmenaFive; ?>"
                                    data-shift="<?= $idSmenaFive; ?>"
                                >
                                    <div><?= $shifts[$idSmenaFive]['day'] ?> дней</div>
                                    <strong>
                                        <?= $shifts[$idSmenaFive]['date'] ?>
                                    </strong>
                                    <br/>
                                    <?php echo SiteService::templateChecker(
                                        '',
                                        $idSmenaFive,
                                        $seats[$idSmenaFive]['seats'],
                                        $shifts[$idSmenaFive]['seats'],
                                        $shifts[$idSmenaFive]['min_age'],
                                        $shifts[$idSmenaFive]['max_age'],
                                        $postShifts,
                                        '1');
                                    ?>
                                </td>
                            <? } ?>

                            <? if($shifts[$idSmenaSix]['date']) { ?>
                                <td class="text-center"
                                    data-dlo="<?= $idSmenaSix; ?>"
                                    data-shift="<?= $idSmenaSix; ?>"
                                >
                                    <div><?= $shifts[$idSmenaSix]['day'] ?> дней</div>
                                    <strong>
                                        <?= $shifts[$idSmenaSix]['date'] ?>
                                    </strong>
                                    <br/>
                                    <?php echo SiteService::templateChecker(
                                        '',
                                        $idSmenaSix,
                                        $seats[$idSmenaSix]['seats'],
                                        $shifts[$idSmenaSix]['seats'],
                                        $shifts[$idSmenaSix]['min_age'],
                                        $shifts[$idSmenaSix]['max_age'],
                                        $postShifts,
                                        '1');
                                    ?>
                                </td>
                            <? } ?>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="form-group text-right">
                <?php echo CHtml::submitButton('Подать заявку на регистрацию', array('class' => 'btn btn-success')); ?>
            </div>

            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>
