<div id="z_page_admin_reserve" class="container-fluid">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>
            <div id="page_profile_changer_send_alert" class="alert <?php echo (Yii::app()->user->hasFlash('r_error')?'alert-danger':(Yii::app()->user->hasFlash('r_done')?'alert-success':'')); ?>" role="alert">
                <?php echo (Yii::app()->user->hasFlash('r_error')?Yii::app()->user->getFlash('r_error'):''); ?>
                <?php echo (Yii::app()->user->hasFlash('r_done')?'Заявка успешон отправлена':''); ?>
            </div>
            <?php echo CHtml::form('', 'post', array('class' => 'needs-validation', 'id' => 'z_anketa_form', 'novalidate' => 'novalidate')); ?>
            <label for="z_anketa_reserv_table">Сводная таблица лагерей и смен для резервирования в них мест</label>
            <table id="z_anketa_reserv_table" class="table table-bordered table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Лагерь</th>
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
                        <td class="text-center">Смена 1
                            <?php echo CHtml::activeTextField($model, 'srez_1', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 2
                            <?php echo CHtml::activeTextField($model, 'srez_2', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 3
                            <?php echo CHtml::activeTextField($model, 'srez_3', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 4
                            <?php echo CHtml::activeTextField($model, 'srez_4', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center">Смена 5
                            <?php echo CHtml::activeTextField($model, 'srez_5', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_BLUESCREEN); ?></th>
                        <td class="text-center">Смена 1
                            <?php echo CHtml::activeTextField($model, 'srez_6', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 2
                            <?php echo CHtml::activeTextField($model, 'srez_7', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 3
                            <?php echo CHtml::activeTextField($model, 'srez_8', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 4
                            <?php echo CHtml::activeTextField($model, 'srez_9', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_EAST_4); ?></th>
                        <td>&nbsp;</td>
                        <td class="text-center" colspan="2">Смена 1
                            <?php echo CHtml::activeTextField($model, 'srez_10', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 2
                            <?php echo CHtml::activeTextField($model, 'srez_11', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 3
                            <?php echo CHtml::activeTextField($model, 'srez_12', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_DIAMOND); ?></th>
                        <td>&nbsp;</td>
                        <td class="text-center" colspan="2">Смена 1
                            <?php echo CHtml::activeTextField($model, 'srez_13', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center">Смена 2
                            <?php echo CHtml::activeTextField($model, 'srez_14', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center">Смена 3
                            <?php echo CHtml::activeTextField($model, 'srez_15', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 4
                            <?php echo CHtml::activeTextField($model, 'srez_16', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_BONFIRE); ?></th>
                        <td>&nbsp;</td>
                        <td class="text-center" colspan="2">Смена 1
                            <?php echo CHtml::activeTextField($model, 'srez_17', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center">Смена 2
                            <?php echo CHtml::activeTextField($model, 'srez_18', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center">Смена 3
                            <?php echo CHtml::activeTextField($model, 'srez_19', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 4
                            <?php echo CHtml::activeTextField($model, 'srez_20', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_LIGHTHOUSE); ?></th>
                        <td>&nbsp;</td>
                        <td class="text-center" colspan="2">Смена 1
                            <?php echo CHtml::activeTextField($model, 'srez_21', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center" colspan="2">Смена 2
                            <?php echo CHtml::activeTextField($model, 'srez_22', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center">Смена 3
                            <?php echo CHtml::activeTextField($model, 'srez_23', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row"
                            class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_FLYGHT); ?></th>
                        <td>&nbsp;</td>
                        <td class="text-center">Смена 1
                            <?php echo CHtml::activeTextField($model, 'srez_24', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center">Смена 2
                            <?php echo CHtml::activeTextField($model, 'srez_25', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center">Смена 3
                            <?php echo CHtml::activeTextField($model, 'srez_26', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td class="text-center">Смена 4
                            <?php echo CHtml::activeTextField($model, 'srez_27', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3)); ?>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group text-right">
                <?php echo CHtml::submitButton('Применить', array('class' => 'btn btn-success')); ?>
            </div>

            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>