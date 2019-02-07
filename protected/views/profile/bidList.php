<div id="z_page_anketa_list" class="container-fluid">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php
            $this->widget('MyGridView', array(
                'id' => 'vacr-grid',
                'dataProvider' => $model->getBidList('/admin/index'),
                'ajaxUpdate' => false, // 'vacr-grid',
                'summaryText' => '',
                'filter' => $model,
                'enableHistory' => false,
                'pagerCssClass' => 'pagination',

                'htmlOptions' => array('class' => 'table table-bordered table-striped table-hover table-sm'),
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

                    array(
                        'header' => 'Информация',
                        'name' => 'status',
                        'type' => 'raw',
                        'value' => '(($data->status=='.Questionnaire::STATUS_OK.')?( SiteService::checkTurn($data->user_id, $data->shift_id)?"Вам присвоен номер ".$data->booking_id." брони на путевку":"Ваше заявление на путевку находится в листе ожидания") :"")',
                        'htmlOptions' => array('align' => 'center'),
                        'filter' => false,
                        'headerHtmlOptions' => array('class' => 'col')
                    ),

                ),
            ));
            ?>
        </div>
    </div>
</div>