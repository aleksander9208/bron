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
                        <?php echo Questionnaire::getSatusName($model->status); ?>
                    </div>
                </div>
            </div>




            <?php if ($model->type == Questionnaire::TYPE_UR) { ?>


                <div class="control-group <?php echo($model->getError('name_ur') ? 'error' : ''); ?>">
                    <label class="control-label" for="Questionnaire_name_ur"><?php echo $model->getAttributeLabel('name_ur'); ?></label>
                    <div class="controls">
                        <div class="input-append">
                            <?php if($model->name_ur_check) {
                                echo CHtml::activeTextField($model, 'name_ur_check');
                             } else {
                                echo CHtml::encode($model->name_ur);
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('fio_ur_contact') ? 'error' : ''); ?>">
                    <label class="control-label" for="Questionnaire_fio_ur_contact"><?php echo $model->getAttributeLabel('fio_ur_contact'); ?></label>
                    <div class="controls">
                        <div class="input-append">
                            <?php if($model->fio_ur_contact_check) {
                                echo CHtml::activeTextField($model, 'fio_ur_contact');
                            } else {
                                echo CHtml::encode($model->fio_ur_contact);
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('tel_ur_contact') ? 'error' : ''); ?>">
                    <label class="control-label" for="Questionnaire_tel_ur_contact"><?php echo $model->getAttributeLabel('tel_ur_contact'); ?></label>
                    <div class="controls">
                        <div class="input-append">
                            <?php if($model->tel_ur_contact_check) {
                                echo CHtml::activeTextField($model, 'tel_ur_contact');
                            } else {
                                echo CHtml::encode($model->tel_ur_contact);
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="control-group <?php echo($model->getError('email_ur_contact') ? 'error' : ''); ?>">
                    <label class="control-label" for="Questionnaire_email_ur_contact"><?php echo $model->getAttributeLabel('email_ur_contact'); ?></label>
                    <div class="controls">
                        <div class="input-append">
                            <?php if($model->email_ur_contact_check) {
                                echo CHtml::activeTextField($model, 'email_ur_contact');
                            } else {
                                echo CHtml::encode($model->email_ur_contact);
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>




            <div class="control-group <?php echo($model->getError('fio_parent') ? 'error' : ''); ?>">
                <label class="control-label" for="Questionnaire_fio_parent"><?php echo $model->getAttributeLabel('fio_parent'); ?></label>
                <div class="controls">
                    <div class="input-append">
                        <?php if($model->fio_parent_check) {
                            echo CHtml::activeTextField($model, 'fio_parent');
                        } else {
                            echo CHtml::encode($model->fio_parent);
                        } ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('residence') ? 'error' : ''); ?>">
                <label class="control-label" for="Questionnaire_residence"><?php echo $model->getAttributeLabel('residence'); ?></label>
                <div class="controls">
                    <div class="input-append">
                        <?php if($model->residence_check) {
                            echo CHtml::activeTextField($model, 'residence');
                        } else {
                            echo CHtml::encode($model->residence);
                        } ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('place_of_work') ? 'error' : ''); ?>">
                <label class="control-label" for="Questionnaire_place_of_work"><?php echo $model->getAttributeLabel('place_of_work'); ?></label>
                <div class="controls">
                    <div class="input-append">
                        <?php if($model->place_of_work_check) {
                            echo CHtml::activeTextField($model, 'place_of_work');
                        } else {
                            echo CHtml::encode($model->place_of_work);
                        } ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('tel_parent') ? 'error' : ''); ?>">
                <label class="control-label" for="Questionnaire_tel_parent"><?php echo $model->getAttributeLabel('tel_parent'); ?></label>
                <div class="controls">
                    <div class="input-append">
                        <?php if($model->tel_parent_check) {
                            echo CHtml::activeTextField($model, 'tel_parent');
                        } else {
                            echo CHtml::encode($model->tel_parent);
                        } ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('email_parent') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_email_parent"><?php echo $model->getAttributeLabel('email_parent'); ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php if($model->email_parent_check) {
                            echo CHtml::activeTextField($model, 'email_parent');
                        } else {
                            echo CHtml::encode($model->email_parent);
                        } ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('fio_child') ? 'error' : ''); ?>">
                <label class="control-label" for="Questionnaire_fio_child"><?php echo $model->getAttributeLabel('fio_child'); ?></label>
                <div class="controls">
                    <div class="input-append">
                        <?php if($model->fio_child_check) {
                            echo CHtml::activeTextField($model, 'fio_child');
                        } else {
                            echo CHtml::encode($model->fio_child);
                        } ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('birthday_child') ? 'error' : ''); ?>">
                <label class="control-label" for="Questionnaire_birthday_child"><?php echo $model->getAttributeLabel('birthday_child'); ?></label>
                <div class="controls">
                    <div class="input-append">
                        <?php if($model->birthday_child_check) {
                            echo CHtml::activeTextField($model, 'birthday_child');
                        } else {
                            echo CHtml::encode($model->birthday_child);
                        } ?>
                    </div>
                </div>
            </div>

            <div class="control-group <?php echo($model->getError('place_of_study') ? 'error' : ''); ?>">
                <label class="control-label"
                       for="Questionnaire_place_of_study"><?php echo $model->getAttributeLabel('place_of_study'); ?></label>

                <div class="controls">
                    <div class="input-append">
                        <?php if($model->place_of_study_check) {
                            echo CHtml::activeTextField($model, 'place_of_study');
                        } else {
                            echo CHtml::encode($model->place_of_study);
                        } ?>
                    </div>
                </div>
            </div>
            <hr>
            <p>
                <?php if ($model->status != Questionnaire::STATUS_CANCELED) { ?>
                    <button class="btn btn-success" name="Questionnaire[status]"
                            value="<?php echo Questionnaire::STATUS_CANCELED; ?>" type="submit">Отменить заявку
                    </button>
                <?php } ?>
                <?php if (($model->status == Questionnaire::STATUS_RETURNED) || (($model->status == Questionnaire::STATUS_OK) && $model->getErrors())) { ?>
                    <button class="btn btn-primary" name="Questionnaire[status]"
                            value="<?php echo Questionnaire::STATUS_IN_MODER; ?>" type="submit">Подать заявление на регистрацию
                    </button>
                <?php } ?>
            </p>

        </form>
    </div>
</div>