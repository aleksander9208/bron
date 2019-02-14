<div class="accordion" id="accordion_dlo">
    <?php
        $shifts = SiteService::getShifts();
        foreach (Questionnaire::getCAMPName() as $campId => $campName)
            {
    ?>
                <div class="card">
                    <div class="card-header btn btn-link text-left" id="camp_header_<?php echo $campId; ?>"  data-toggle="collapse" data-target="#camp_<?php echo $campId; ?>" aria-expanded="false" aria-controls="camp_<?php echo $campId; ?>">Сводная таблица по лагерю <b><?php echo $campName; ?></b></div>
                    <div id="camp_<?php echo $campId; ?>" class="collapse" aria-labelledby="camp_header_<?php echo $campId; ?>" data-parent="#accordion_dlo">
                        <div class="card-body p-0">
                            <div class="accordion" id="accordion_dlo_<?php echo $campId; ?>">
                                <?php
                                    foreach (Questionnaire::getShiftsByParams($campId) as $shiftId) { ?>
                                        <div class="card">
                                            <div class="card-header btn btn-link text-left" id="camp_header_<?php echo $campId; ?>_<?php echo $shiftId; ?>"  data-toggle="collapse" data-target="#camp_<?php echo $campId; ?>_<?php echo $shiftId; ?>" aria-expanded="false" aria-controls="camp_<?php echo $campId; ?>_<?php echo $shiftId; ?>">Смена <b><?php echo Questionnaire::getShiftName($shiftId); ?></b></div>
                                            <div id="camp_<?php echo $campId; ?>_<?php echo $shiftId; ?>" class="collapse" aria-labelledby="camp_header_<?php echo $campId; ?>_<?php echo $shiftId; ?>" data-parent="#accordion_dlo_<?php echo $campId; ?>">
                                                <div class="card-body p-0">
                                                    <div class="text-right">
                                                        <button class="btn btn-info btn-sm my-1 z_btn_print" role="button" data-target="#z_anketa_table_<?php echo $campId; ?>_<?php echo $shiftId; ?>">Печать таблицы</button>
                                                    </div>
                                                    <table id="z_anketa_table_<?php echo $campId; ?>_<?php echo $shiftId; ?>" class="table table-bordered table-striped table-hover table-sm">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col" class="text-center">Лагерь</th>
                                                                <th scope="col" class="text-center">Смена</th>
                                                                <th scope="col" class="text-center">Период</th>
                                                                <th scope="col" class="text-center">Тип</th>
                                                                <th scope="col" class="text-center">Дата подачи</th>
                                                                <th scope="col" class="text-center">ФИО представителя</th>
                                                                <th scope="col" class="text-center">ФИО Родителя</th>
                                                                <th scope="col" class="text-center">ФИО ребенка</th>
                                                                <th scope="col" class="text-center">Телефон представителя</th>
                                                                <th scope="col" class="text-center">Телефон родителя</th>
                                                                <th scope="col" class="text-center">E-mail представителя</th>
                                                                <th scope="col" class="text-center">E-mail родителя</th>
                                                                <th scope="col" class="text-center">Номер брони</th>
                                                                <th scope="col" class="text-center">Выкуплена</th>
                                                                <th scope="col" class="text-center">Комментарий</th>
                                                                <th scope="col" class="text-center">Создано администратором</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php if ((!isset($statData['questionnaire_main'][$campId][$shiftId]) || !$statData['questionnaire_main'][$campId][$shiftId]) && (!isset($statData['questionnaire'][$campId][$shiftId]) || !$statData['questionnaire'][$campId][$shiftId])) { ?>
                                                            <tr>
                                                                <td class="text-center" colspan="16">Данные отсутствуют</td>
                                                            </tr>
                                                        <?php } ?>

                                                        <?php
                                                        if (isset($statData['questionnaire_main'][$campId][$shiftId])) {
                                                            foreach ($statData['questionnaire_main'][$campId][$shiftId] as $v) { ?>
                                                                <tr class="<?php echo(($v['type'] == Questionnaire::TYPE_UR) ? 'table-info' : ''); ?>">
                                                                    <th scope="row" class="align-middle">#</th>
                                                                    <td scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName($campId); ?></td>
                                                                    <td class="text-center"><?php echo Questionnaire::getShiftName($shiftId); ?></td>
                                                                    <td class="text-center"> <?php echo SiteService::templateDLOFullRangeByData($shifts[$shiftId]['dlo']); ?></td>
                                                                    <td class="text-center"><?php echo Questionnaire::getTypeName($v['type']); ?></td>
                                                                    <td class="text-center"><?php echo $v['created']; ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['fio_ur_contact']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['fio_parent']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['fio_child']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['tel_ur_contact']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['tel_parent']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['email_ur_contact']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['email_parent']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['booking_id']); ?></td>
                                                                    <td class="text-center"><?php echo($v['paid'] ? 'Да' : 'Нет'); ?></td>
                                                                    <td class="text-center" data-comment-id="<?php echo $v['id'];?>"><?php echo CHtml::encode($v['comment']); ?></td>
                                                                    <td class="text-center"><?php echo($v['create_admin'] ? 'Да' : 'Нет'); ?></td>
                                                                </tr>
                                                            <?php }
                                                        }

                                                        if (isset($statData['questionnaire'][$campId][$shiftId])) {
                                                            foreach ($statData['questionnaire'][$campId][$shiftId] as $v) {  ?>
                                                                <tr class="<?php echo(($v['type'] == Questionnaire::TYPE_UR) ? 'table-info' : ''); ?>">
                                                                    <th scope="row" class="align-middle"><?php echo (int)($k+1); ?></th>
                                                                    <tdclass="align-middle"><?php echo Questionnaire::getCAMPName($campId); ?></td>
                                                                    <td class="text-center"><?php echo Questionnaire::getShiftName($shiftId); ?></td>
                                                                    <td class="text-center"> <?php echo SiteService::templateDLOFullRangeByData($shifts[$shiftId]['dlo']); ?></td>
                                                                    <td class="text-center"><?php echo Questionnaire::getTypeName($v['type']); ?></td>
                                                                    <td class="text-center"><?php echo date("H:i:s d-m-Y",strtotime($v['created'])); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['fio_ur_contact']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['fio_parent']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['fio_child']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['tel_ur_contact']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['tel_parent']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['email_ur_contact']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['email_parent']); ?></td>
                                                                    <td class="text-center"><?php echo CHtml::encode($v['booking_id']); ?></td>
                                                                    <td class="text-center"><?php echo($v['paid'] ? 'Да' : 'Нет'); ?></td>
                                                                    <td class="text-center" data-comment-id="<?php echo $v['id'];?>"><?php echo CHtml::encode($v['comment']); ?></td>
                                                                    <td class="text-center"><?php echo($v['create_admin'] ? 'Да' : 'Нет'); ?></td>
                                                                </tr>
                                                            <?php }
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
            }
    ?>
</div>
