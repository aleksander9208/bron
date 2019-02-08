<?php
$shifts = SiteService::getShifts();
foreach (Questionnaire::getCAMPName() as $campId => $campName) { ?>

    <label for="z_anketa_table">Сводная таблица по лагерю <b><?php echo $campName; ?></b></label>
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

        <?php

        foreach ($statData['questionnaire_main'][$campId] as $shiftId => $z) {
            foreach ($z as $v) { ?>
                <tr class="<?php echo(($v['type'] == Questionnaire::TYPE_UR) ? 'table-info' : ''); ?>">
                    <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName($campId); ?></th>
                    <td class="text-center"><?php echo Questionnaire::getShiftName($shiftId); ?></td>
                    <td class="text-center"> <?php foreach ($shifts[$shiftId]['dlo'] as $d) {echo Questionnaire::getDLOName($d) . '; '; } ?></td>
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
                    <td class="text-center"><?php echo ($v['paid']?'Да':'Нет'); ?></td>
                    <td class="text-center"><?php echo CHtml::encode($v['comment']); ?></td>
                    <td class="text-center"><?php echo ($v['create_admin']?'Да':'Нет'); ?></td>
                </tr>
            <?php }
        }
        foreach ($statData['questionnaire'][$campId] as $shiftId => $z) {
            foreach ($z as $v) { ?>
                <tr class="<?php echo(($v['type'] == Questionnaire::TYPE_UR) ? 'table-info' : ''); ?>">
                    <th scope="row" class="align-middle"><?php echo Questionnaire::getCAMPName($campId); ?></th>
                    <td class="text-center"><?php echo Questionnaire::getShiftName($shiftId); ?></td>
                    <td class="text-center"> <?php foreach ($shifts[$shiftId]['dlo'] as $d) {echo Questionnaire::getDLOName($d) . '; '; } ?></td>
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
                    <td class="text-center"><?php echo ($v['paid']?'Да':'Нет'); ?></td>
                    <td class="text-center"><?php echo CHtml::encode($v['comment']); ?></td>
                    <td class="text-center"><?php echo ($v['create_admin']?'Да':'Нет'); ?></td>
                </tr>
            <?php } ?>
        <?php } ?>

        </tbody>
    </table>

<?php } ?>