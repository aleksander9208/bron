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
            <form id="z_anketa_view_form" method="POST">

                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_name">Дата подачи заявки</label>
                    <div class="col-sm-8"><?php echo $model->created; ?></div>
                </div>

                <div class="form-group row <?php echo($model->getError('type') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_name"><?php echo $model->getAttributeLabel('type'); ?></label>
                    <div class="col-sm-8"><?php echo Questionnaire::getTypeName($model->type); ?></div>
                </div>

                <div class="form-group row <?php echo($model->getError('status') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_name">Текущий статус заявки</label>
                    <div class="col-sm-8"><?php echo Questionnaire::getStatusName($model->status); ?></div>
                </div>

                <?php if ($model->type == Questionnaire::TYPE_UR) { ?>
                    <div class="form-group row <?php echo($model->getError('name_ur') ? 'error' : ''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_name_ur"><?php echo $model->getAttributeLabel('name_ur'); ?></label>
                        <div class="col-sm-8">
                            <?php if($model->name_ur_check) {
                                echo CHtml::activeTextField($model, 'name_ur');
                             } else {
                                echo CHtml::encode($model->name_ur);
                            } ?>
                        </div>
                    </div>

                    <div class="form-group row <?php echo($model->getError('fio_ur_contact') ? 'error' : ''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_fio_ur_contact"><?php echo $model->getAttributeLabel('fio_ur_contact'); ?></label>
                        <div class="col-sm-8">
                            <?php if($model->fio_ur_contact_check) {
                                echo CHtml::activeTextField($model, 'fio_ur_contact');
                            } else {
                                echo CHtml::encode($model->fio_ur_contact);
                            } ?>
                        </div>
                    </div>

                    <div class="form-group row <?php echo($model->getError('tel_ur_contact') ? 'error' : ''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_tel_ur_contact"><?php echo $model->getAttributeLabel('tel_ur_contact'); ?></label>
                        <div class="col-sm-8">
                            <?php if($model->tel_ur_contact_check) {
                                echo CHtml::activeTextField($model, 'tel_ur_contact');
                            } else {
                                echo CHtml::encode($model->tel_ur_contact);
                            } ?>
                        </div>
                    </div>

                    <div class="form-group row <?php echo($model->getError('email_ur_contact') ? 'error' : ''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_email_ur_contact"><?php echo $model->getAttributeLabel('email_ur_contact'); ?></label>
                        <div class="col-sm-8">
                            <?php if($model->email_ur_contact_check) {
                                echo CHtml::activeTextField($model, 'email_ur_contact');
                            } else {
                                echo CHtml::encode($model->email_ur_contact);
                            } ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group row <?php echo($model->getError('fio_parent') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_fio_parent"><?php echo $model->getAttributeLabel('fio_parent'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->fio_parent_check) {
                            echo CHtml::activeTextField($model, 'fio_parent');
                        } else {
                            echo CHtml::encode($model->fio_parent);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('residence') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_residence"><?php echo $model->getAttributeLabel('residence'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->residence_check) {
                            echo CHtml::activeTextField($model, 'residence');
                        } else {
                            echo CHtml::encode($model->residence);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('place_of_work') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_place_of_work"><?php echo $model->getAttributeLabel('place_of_work'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->place_of_work_check) {
                            echo CHtml::activeTextField($model, 'place_of_work');
                        } else {
                            echo CHtml::encode($model->place_of_work);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('tel_parent') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_tel_parent"><?php echo $model->getAttributeLabel('tel_parent'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->tel_parent_check) {
                            echo CHtml::activeTextField($model, 'tel_parent');
                        } else {
                            echo CHtml::encode($model->tel_parent);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('email_parent') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_email_parent"><?php echo $model->getAttributeLabel('email_parent'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->email_parent_check) {
                            echo CHtml::activeTextField($model, 'email_parent');
                        } else {
                            echo CHtml::encode($model->email_parent);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('fio_child') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_fio_child"><?php echo $model->getAttributeLabel('fio_child'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->fio_child_check) {
                            echo CHtml::activeTextField($model, 'fio_child');
                        } else {
                            echo CHtml::encode($model->fio_child);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('birthday_child') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_birthday_child"><?php echo $model->getAttributeLabel('birthday_child'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->birthday_child_check) {
                            echo CHtml::activeTextField($model, 'birthday_child');
                        } else {
                            echo CHtml::encode($model->birthday_child);
                        } ?>
                    </div>
                </div>

                <div class="form-group row <?php echo($model->getError('place_of_study') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_place_of_study"><?php echo $model->getAttributeLabel('place_of_study'); ?></label>
                    <div class="col-sm-8">
                        <?php if($model->place_of_study_check) {
                            echo CHtml::activeTextField($model, 'place_of_study');
                        } else {
                            echo CHtml::encode($model->place_of_study);
                        } ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_birthday_child"><?php echo $model->getAttributeLabel('shift_id'); ?></label>
                    <div class="col-sm-8">
                        <?php echo Questionnaire::getShiftName($model->shift_id); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_birthday_child"><?php echo $model->getAttributeLabel('dlo_id'); ?></label>
                    <div class="col-sm-8">
                        <?php foreach ($shifts[$model->shift_id]['dlo'] as $d) { echo Questionnaire::getDLOName($d).'; '; } ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_birthday_child"><?php echo $model->getAttributeLabel('camp_id'); ?></label>
                    <div class="col-sm-8">
                        <?php echo Questionnaire::getCAMPName($model->camp_id); ?>
                    </div>
                </div>

                <hr />

                <div class="control-group text-right">
                    <a class="btn btn-info" href="<?php echo Yii::app()->createUrl('/profile/print/'.$model->id); ?>" role="button" target="_blank">Печать</a>
                    <?php if ($model->status != Questionnaire::STATUS_CANCELED) { ?>
                        <button class="btn btn-success" name="Questionnaire[status]"
                                value="<?php echo Questionnaire::STATUS_CANCELED; ?>" type="submit">Отменить заявку
                        </button>
                    <?php } ?>
                    <?php if (($model->status == Questionnaire::STATUS_RETURNED) || (($model->status == Questionnaire::STATUS_OK) && $model->getErrors())) { ?>
                        <button class="btn btn-primary" name="Questionnaire[status]"
                                value="<?php echo Questionnaire::STATUS_IN_MODER; ?>" type="submit"><?php echo ($model->id?'Внести изменеия':'Подать заявление на регистрацию'); ?>
                        </button>
                    <?php } ?>
                </div>
            </form>

        </div>
    </div>
</div>