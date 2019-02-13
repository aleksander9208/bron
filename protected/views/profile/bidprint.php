<div id="z_page_anketa_print">
    <h1 align="center"><?php echo CHtml::encode($title); ?></h1>
    <div id="z_page_anketa_print_table">
        <div class="row">
            <label style="width: 20%;">Дата подачи заявки</label>
            <div><?php echo $model->created; ?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('type'); ?></label>
            <div><?php echo Questionnaire::getTypeName($model->type); ?></div>
        </div>
        <div class="row">
            <label>Текущий статус заявки</label>
            <div><?php echo Questionnaire::getStatusName($model->status); ?></div>
        </div>

    <?php if ($model->type == Questionnaire::TYPE_UR) { ?>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('name_ur'); ?></label>
            <div><?php echo CHtml::encode($model->name_ur); ?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('fio_ur_contact'); ?></label>
            <div><?php echo CHtml::encode($model->fio_ur_contact); ?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('tel_ur_contact'); ?></label>
            <div><?php echo CHtml::encode($model->tel_ur_contact); ?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('email_ur_contact'); ?></label>
            <div><?php echo CHtml::encode($model->email_ur_contact);?></div>
        </div>
    <?php } ?>

        <div class="row">
            <label><?php echo $model->getAttributeLabel('fio_parent'); ?></label>
            <div><?php echo CHtml::encode($model->fio_parent);?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('residence'); ?></label>
            <div><?php echo CHtml::encode($model->residence);?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('place_of_work'); ?></label>
            <div><?php echo CHtml::encode($model->place_of_work);?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('tel_parent'); ?></label>
            <div><?php echo CHtml::encode($model->tel_parent);?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('email_parent'); ?></label>
            <div><?php echo CHtml::encode($model->email_parent);?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('fio_child'); ?></label>
            <div><?php echo CHtml::encode($model->fio_child);?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('birthday_child'); ?></label>
            <div><?php echo CHtml::encode($model->birthday_child);?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('place_of_study'); ?></label>
            <div><?php echo CHtml::encode($model->place_of_study); ?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('shift_id'); ?></label>
            <div><?php echo Questionnaire::getShiftName($model->shift_id); ?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('dlo_id'); ?></label>
            <div><?php echo SiteService::templateDLOFullRangeByData($shifts[$model->shift_id]['dlo']); ?></div>
        </div>
        <div class="row">
            <label><?php echo $model->getAttributeLabel('camp_id'); ?></label>
            <div><?php echo Questionnaire::getCAMPName($model->camp_id); ?></div>
        </div>
    </div>
</div>