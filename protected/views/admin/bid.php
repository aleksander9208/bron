<div id="z_page_anketa_admin_view" class="container-fluid">
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
            <form id="z_page_anketa_admin_view" method="POST">

                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Поле</th>
                            <th scope="col" class="text-center">Значение</th>
                            <th scope="col" class="text-center">Необходимо исправление</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Дата подачи заявки</th>
                            <td class="text-center"><?php echo $model->created; ?></td>
                            <td class="text-center">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_created"></label>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="form-group row">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_created">Дата подачи заявки</label>
                    <div class="col-sm-6"><?php echo $model->created; ?></div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="form-group row <?php echo($model->getError('type') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_type"><?php echo $model->getAttributeLabel('type'); ?></label>
                    <div class="col-sm-6"><?php echo Questionnaire::getTypeName($model->type); ?></div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="form-group row <?php echo($model->getError('status') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_status">Текущий статус заявки</label>
                    <div class="col-sm-6"><?php echo Questionnaire::getStatusName($model->status); ?></div>
                    <div class="col-sm-2"></div>
                </div>

                <?php if ($model->type == Questionnaire::TYPE_UR) { ?>
                    <div class="form-group row <?php echo($model->getError('name_ur') ? 'error' : ''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_name_ur"><?php echo $model->getAttributeLabel('name_ur');?></label>
                        <div class="col-sm-6"><?php echo CHtml::encode($model->name_ur); ?></div>
                        <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?('<div class="col-sm-auto">'.CHtml::activeCheckBox($model, 'name_ur_check').'</div>'):'');?>
                    </div>
                    <div class="form-group row <?php echo($model->getError('fio_ur_contact') ? 'error' : ''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_fio_ur_contact"><?php echo $model->getAttributeLabel('fio_ur_contact'); ?></label>
                        <div class="col-sm-6"><?php echo CHtml::encode($model->fio_ur_contact); ?></div>
                        <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?('<div class="col-sm-auto">'.CHtml::activeCheckBox($model, 'fio_ur_contact_check').'</div>'):'');?>
                    </div>
                    <div class="form-group row <?php echo($model->getError('tel_ur_contact') ? 'error' : ''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_tel_ur_contact"><?php echo $model->getAttributeLabel('tel_ur_contact') ;?></label>
                        <div class="col-sm-6"><?php echo CHtml::encode($model->tel_ur_contact); ?></div>
                        <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?('<div class="col-sm-auto">'.CHtml::activeCheckBox($model, 'tel_ur_contact_check').'</div>'):'');?>
                    </div>
                    <div class="form-group row <?php echo($model->getError('email_ur_contact') ? 'error' : ''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_email_ur_contact"><?php echo $model->getAttributeLabel('email_ur_contact'); ?></label>
                        <div class="col-sm-6"><?php echo CHtml::encode($model->email_ur_contact); ?></div>
                        <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?('<div class="col-sm-auto">'.CHtml::activeCheckBox($model, 'email_ur_contact_check').'</div>'):'');?>
                    </div>
                <?php } ?>

                <div class="form-group row <?php echo($model->getError('fio_parent') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_fio_parent"><?php echo $model->getAttributeLabel('fio_parent'); ?></label>
                    <div class="col-sm-6"><?php echo CHtml::encode($model->fio_parent); ?></div>
                    <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?('<div class="col-sm-auto">'.CHtml::activeCheckBox($model, 'fio_parent_check').'</div>'):'');?>
                </div>

                <div class="form-group row <?php echo($model->getError('residence') ? 'error' : ''); ?>">
                    <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_residence"><?php echo $model->getAttributeLabel('residence'); ?></label>
                    <div class="col-sm-6"><?php echo CHtml::encode($model->residence); ?></div>
                    <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?('<div class="col-sm-auto">'.CHtml::activeCheckBox($model, 'residence_check').'</div>'):'');?>
                </div>

                <div class="control-group <?php echo($model->getError('place_of_work') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_place_of_work"><?php echo $model->getAttributeLabel('place_of_work');
                        echo ($model->status==Questionnaire::STATUS_IN_MODER?'(Требует исправление ' . CHtml::activeCheckBox($model, 'place_of_work_check') . ')':''); ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->place_of_work); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('tel_parent') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_tel_parent"><?php echo $model->getAttributeLabel('tel_parent');
                        echo ($model->status==Questionnaire::STATUS_IN_MODER?'(Требует исправление ' . CHtml::activeCheckBox($model, 'tel_parent_check') . ')':''); ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->tel_parent); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('email_parent') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_email_parent"><?php echo $model->getAttributeLabel('email_parent');
                        echo ($model->status==Questionnaire::STATUS_IN_MODER?'(Требует исправление ' . CHtml::activeCheckBox($model, 'email_parent_check') . ')':''); ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->email_parent); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('fio_child') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_fio_child"><?php echo $model->getAttributeLabel('fio_child');
                        echo ($model->status==Questionnaire::STATUS_IN_MODER?'(Требует исправление ' . CHtml::activeCheckBox($model, 'fio_child_check') . ')':''); ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->fio_child); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('birthday_child') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_birthday_child"><?php echo $model->getAttributeLabel('birthday_child');
                        echo ($model->status==Questionnaire::STATUS_IN_MODER?'(Требует исправление ' . CHtml::activeCheckBox($model, 'birthday_child_check') . ')':''); ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->birthday_child); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('place_of_study') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_place_of_study"><?php echo $model->getAttributeLabel('place_of_study');
                        echo ($model->status==Questionnaire::STATUS_IN_MODER?'(Требует исправление ' . CHtml::activeCheckBox($model, 'place_of_study_check') . ')':''); ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->place_of_study); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="Questionnaire_birthday_child"><?php echo $model->getAttributeLabel('shift_id'); ?></label>
                    <div class="controls">
                        <div class="input-append">
                            <?php echo Questionnaire::getShiftName($model->shift_id); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="Questionnaire_birthday_child"><?php echo $model->getAttributeLabel('dlo_id'); ?></label>
                    <div class="controls">
                        <div class="input-append">
                            <?php foreach ($shifts[$model->shift_id]['dlo'] as $d) { echo Questionnaire::getDLOName($d).'; '; } ?>
                        </div>
                    </div>
                </div>

                <hr>
                <p>
                    <?php if (!in_array($model->status, array(Questionnaire::STATUS_OK, Questionnaire::STATUS_CANCELED))) { ?>
                        <button class="btn btn-success" name="Questionnaire[status]"
                                value="<?php echo Questionnaire::STATUS_OK; ?>" type="submit">Зарегистрировать
                        </button>
                    <?php } ?>
                    <?php if (in_array($model->status, array(Questionnaire::STATUS_IN_MODER))) { ?>
                        <button class="btn btn-primary" name="Questionnaire[status]"
                                value="<?php echo Questionnaire::STATUS_RETURNED; ?>" type="submit">Вернуть на доработку
                        </button>
                    <?php } ?>
                </p>

            </form>
        </div>
    </div>
</div>