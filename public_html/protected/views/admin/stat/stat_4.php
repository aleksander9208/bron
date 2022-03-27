<?php
$shifts = SiteService::getShifts();

if (!$statData['questionnaire']) { ?>
    <div id="page_stat_alert" class="alert alert-info mt-2" role="alert">Данные отсутствуют</div>
<?php } ?>

<div class="accordion" id="accordion_ur">
    <?php foreach ($statData['questionnaire'] as $name_ur => $k) { ?>
        <div class="card">
            <div class="card-header btn btn-link text-left" id="ur_header_<?php echo md5($name_ur); ?>"
                 data-toggle="collapse" data-target="#ur_<?php echo md5($name_ur); ?>" aria-expanded="false"
                 aria-controls="ur_<?php echo md5($name_ur); ?>">Сводная таблица по ЮЛ
                <b><?php echo CHtml::encode($name_ur); ?></b></div>

            <div id="ur_<?php echo md5($name_ur); ?>" class="collapse"
                 aria-labelledby="ur_header_<?php echo md5($name_ur); ?>" data-parent="#accordion_ur">
                <div class="card-body p-0">

                    <div class="text-right">
                        <button class="btn btn-info btn-sm my-1 z_btn_print" role="button"
                                data-target="#z_anketa_table_<?php echo md5($name_ur); ?>">
                            Печать таблицы
                        </button>
                    </div>
                    <table id="z_anketa_table_<?php echo md5($name_ur); ?>"
                           class="table table-bordered table-striped table-hover table-sm">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">№</th>
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
                        <?php if (!$k) { ?>
                            <tr>
                                <td class="text-center" colspan="17">Данные отсутствуют</td>
                            </tr>
                        <?php } ?>
                        <?php foreach ($k as $kk=> $v) { ?>
                            <tr class="<?php echo($v['create_admin'] ? 'table-info' : ''); ?>">
                                <th scope="row" class="align-middle"><?php echo (int)($kk+1); ?></th>
                                <td class="align-middle"><?php echo Questionnaire::getCAMPName($v['camp_id']); ?></td>
                                <td class="text-center"><?php echo Questionnaire::getShiftName($v['shift_id']); ?></td>
                                <td class="text-center"><?php echo SiteService::templateDLOFullRangeByData($shifts[$v['shift_id']]['dlo']); ?></td>
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
                                <td class="text-center"
                                    data-comment-id="<?php echo $v['id']; ?>"><?php echo CHtml::encode($v['comment']); ?></td>
                                <td class="text-center"><?php echo($v['create_admin'] ? 'Да' : 'Нет'); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
</div>