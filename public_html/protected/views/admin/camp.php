<div id="z_page_admin_camp" class="container-fluid">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>
            <div id="z_page_admin_camp_alert" class="alert <?php echo (Yii::app()->user->hasFlash('r_error')?'alert-danger':(Yii::app()->user->hasFlash('r_done')?'alert-success':'')); ?>" role="alert">
                <?php echo (Yii::app()->user->hasFlash('r_error')?Yii::app()->user->getFlash('r_error'):''); ?>
                <?php echo (Yii::app()->user->hasFlash('r_done')?Yii::app()->user->getFlash('r_done'):''); ?>
            </div>
            <?php echo CHtml::form('', 'post', array('class' => 'needs-validation', 'id' => 'z_anketa_form', 'novalidate' => 'novalidate')); ?>

            <label for="z_anketa_camp_table">Форма редактирования лагерей</label>

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
                    <td class="text-center"><b>Смена 1</b>
                        <?php echo CHtml::activeTextField($model, 'srez_1', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_KIROVEC_1]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_KIROVEC_1]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_KIROVEC_1]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_1]['seats'], $rfill[Questionnaire::SHIFT_KIROVEC_1]); ?>
                    </td>
                    <td> </td>
                    <td class="text-center"><b>Смена 2</b>
                        <?php echo CHtml::activeTextField($model, 'srez_2', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_KIROVEC_2]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_KIROVEC_2]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_KIROVEC_2]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_2]['seats'], $rfill[Questionnaire::SHIFT_KIROVEC_2]); ?>
                    </td>
                    <td> </td>
                    <td class="text-center"><b>Смена 3</b>
                        <?php echo CHtml::activeTextField($model, 'srez_3', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_KIROVEC_3]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_KIROVEC_3]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_KIROVEC_3]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_3]['seats'], $rfill[Questionnaire::SHIFT_KIROVEC_3]); ?>
                    </td>
                    <td> </td>
                    <td class="text-center"><b>Смена 4</b>
                        <?php echo CHtml::activeTextField($model, 'srez_4', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_KIROVEC_4]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_KIROVEC_4]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_KIROVEC_4]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_4]['seats'], $rfill[Questionnaire::SHIFT_KIROVEC_4]); ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row"class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_BLUESCREEN); ?></th>
                    <td class="text-center"><b>Смена 1</b>
                        <?php echo CHtml::activeTextField($model, 'srez_5', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_BLUESCREEN_1]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_BLUESCREEN_1]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_BLUESCREEN_1]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_1]['seats'], $rfill[Questionnaire::SHIFT_BLUESCREEN_1]); ?>
                    </td>
                    <td class="text-center"><b>Смена 2</b>
                        <?php echo CHtml::activeTextField($model, 'srez_6', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_BLUESCREEN_2]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_BLUESCREEN_2]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_BLUESCREEN_2]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_2]['seats'], $rfill[Questionnaire::SHIFT_BLUESCREEN_2]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 3</b>
                        <?php echo CHtml::activeTextField($model, 'srez_7', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_BLUESCREEN_3]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_BLUESCREEN_3]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_BLUESCREEN_3]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_3]['seats'], $rfill[Questionnaire::SHIFT_BLUESCREEN_3]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center" ><b>Смена 4</b>
                        <?php echo CHtml::activeTextField($model, 'srez_8', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_BLUESCREEN_4]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_BLUESCREEN_4]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_BLUESCREEN_4]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_4]['seats'], $rfill[Questionnaire::SHIFT_BLUESCREEN_4]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center" ><b>Смена 5</b>
                        <?php echo CHtml::activeTextField($model, 'srez_20', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_BLUESCREEN_5]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_BLUESCREEN_5]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_BLUESCREEN_5]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_5]['seats'], $rfill[Questionnaire::SHIFT_BLUESCREEN_5]); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_EAST_4); ?></th>
                    <td class="text-center"><b>Смена 1</b>
                        <?php echo CHtml::activeTextField($model, 'srez_9', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_EAST_1]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_EAST_1]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_EAST_1]['seats'], $shifts[Questionnaire::SHIFT_EAST_1]['seats'], $rfill[Questionnaire::SHIFT_EAST_1]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center" ><b>Смена 2</b>
                        <?php echo CHtml::activeTextField($model, 'srez_10', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_EAST_2]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_EAST_2]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_EAST_2]['seats'], $shifts[Questionnaire::SHIFT_EAST_2]['seats'], $rfill[Questionnaire::SHIFT_EAST_2]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 3</b>
                        <?php echo CHtml::activeTextField($model, 'srez_11', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_EAST_3]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_EAST_3]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_EAST_3]['seats'], $shifts[Questionnaire::SHIFT_EAST_3]['seats'], $rfill[Questionnaire::SHIFT_EAST_3]); ?>
                    </td><td>&nbsp;</td>
                    <td class="text-center"><b>Смена 4</b>
                        <?php echo CHtml::activeTextField($model, 'srez_28', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_EAST_4]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_EAST_4]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_EAST_4]['seats'], $shifts[Questionnaire::SHIFT_EAST_4]['seats'], $rfill[Questionnaire::SHIFT_EAST_4]); ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_DIAMOND); ?></th>
                    <td class="text-center"><b>Смена 1</b>
                        <?php echo CHtml::activeTextField($model, 'srez_12', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_DIAMOND_1]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_DIAMOND_1]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_DIAMOND_1]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_1]['seats'], $rfill[Questionnaire::SHIFT_DIAMOND_1]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 2</b>
                        <?php echo CHtml::activeTextField($model, 'srez_13', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_DIAMOND_2]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_DIAMOND_2]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_DIAMOND_2]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_2]['seats'], $rfill[Questionnaire::SHIFT_DIAMOND_2]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 3</b>
                        <?php echo CHtml::activeTextField($model, 'srez_14', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_DIAMOND_3]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_DIAMOND_3]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_DIAMOND_3]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_3]['seats'], $rfill[Questionnaire::SHIFT_DIAMOND_3]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 4</b>
                        <?php echo CHtml::activeTextField($model, 'srez_15', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_DIAMOND_4]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_DIAMOND_4]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_DIAMOND_4]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_4]['seats'], $rfill[Questionnaire::SHIFT_DIAMOND_4]); ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_BONFIRE); ?></th>
                    <td class="text-center"><b>Смена 1</b>
                        <?php echo CHtml::activeTextField($model, 'srez_16', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_BONFIRE_1]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_BONFIRE_1]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_BONFIRE_1]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_1]['seats'], $rfill[Questionnaire::SHIFT_BONFIRE_1]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 2</b>
                        <?php echo CHtml::activeTextField($model, 'srez_17', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_BONFIRE_2]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_BONFIRE_2]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_BONFIRE_2]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_2]['seats'], $rfill[Questionnaire::SHIFT_BONFIRE_2]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 3</b>
                        <?php echo CHtml::activeTextField($model, 'srez_18', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_BONFIRE_3]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_BONFIRE_3]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_BONFIRE_3]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_3]['seats'], $rfill[Questionnaire::SHIFT_BONFIRE_3]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 4</b>
                        <?php echo CHtml::activeTextField($model, 'srez_19', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_BONFIRE_4]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_BONFIRE_4]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_BONFIRE_4]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_4]['seats'], $rfill[Questionnaire::SHIFT_BONFIRE_4]); ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_LIGHTHOUSE); ?></th>
                    <td class="text-center"><b>Смена 1</b>
                        <?php echo CHtml::activeTextField($model, 'srez_21', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_LIGHTHOUSE_1]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['seats'], $rfill[Questionnaire::SHIFT_LIGHTHOUSE_1]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 2</b>
                        <?php echo CHtml::activeTextField($model, 'srez_22', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_LIGHTHOUSE_2]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_LIGHTHOUSE_2]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_LIGHTHOUSE_2]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_2]['seats'], $rfill[Questionnaire::SHIFT_LIGHTHOUSE_2]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 3</b>
                        <?php echo CHtml::activeTextField($model, 'srez_23', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_LIGHTHOUSE_3]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_LIGHTHOUSE_3]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_LIGHTHOUSE_3]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_3]['seats'], $rfill[Questionnaire::SHIFT_LIGHTHOUSE_3]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 4</b>
                        <?php echo CHtml::activeTextField($model, 'srez_29', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_LIGHTHOUSE_4]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_LIGHTHOUSE_4]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_LIGHTHOUSE_4]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_4]['seats'], $rfill[Questionnaire::SHIFT_LIGHTHOUSE_4]); ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row"
                        class="align-middle"><?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_FLYGHT); ?></th>
                    <td class="text-center"><b>Смена 1</b>
                        <?php echo CHtml::activeTextField($model, 'srez_24', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_FLYGHT_1]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_FLYGHT_1]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_FLYGHT_1]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_1]['seats'], $rfill[Questionnaire::SHIFT_FLYGHT_1]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 2</b>
                        <?php echo CHtml::activeTextField($model, 'srez_25', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_FLYGHT_2]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_FLYGHT_2]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_FLYGHT_2]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_2]['seats'], $rfill[Questionnaire::SHIFT_FLYGHT_2]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 3</b>
                        <?php echo CHtml::activeTextField($model, 'srez_26', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_FLYGHT_3]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_FLYGHT_3]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_FLYGHT_3]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_3]['seats'], $rfill[Questionnaire::SHIFT_FLYGHT_3]); ?>
                    </td>
                    <td>&nbsp;</td>
                    <td class="text-center"><b>Смена 4</b>
                        <?php echo CHtml::activeTextField($model, 'srez_27', array('class' => 'form-control text-center', 'data-mask'=>'0123456789', 'maxlength'=>3, 'data-max'=>$shifts[Questionnaire::SHIFT_FLYGHT_4]['seats'], 'data-toggle'=>'tooltip', 'title'=>'Значение от 0 из '.$shifts[Questionnaire::SHIFT_FLYGHT_4]['seats'])); ?>
                        <?php echo SiteService::templateSeatsCount($seats[Questionnaire::SHIFT_FLYGHT_4]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_4]['seats'], $rfill[Questionnaire::SHIFT_FLYGHT_4]); ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                </tbody>
            </table>

            <br>
            <br>
            <br>
            <table id="z_anketa_table" class="table table-bordered table-striped table-hover table-sm">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">Лагерь</th>
                    <th scope="col" class="text-center">Рекомендуемый возраст</th>
                    <th scope="col" class="text-center" width="14%"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_1, true); ?></th>
                    <th scope="col" class="text-center" width="14%"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_2, true); ?></th>
                    <th scope="col" class="text-center" width="14%"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_3, true); ?></th>
                    <th scope="col" class="text-center" width="14%"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_4, true); ?></th>
                    <th scope="col" class="text-center" width="14%"><?php echo Questionnaire::getDLOName(Questionnaire::DLO_5, true); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row" class="align-middle text-center">
                        <?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_KIROVEC); ?><br/>
                        <small>ул. Дубовая, 56</small>
                    </th>
                    <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_KIROVEC_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_KIROVEC_1]['max_age'];?> лет</td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_1; ?>" data-shift="<?php echo Questionnaire::SHIFT_KIROVEC_1; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_1); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_KIROVEC_1, $seats[Questionnaire::SHIFT_KIROVEC_1]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_1]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_1]['min_age'],$shifts[Questionnaire::SHIFT_KIROVEC_1]['max_age'], $postShifts, '1'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_3; ?>" data-shift="<?php echo Questionnaire::SHIFT_KIROVEC_2; ?>">
                        <div>21 день</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_3); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_KIROVEC_2, $seats[Questionnaire::SHIFT_KIROVEC_2]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_2]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_2]['min_age'],$shifts[Questionnaire::SHIFT_KIROVEC_2]['max_age'], $postShifts, '3'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_5; ?>" data-shift="<?php echo Questionnaire::SHIFT_KIROVEC_3; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_5); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_KIROVEC_3, $seats[Questionnaire::SHIFT_KIROVEC_3]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_3]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_3]['min_age'],$shifts[Questionnaire::SHIFT_KIROVEC_3]['max_age'], $postShifts, '5'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_7; ?>" data-shift="<?php echo Questionnaire::SHIFT_KIROVEC_4; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_7); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_KIROVEC_4, $seats[Questionnaire::SHIFT_KIROVEC_4]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_4]['seats'], $shifts[Questionnaire::SHIFT_KIROVEC_4]['min_age'],$shifts[Questionnaire::SHIFT_KIROVEC_4]['max_age'], $postShifts, '7'); ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle text-center">
                        <?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_BLUESCREEN); ?><br/>
                        <small>ул. Дачный Проспект, 162</small>
                    </th>
                    <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_BLUESCREEN_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_BLUESCREEN_1]['max_age'];?> лет</td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_1; ?>" data-shift="<?php echo Questionnaire::SHIFT_BLUESCREEN_1; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_1); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_BLUESCREEN_1, $seats[Questionnaire::SHIFT_BLUESCREEN_1]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_1]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_1]['min_age'],$shifts[Questionnaire::SHIFT_BLUESCREEN_1]['max_age'], $postShifts, '1'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_2; ?>" data-shift="<?php echo Questionnaire::SHIFT_BLUESCREEN_2; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_2); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_BLUESCREEN_2, $seats[Questionnaire::SHIFT_BLUESCREEN_2]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_2]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_2]['min_age'],$shifts[Questionnaire::SHIFT_BLUESCREEN_2]['max_age'], $postShifts, '2'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_4; ?>" data-shift="<?php echo Questionnaire::SHIFT_BLUESCREEN_3; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_4); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_BLUESCREEN_3, $seats[Questionnaire::SHIFT_BLUESCREEN_3]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_3]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_3]['min_age'],$shifts[Questionnaire::SHIFT_BLUESCREEN_3]['max_age'], $postShifts, '4'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_6; ?>" data-shift="<?php echo Questionnaire::SHIFT_BLUESCREEN_4; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_6); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_BLUESCREEN_4, $seats[Questionnaire::SHIFT_BLUESCREEN_4]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_4]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_4]['min_age'],$shifts[Questionnaire::SHIFT_BLUESCREEN_4]['max_age'], $postShifts, '6'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_8; ?>" data-shift="<?php echo Questionnaire::SHIFT_BLUESCREEN_5; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_8); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_BLUESCREEN_5, $seats[Questionnaire::SHIFT_BLUESCREEN_5]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_5]['seats'], $shifts[Questionnaire::SHIFT_BLUESCREEN_5]['min_age'],$shifts[Questionnaire::SHIFT_BLUESCREEN_5]['max_age'], $postShifts, '8'); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle text-center">
                        <?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_EAST_4); ?><br/>
                        <small>Репное</small>
                    </th>
                    <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_EAST_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_EAST_1]['max_age'];?> лет</td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_1; ?>" data-shift="<?php echo Questionnaire::SHIFT_EAST_1; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_1); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_EAST_1, $seats[Questionnaire::SHIFT_EAST_1]['seats'], $shifts[Questionnaire::SHIFT_EAST_1]['seats'], $shifts[Questionnaire::SHIFT_EAST_1]['min_age'],$shifts[Questionnaire::SHIFT_EAST_1]['max_age'], $postShifts, '1'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_3; ?>" data-shift="<?php echo Questionnaire::SHIFT_EAST_2; ?>">
                        <div>21 день</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_3); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_EAST_2, $seats[Questionnaire::SHIFT_EAST_2]['seats'], $shifts[Questionnaire::SHIFT_EAST_2]['seats'], $shifts[Questionnaire::SHIFT_EAST_2]['min_age'],$shifts[Questionnaire::SHIFT_EAST_2]['max_age'], $postShifts, '3'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_5; ?>" data-shift="<?php echo Questionnaire::SHIFT_EAST_3; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_5); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_EAST_3, $seats[Questionnaire::SHIFT_EAST_3]['seats'], $shifts[Questionnaire::SHIFT_EAST_3]['seats'], $shifts[Questionnaire::SHIFT_EAST_3]['min_age'],$shifts[Questionnaire::SHIFT_EAST_3]['max_age'], $postShifts, '5'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_7; ?>" data-shift="<?php echo Questionnaire::SHIFT_EAST_4; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_7); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_EAST_4, $seats[Questionnaire::SHIFT_EAST_4]['seats'], $shifts[Questionnaire::SHIFT_EAST_4]['seats'], $shifts[Questionnaire::SHIFT_EAST_4]['min_age'],$shifts[Questionnaire::SHIFT_EAST_4]['max_age'], $postShifts, '7'); ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle text-center">
                        <?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_DIAMOND); ?><br/>
                        <small>ул. Дубовая, 44</small>
                    </th>
                    <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_DIAMOND_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_DIAMOND_1]['max_age'];?> лет</td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_1; ?>" data-shift="<?php echo Questionnaire::SHIFT_DIAMOND_1; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_1); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_DIAMOND_1, $seats[Questionnaire::SHIFT_DIAMOND_1]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_1]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_1]['min_age'],$shifts[Questionnaire::SHIFT_DIAMOND_1]['max_age'], $postShifts, '1'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_3; ?>" data-shift="<?php echo Questionnaire::SHIFT_DIAMOND_2; ?>">
                        <div>21 день</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_3); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_DIAMOND_2, $seats[Questionnaire::SHIFT_DIAMOND_2]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_2]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_2]['min_age'],$shifts[Questionnaire::SHIFT_DIAMOND_2]['max_age'], $postShifts, '3'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_5; ?>" data-shift="<?php echo Questionnaire::SHIFT_DIAMOND_3; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_5); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_DIAMOND_3, $seats[Questionnaire::SHIFT_DIAMOND_3]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_3]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_3]['min_age'],$shifts[Questionnaire::SHIFT_DIAMOND_3]['max_age'], $postShifts, '5'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_7; ?>" data-shift="<?php echo Questionnaire::SHIFT_DIAMOND_4; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_7); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_DIAMOND_4, $seats[Questionnaire::SHIFT_DIAMOND_4]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_4]['seats'], $shifts[Questionnaire::SHIFT_DIAMOND_4]['min_age'],$shifts[Questionnaire::SHIFT_DIAMOND_4]['max_age'], $postShifts, '7'); ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle text-center">
                        <?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_BONFIRE); ?><br/>
                        <small>ул. Парковая, д. 1</small>
                    </th>
                    <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_BONFIRE_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_BONFIRE_1]['max_age'];?> лет</td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_1; ?>" data-shift="<?php echo Questionnaire::SHIFT_BONFIRE_1; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_1); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_BONFIRE_1, $seats[Questionnaire::SHIFT_BONFIRE_1]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_1]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_1]['min_age'],$shifts[Questionnaire::SHIFT_BONFIRE_1]['max_age'], $postShifts, '1'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_3; ?>" data-shift="<?php echo Questionnaire::SHIFT_BONFIRE_2; ?>">
                        <div>21 день</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_3); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_BONFIRE_2, $seats[Questionnaire::SHIFT_BONFIRE_2]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_2]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_2]['min_age'],$shifts[Questionnaire::SHIFT_BONFIRE_2]['max_age'], $postShifts, '3'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_5; ?>" data-shift="<?php echo Questionnaire::SHIFT_BONFIRE_3; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_5); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_BONFIRE_3, $seats[Questionnaire::SHIFT_BONFIRE_3]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_3]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_3]['min_age'],$shifts[Questionnaire::SHIFT_BONFIRE_3]['max_age'], $postShifts, '5'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_7; ?>" data-shift="<?php echo Questionnaire::SHIFT_BONFIRE_4; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_7); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_BONFIRE_4, $seats[Questionnaire::SHIFT_BONFIRE_4]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_4]['seats'], $shifts[Questionnaire::SHIFT_BONFIRE_4]['min_age'],$shifts[Questionnaire::SHIFT_BONFIRE_4]['max_age'], $postShifts, '7'); ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle text-center">
                        <?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_LIGHTHOUSE); ?><br/>
                        <small>ул. Тепличная, 1о</small>
                    </th>
                    <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['max_age'];?> лет</td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_1; ?>" data-shift="<?php echo Questionnaire::SHIFT_LIGHTHOUSE_1; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_1); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_LIGHTHOUSE_1, $seats[Questionnaire::SHIFT_LIGHTHOUSE_1]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['min_age'],$shifts[Questionnaire::SHIFT_LIGHTHOUSE_1]['max_age'], $postShifts, '1'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_3; ?>" data-shift="<?php echo Questionnaire::SHIFT_LIGHTHOUSE_2; ?>">
                        <div>21 день</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_3); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_LIGHTHOUSE_2, $seats[Questionnaire::SHIFT_LIGHTHOUSE_2]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_2]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_2]['min_age'],$shifts[Questionnaire::SHIFT_LIGHTHOUSE_2]['max_age'], $postShifts, '3'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_5; ?>" data-shift="<?php echo Questionnaire::SHIFT_LIGHTHOUSE_3; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_5); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_LIGHTHOUSE_3, $seats[Questionnaire::SHIFT_LIGHTHOUSE_3]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_3]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_3]['min_age'],$shifts[Questionnaire::SHIFT_LIGHTHOUSE_3]['max_age'], $postShifts, '5'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_7; ?>" data-shift="<?php echo Questionnaire::SHIFT_LIGHTHOUSE_4; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_7); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_LIGHTHOUSE_4, $seats[Questionnaire::SHIFT_LIGHTHOUSE_4]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_4]['seats'], $shifts[Questionnaire::SHIFT_LIGHTHOUSE_4]['min_age'],$shifts[Questionnaire::SHIFT_LIGHTHOUSE_4]['max_age'], $postShifts, '7'); ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle text-center">
                        <?php echo Questionnaire::getCAMPName(Questionnaire::CAMP_FLYGHT); ?><br/>
                        <small>ул. Дубовая, 56</small>
                    </th>
                    <td class="text-center">от <?php echo $shifts[Questionnaire::SHIFT_FLYGHT_1]['min_age']; ?> до <?php echo $shifts[Questionnaire::SHIFT_FLYGHT_1]['max_age'];?> лет</td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_1; ?>" data-shift="<?php echo Questionnaire::SHIFT_FLYGHT_1; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_1); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_FLYGHT_1, $seats[Questionnaire::SHIFT_FLYGHT_1]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_1]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_1]['min_age'],$shifts[Questionnaire::SHIFT_FLYGHT_1]['max_age'], $postShifts, '1'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_3; ?>" data-shift="<?php echo Questionnaire::SHIFT_FLYGHT_2; ?>">
                        <div>21 день</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_3); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_FLYGHT_2, $seats[Questionnaire::SHIFT_FLYGHT_2]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_2]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_2]['min_age'],$shifts[Questionnaire::SHIFT_FLYGHT_2]['max_age'], $postShifts, '3'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_5; ?>" data-shift="<?php echo Questionnaire::SHIFT_FLYGHT_3; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_5); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_FLYGHT_3, $seats[Questionnaire::SHIFT_FLYGHT_3]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_3]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_3]['min_age'],$shifts[Questionnaire::SHIFT_FLYGHT_3]['max_age'], $postShifts, '5'); ?>
                    </td>
                    <td class="text-center" data-dlo="<?php echo Questionnaire::DLO_7; ?>" data-shift="<?php echo Questionnaire::SHIFT_FLYGHT_4; ?>">
                        <div>14 дней</div>
                        <strong><?php echo Questionnaire::getDLOName(Questionnaire::DLO_7); ?></strong>
                        <br/>
                        <?php echo SiteService::templateChecker('',Questionnaire::SHIFT_FLYGHT_4, $seats[Questionnaire::SHIFT_FLYGHT_4]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_4]['seats'], $shifts[Questionnaire::SHIFT_FLYGHT_4]['min_age'],$shifts[Questionnaire::SHIFT_FLYGHT_4]['max_age'], $postShifts, '7'); ?>
                    </td>
                    <td></td>
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
