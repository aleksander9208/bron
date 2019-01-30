<div id="wna_page_advertslist" class="container-fluid px-4">
    <div class="mb-4"></div>
    <div class="clearfix mb-4">
        <h1 class="float-left"><?php echo $title; ?></h1>
    </div>
    <!-- Вкладка «Статистика» -->

    <div class="container-fluid px-0">
        <?php
        $this->widget('MyGridView', array(
            'id' => 'vacr-grid',
            'dataProvider' => $model->getBidList('/admin/index'),
            'ajaxUpdate' => false, // 'vacr-grid',
            'summaryText' => '',
            'filter' => $model,
            'enableHistory' => false,
            'pagerCssClass' => 'pagination',

            'htmlOptions' => array('class' => 'table table-hover'),
            //'headerHtmlOptions' => array('class' => 'thead-light'),
            'itemsCssClass' => 'user-list-table table table-bordered table-hover',
            'ajaxUrl' => Yii::app()->createUrl('/admin/index'),
            'enableSorting' => true,
            'pager' => array(
                'cssFile' => false,
                'class' => 'MyLinkPager',
                'header' => '',
                'prevPageLabel' => 'Назад',
                'nextPageLabel' => 'Вперед',
                'lastPageLabel' => false,
                'firstPageLabel' => false,
                'selectedPageCssClass' => 'active',
                'hiddenPageCssClass' => 'disabled',
                'previousPageCssClass' => 'page-item',
                'nextPageCssClass' => 'page-item',
                'internalPageCssClass' => 'page-item',
                'htmlOptions' => array(
                    'class' => 'pagination',
                )
            ),
            'columns' => array(
                array(
                    'header' => '№',
                    'name' => '#',
                    'type' => 'raw',
                  //  'value' => 'CHtml::link(($row + ($this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize) + 1),"/admin/bid/".$data->id)',
                    'value' => 'CHtml::link($data->id,"/profile/bid/".$data->id)',
                    'htmlOptions' => array('class' => 'num_string'),
                    'headerHtmlOptions' => array('class' => 'col'),
                    'filter' => false,
                ),
                array(
                    'header' => 'Дата подачи',
                    'name' => 'created',
                    'value' => '$data->created',
                    'htmlOptions' => array('align' => 'center'),
                    'filter' => false,
                    'headerHtmlOptions' => array('class' => 'col')
                ),
                array(
                    'header' => 'ФИО ребенка',
                    'name' => 'fio_child',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->fio_child,"/profile/bid/".$data->id)',
                    'htmlOptions' => array('align' => 'center'),
                    'headerHtmlOptions' => array('class' => 'col'),
                    'filter' =>false,
                ),
                array(
                    'header' => 'Статус',
                    'name' => 'status',
                    'type' => 'raw',
                    'value' => 'Questionnaire::getSatusName($data->status)',
                    'htmlOptions' => array('align' => 'center'),
                    'filter' => false,
                    'headerHtmlOptions' => array('class' => 'col')
                ),

            ),
        ));
        ?>
    </div>
</div>
