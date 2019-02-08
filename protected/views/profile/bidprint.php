<h1 align="center"><?php echo CHtml::encode($title); ?></h1>

<div class="row">
    <label>Дата подачи заявки</label>
    <div><?php echo $model->created; ?></div>
</div>
<div class="row">
    <label><?php echo $model->getAttributeLabel('type'); ?></label>
    <div><?php echo Questionnaire::getTypeName($model->type); ?></div>
</div>
<div class="row">
    <label >Текущий статус заявки</label>
    <div><?php echo Questionnaire::getSatusName($model->status); ?></div>
</div>

                <?php if ($model->type == Questionnaire::TYPE_UR) { ?>
                    <div class="form-group row <?php echo($model->getError('name_ur') ? 'error' : ''); ?>">
                        <label class="control-label font-weight-bold col-sm-4" for="Questionnaire_name_ur"><?php echo $model->getAttributeLabel('name_ur'); ?></label>
                        <div class="col-sm-8">
                            <?php if($model->name_ur_check) {
                                echo CHtml::activeTextField($model, 'name_ur_check');
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
