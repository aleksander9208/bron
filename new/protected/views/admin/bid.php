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

                <table class="table table-bordered table-striped table-hover bt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Поле</th>
                            <th scope="col" class="text-center">Значение</th>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<th scope="col" class="text-center">Необходимо исправление</th>':''); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Дата подачи заявки</th>
                            <td class="text-center"><?php echo date("H:i:s d-m-Y",strtotime($model->created)); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">&nbsp;</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('type') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('type'); ?></th>
                            <td class="text-center"><?php echo Questionnaire::getTypeName($model->type); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">&nbsp;</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('status') ? 'table-danger' : ''); ?>">
                            <th scope="row">Текущий статус заявки</th>
                            <td class="text-center"><?php echo Questionnaire::getStatusName($model->status); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">&nbsp;</td>':''); ?>
                        </tr>
                    <?php if ($model->type == Questionnaire::TYPE_UR) { ?>
                        <tr class="<?php echo($model->getError('name_ur') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('name_ur');?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->name_ur); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'name_ur_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('fio_ur_contact') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('fio_ur_contact'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->fio_ur_contact); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'fio_ur_contact_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('tel_ur_contact') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('tel_ur_contact'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->tel_ur_contact); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'tel_ur_contact_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('email_ur_contact') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('email_ur_contact'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->email_ur_contact); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'email_ur_contact_check').'</td>':''); ?>
                        </tr>
                    <?php } ?>
                        <tr class="<?php echo($model->getError('fio_parent') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('fio_parent'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->fio_parent); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'fio_parent_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('residence') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('residence'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->residence); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'residence_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('place_of_work') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('place_of_work'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->place_of_work); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'place_of_work_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('tel_parent') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('tel_parent'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->tel_parent); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'tel_parent_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('email_parent') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('email_parent'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->email_parent); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'email_parent_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('fio_child') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('fio_child'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->fio_child); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'fio_child_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('birthday_child') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('birthday_child'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode(date("d-m-Y",strtotime($model->birthday_child))); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'birthday_child_check').'</td>':''); ?>
                        </tr>
                        <tr class="<?php echo($model->getError('place_of_study') ? 'table-danger' : ''); ?>">
                            <th scope="row"><?php echo $model->getAttributeLabel('place_of_study'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode($model->place_of_study); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">'.CHtml::activeCheckBox($model, 'place_of_study_check').'</td>':''); ?>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $model->getAttributeLabel('camp_id'); ?></th>
                            <td class="text-center"><?php echo CHtml::encode(Questionnaire::getCAMPName($model->camp_id)); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">&nbsp;</td>':''); ?>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $model->getAttributeLabel('shift_id'); ?></th>
                            <td class="text-center"><?php echo Questionnaire::getShiftName($model->shift_id).'<br>'.SiteService::templateDloRange($model->shift_id); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">&nbsp;</td>':''); ?>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $model->getAttributeLabel('comment'); ?></th>
                            <td class="text-center" data-comment-id="<?php echo $model->id; ?>"><?php echo CHtml::encode($model->comment); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">&nbsp;</td>':''); ?>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $model->getAttributeLabel('paid'); ?></th>
                            <td class="text-center"><?php echo ($model->paid?'Да':'Нет'); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">&nbsp;</td>':''); ?>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $model->getAttributeLabel('is_main'); ?></th>
                            <td class="text-center"><?php echo ($model->is_main?'Да':'Нет'); ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">&nbsp;</td>':''); ?>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $model->getAttributeLabel('booking_id'); ?></th>
                            <td class="text-center"><?php

                                echo CHtml::encode($model->booking_id);


                                if (!$model->booking_id && SiteService::checkTurn($model->user_id,$model->shift_id)) {
                                    echo 'Резерв';
                                }

                                ?></td>
                            <?php echo ($model->status==Questionnaire::STATUS_IN_MODER?'<td class="text-center">&nbsp;</td>':''); ?>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <?php if (!in_array($model->status, array(Questionnaire::STATUS_OK, Questionnaire::STATUS_CANCELED, Questionnaire::STATUS_RETURNED))) { ?>
                        <button class="btn btn-success" name="Questionnaire[status]" value="<?php echo Questionnaire::STATUS_OK; ?>" type="submit">Зарегистрировать</button>
                    <?php } ?>
                    <?php if (in_array($model->status, array(Questionnaire::STATUS_IN_MODER))) { ?>
                        <button class="btn btn-primary" name="Questionnaire[status]" value="<?php echo Questionnaire::STATUS_RETURNED; ?>" type="submit">Вернуть на доработку</button>
                    <?php } ?>
                    <?php if (in_array($model->status, array(Questionnaire::STATUS_OK))) { ?>
                        <button class="btn btn-danger" name="Questionnaire[status]" value="<?php echo Questionnaire::STATUS_CANCELED; ?>" type="submit">Отменить заявку администратором</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>