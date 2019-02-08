<div id="page_bid" class="wrap bid">
    <div class="bid_edit">
        <form id="form_fias" class="form-horizontal" method="POST">
            <?php if (Yii::app()->user->hasFlash('bid')) { ?>
                <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('bid'); ?> </div>
            <?php } ?>
            <?php if ($model->getErrors()) { ?>
                <div class="alert alert-error"><?php echo CHtml::errorSummary($model); ?></div>
            <?php } ?>


            <div class="control-group">
                <label class="control-label" for="Questionnaire_name">Дата подачи заявки</label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo $model->created; ?>
                    </div>
                </div>
            </div>
            <div class="control-group <?php echo($model->getError('type') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_name"><?php echo $model->getAttributeLabel('type'); ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo Questionnaire::getTypeName($model->type); ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('status') ? 'error' : ''); ?>">
                <label class="control-label" for="Questionnaire_name">Текущий статус заявки</label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo Questionnaire::getStatusName($model->status); ?>
                    </div>
                </div>
            </div>

            <?php if ($model->type == Questionnaire::TYPE_UR) { ?>
                <div class="control-group <?php echo($model->getError('name_ur') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_name_ur"><?php echo $model->getAttributeLabel('name_ur') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'name_ur_check') . ')'; ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->name_ur); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('fio_ur_contact') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_fio_ur_contact"><?php echo $model->getAttributeLabel('fio_ur_contact') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'fio_ur_contact_check') . ')'; ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->fio_ur_contact); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('tel_ur_contact') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_tel_ur_contact"><?php echo $model->getAttributeLabel('tel_ur_contact') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'tel_ur_contact_check') . ')'; ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->tel_ur_contact); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('email_ur_contact') ? 'error' : ''); ?>">
                    <label class="control-label"
                           for="Questionnaire_email_ur_contact"><?php echo $model->getAttributeLabel('email_ur_contact') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'email_ur_contact_check') . ')'; ?></label>

                    <div class="controls">
                        <div class="input-append">
                            <?php echo CHtml::encode($model->email_ur_contact); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>


            <div class="control-group <?php echo($model->getError('fio_parent') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_fio_parent"><?php echo $model->getAttributeLabel('fio_parent') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'fio_parent_check') . ')'; ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo CHtml::encode($model->fio_parent); ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('residence') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_residence"><?php echo $model->getAttributeLabel('residence') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'residence_check') . ')'; ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo CHtml::encode($model->residence); ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('place_of_work') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_place_of_work"><?php echo $model->getAttributeLabel('place_of_work') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'place_of_work_check') . ')'; ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo CHtml::encode($model->place_of_work); ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('tel_parent') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_tel_parent"><?php echo $model->getAttributeLabel('tel_parent') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'tel_parent_check') . ')'; ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo CHtml::encode($model->tel_parent); ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('email_parent') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_email_parent"><?php echo $model->getAttributeLabel('email_parent') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'email_parent_check') . ')'; ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo CHtml::encode($model->email_parent); ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('fio_child') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_fio_child"><?php echo $model->getAttributeLabel('fio_child') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'fio_child_check') . ')'; ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo CHtml::encode($model->fio_child); ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('birthday_child') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_birthday_child"><?php echo $model->getAttributeLabel('birthday_child') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'birthday_child_check') . ')'; ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php echo CHtml::encode($model->birthday_child); ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('place_of_study') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_place_of_study"><?php echo $model->getAttributeLabel('place_of_study') . '(Требует исправление ' . CHtml::activeCheckBox($model, 'place_of_study_check') . ')'; ?></label>

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