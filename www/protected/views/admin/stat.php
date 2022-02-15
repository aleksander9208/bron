<div id="z_page_admin_statistics" class="container-fluid">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>

            <?php echo CHtml::form('/admin/stat', 'get', array('class' => 'needs-validation', 'id' => 'z_admin_statistics_form')); ?>
            <label for="z_admin_statistics_stat_id">Раздел статистаки</label>
            <?php echo CHtml::dropDownList('stat_id', $statId, array(1 => 'Общая', 2 => 'По лагерям', 3 => 'По лагерям и сменам', 4 => 'По юр.лицам', 5 => 'По юр.лицам, лагерям и сменам'), array('id' => 'z_admin_statistics_stat_id','class'=>'custom-select mb-2')); ?>

            <?php echo CHtml::endForm(); ?>
            <?php
            switch ($statId) {
                case 1:
                    echo $this->renderPartial('stat/stat_' . $statId, array('model' => $model), true);
                    break;
                case 2:
                case 3:
                case 4:
                case 5:
                    echo $this->renderPartial('stat/stat_' . $statId, array('statData' => $statData), true);
                    break;
                default:
                    echo $this->renderPartial('stat/stat_1', array('model' => $model), true);

            }
            ?>
        </div>
    </div>
</div>