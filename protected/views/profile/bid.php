<div id="z_page_anketa_view" class="container-fluid">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>
            <div id="page_profile_changer_send_alert" class="alert <?php echo ($model->getErrors()?'alert-danger':(Yii::app()->user->hasFlash('bid')?'alert-success':'d-none')); ?>" role="alert">
                <?php echo ($model->getErrors()?CHtml::errorSummary($model):''); ?>
                <?php echo (Yii::app()->user->hasFlash('bid')?Yii::app()->user->getFlash('bid'):''); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form id="z_anketa_view_form" method="POST" class="needs-validation">

                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_created">Дата подачи заявки</label>
                    <div class="col-sm-8"><?php echo $model->created; ?></div>
                </div>

                <div class="form-group row <?php echo($model->getError('type') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_type"><?php echo $model->getAttributeLabel('type'); ?></label>
                    <div class="col-sm-8"><?php echo Questionnaire::getTypeName($model->type); ?></div>
                </div>

                <div class="form-group row <?php echo($model->getError('status') ? 'error' : '');?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_name">Текущий статус заявки</label>
                    <div class="col-sm-8"><?php echo Questionnaire::getStatusName($model->status); ?></div>
                </div>

                <?php if ($model->type == Questionnaire::TYPE_UR) { ?>
                    <div class="form-group row <?php echo($model->getError('name_ur') ? 'error' : ''); echo ($model->name_ur_check?' bg-warning p-1':''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="z_anketa_name_ur"><?php echo $model->getAttributeLabel('name_ur'); ?></label>
                        <div class="col-sm-8">
                            <?php if($model->name_ur_check) {
                                echo CHtml::activeTextField($model, 'name_ur', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('name_ur'), 'required'=>'required', 'id'=>'z_anketa_name_ur'));
                             } else {
                                echo CHtml::encode($model->name_ur);
                            } ?>
                        </div>
                    </div>

                    <div class="form-group row <?php echo($model->getError('fio_ur_contact') ? 'error' : ''); echo ($model->fio_ur_contact_check?' bg-warning p-1':''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="z_anketa_fio_ur_contact"><?php echo $model->getAttributeLabel('fio_ur_contact'); ?></label>
                        <div class="col-sm-8">
                            <?php if($model->fio_ur_contact_check) {
                                echo CHtml::activeTextField($model, 'fio_ur_contact', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_fio_ur_contact', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-'));
                            } else {
                                echo CHtml::encode($model->fio_ur_contact);
                            } ?>
                        </div>
                    </div>

                    <div class="form-group row <?php echo($model->getError('tel_ur_contact') ? 'error' : ''); echo ($model->tel_ur_contact_check?' bg-warning p-1':''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="z_anketa_tel_ur_contact"><?php echo $model->getAttributeLabel('tel_ur_contact'); ?></label>
                        <div class="col-sm-8">
                            <?php if($model->tel_ur_contact_check) {
                                echo ''.
                                    '<div class="input-group">'.
                                        '<div class="input-group-prepend">'.
                                            '<div class="input-group-text">+7</div>'.
                                        '</div>'.
                                        CHtml::activeTextField($model, 'tel_ur_contact',array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_tel_ur_contact', 'maxlength'=>16, 'data-mask'=>'0123456789')).
                                    '</div>';
                            } else {
                                echo CHtml::encode($model->tel_ur_contact);
                            } ?>
                        </div>
                    </div>

                    <div class="form-group row <?php echo($model->getError('email_ur_contact') ? 'error' : ''); echo ($model->email_ur_contact_check?' bg-warning p-1':''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="z_anketa_email_ur_contact"><?php echo $model->getAttributeLabel('email_ur_contact'); ?></label>
                        <div class="col-sm-8">
                            <?php if($model->email_ur_contact_check) {
                                echo CHtml::activeTextField($model, 'email_ur_contact', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email_ur_contact'), 'required'=>'required', 'id'=>'z_anketa_email_ur_contact'));
                            } else {
                                echo CHtml::encode($model->email_ur_contact);
                            } ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group row <?php echo($model->getError('fio_parent') ? 'error' : ''); echo ($model->fio_parent_check?' bg-warning p-1':''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_fio_parent"><?php echo $model->getAttributeLabel('fio_parent'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->fio_parent_check) {
                            echo CHtml::activeTextField($model, 'fio_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_parent'), 'required'=>'required', 'id'=>'z_anketa_fio_parent', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-'));
                        } else {
                            echo CHtml::encode($model->fio_parent);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('residence') ? 'error' : ''); echo ($model->residence_check?' bg-warning p-1':''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_residence"><?php echo $model->getAttributeLabel('residence'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->residence_check) {
                            echo CHtml::activeTextField($model, 'residence', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('residence'), 'required'=>'required', 'id'=>'z_anketa_residence'));
                        } else {
                            echo CHtml::encode($model->residence);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('place_of_work') ? 'error' : ''); echo ($model->place_of_work_check?' bg-warning p-1':''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_place_of_work"><?php echo $model->getAttributeLabel('place_of_work'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->place_of_work_check) {
                            echo CHtml::activeTextField($model, 'place_of_work', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('place_of_work'), 'required'=>'required', 'id'=>'z_anketa_place_of_work'));
                        } else {
                            echo CHtml::encode($model->place_of_work);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('email_parent') ? 'error' : ''); echo ($model->email_parent_check?' bg-warning p-1':''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_email_parent"><?php echo $model->getAttributeLabel('email_parent'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->email_parent_check) {
                            echo CHtml::activeTextField($model, 'email_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email_parent'), 'required'=>'required', 'id'=>'z_anketa_email_parent'));
                        } else {
                            echo CHtml::encode($model->email_parent);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('fio_child') ? 'error' : ''); echo ($model->fio_child_check?' bg-warning p-1':''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_fio_child"><?php echo $model->getAttributeLabel('fio_child'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->fio_child_check) {
                            echo CHtml::activeTextField($model, 'fio_child', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('fio_child'), 'required'=>'required', 'id'=>'z_anketa_fio_child', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-'));
                        } else {
                            echo CHtml::encode($model->fio_child);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('birthday_child') ? 'error' : ''); echo ($model->birthday_child_check?' bg-warning p-1':''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_birthday_child"><?php echo $model->getAttributeLabel('birthday_child'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->birthday_child_check) {
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
                                    'required'  =>'required',
                                    'data-mask' =>'01234567890-',
                                    'maxlength'=>10
                                ),
                            ));
                        } else {
                            echo CHtml::encode($model->birthday_child);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('place_of_study') ? 'error' : ''); echo ($model->place_of_study_check?' bg-warning p-1':''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_place_of_study"><?php echo $model->getAttributeLabel('place_of_study'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->place_of_study_check) {
                            echo CHtml::activeTextField($model, 'place_of_study', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('place_of_study'), 'required'=>'required', 'id'=>'z_anketa_place_of_study'));
                        } else {
                            echo CHtml::encode($model->place_of_study);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('tel_parent') ? 'error' : ''); echo ($model->tel_parent_check?' bg-warning p-1':''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_tel_parent"><?php echo $model->getAttributeLabel('tel_parent'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->tel_parent_check) {
                            echo ''.
                                '<div class="input-group">'.
                                    '<div class="input-group-prepend">'.
                                        '<div class="input-group-text">+7</div>'.
                                    '</div>'.
                                    CHtml::activeTextField($model, 'tel_parent', array('class' => 'form-control', 'placeholder' => $model->getAttributeLabel('tel_parent'), 'required'=>'required', 'id'=>'z_anketa_tel_parent', 'maxlength'=>16, 'data-mask'=>'0123456789')).
                                '</div>';
                        } else {
                            echo CHtml::encode($model->tel_parent);
                        } ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_shift_id"><?php echo $model->getAttributeLabel('shift_id'); ?></label>
                    <div class="col-sm-8" id="z_anketa_shift_id">
                        <?php echo Questionnaire::getShiftName($model->shift_id); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_dlo"><?php echo $model->getAttributeLabel('dlo_id'); ?></label>
                    <div class="col-sm-8" id="z_anketa_dlo">
                        <?php foreach ($shifts[$model->shift_id]['dlo'] as $d) { echo Questionnaire::getDLOName($d).'; '; } ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="z_anketa_camp_id"><?php echo $model->getAttributeLabel('camp_id'); ?></label>
                    <div class="col-sm-8" id="z_anketa_camp_id">
                        <?php echo Questionnaire::getCAMPName($model->camp_id); ?>
                    </div>
                </div>

                <hr />

                <div class="control-group text-right">
                    <a class="btn btn-info" href="<?php echo Yii::app()->createUrl('/profile/print/'.$model->id); ?>" role="button" target="_blank">Печать</a>
                    <?php if ($model->status != Questionnaire::STATUS_CANCELED) { ?>
                        <button class="btn btn-success" name="Questionnaire[status]" value="<?php echo Questionnaire::STATUS_CANCELED; ?>" type="submit">Отменить заявку</button>
                    <?php } ?>
                    <?php if (($model->status == Questionnaire::STATUS_RETURNED) || (($model->status == Questionnaire::STATUS_OK) && $model->getErrors())) { ?>
                        <button class="btn btn-primary" name="Questionnaire[status]" value="<?php echo Questionnaire::STATUS_IN_MODER; ?>" type="submit"><?php echo ($model->id?'Внести изменеия':'Подать заявление на регистрацию'); ?></button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>