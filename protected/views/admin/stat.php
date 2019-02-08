<div id="wna_page_advertslist" class="container-fluid px-4">
    <div class="mb-4"></div>
    <div class="clearfix mb-4">
        <h1 class="float-left"><?php echo $title; ?></h1>
    </div>
    <!-- Вкладка «Статистика» -->

    <div class="container-fluid px-0">

        <script>
            $(function () {
                $('#stat_id').change(function () {
                    this.form.submit();
                });
            });
        </script>
        <?php echo CHtml::form('/admin/stat', 'get', array('class' => 'needs-validation', 'id' => 'z_anketa_form')); ?>
        <?php echo CHtml::dropDownList('stat_id', $statId, array(1 => 'Общая', 2 => 'По лагерям', 3 => 'По лагерям и сменам', 4 => 'По юр.лицам', 5 => 'По юр.лицам, лагерям и сменам'), array('id' => 'stat_id','class'=>'custom-select')); ?>
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
