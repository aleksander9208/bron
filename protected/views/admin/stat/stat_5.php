<?php
$shifts = SiteService::getShifts();
foreach ($statData['questionnaire'] as $name_ur => $k) { ?>
    <?php foreach ($statData['questionnaire'] as $name_ur => $vvvv) { ?>
        <?php foreach ($vvvv as $campId => $vvv) { ?>
            <?php foreach ($vvv as $shiftId => $vv) { ?>
                <?php foreach ($vv as $v) { ?>
                    <label for="z_anketa_table">Сводная таблица по ЮЛ <b><?php echo CHtml::encode($name_ur); ?></b>
                        ,лагерю <b><?php echo Questionnaire::getCAMPName($campId); ?></b> и их смене
                        <b><?php echo Questionnaire::getShiftName($shiftId); ?></b></label>
                    <table id="z_anketa_table" class="table table-bordered table-striped table-hover table-sm">
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
                        <tr class="<?php echo($v['create_admin'] ? 'table-info' : ''); ?>">
                            <th scope="row"
                                class="align-middle"><?php echo Questionnaire::getCAMPName($v['camp_id']); ?></th>
                            <td class="text-center"><?php echo Questionnaire::getShiftName($v['shift_id']); ?></td>
                            <td class="text-center"> <?php foreach ($shifts[$v['shift_id']]['dlo'] as $d) {
                                    echo Questionnaire::getDLOName($d) . '; ';
                                } ?></td>
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
                            <td class="text-center"><?php echo CHtml::encode($v['comment']); ?></td>
                            <td class="text-center"><?php echo($v['create_admin'] ? 'Да' : 'Нет'); ?></td>
                        </tr>

                        </tbody>
                    </table>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
<?php } ?>
