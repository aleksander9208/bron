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
                'id' => 'z_anketa_list_table',
                'dataProvider' => $model->getBidList('/profile/index'),
                'ajaxUpdate' =>  'z_anketa_list_table',
                'ajaxUrl' => Yii::app()->createUrl('/profile/index'),
                'summaryText' => '',
                'filter' => $model,
                'enableHistory' => false,
                'pagerCssClass' => 'pagination',

                'htmlOptions' => array('class' => ''),
                //'headerHtmlOptions' => array('class' => 'thead-dark'),
                'itemsCssClass' => 'table table-bordered table-striped table-hover table-sm',
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
                        'value' => '($row + ($this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize) + 1)',
                        //'value' => 'CHtml::link($data->id,"/profile/bid/".$data->id)',
                        'filter' => false,
                        'htmlOptions' => array('class' => 'font-weight-bold text-center', 'scope' => 'row'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                    ),
                    array(
                        'header' => 'ФИО ребенка',
                        'name' => 'fio_child',
                        'type' => 'raw',
                        'value' => '$data->fio_child',
                        'filter' => false,
                        'htmlOptions' => array('class' => 'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                    ),
                    array(
                        'header' => 'Лагерь',
                        'name' => 'camp_id',
                        'value' => 'Questionnaire::getCAMPName($data->camp_id)',
                        'filter' => false,
                        'htmlOptions' => array('class' => 'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                    ),
                    array(
                        'header' => 'Cмена',
                        'name' => 'shift_id',
                        'type' => 'raw',
                        'value' => 'Questionnaire::getShiftName($data->shift_id)."<br/>".SiteService::templateDloRange($data->shift_id)',
                        'filter' => false,
                        'htmlOptions' => array('class' => 'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                    ),
                    /*array(
                        'header' => 'Дата подачи',
                        'name' => 'created',
                        'value' => '$data->created',
                        'filter' => false,
                        'htmlOptions' => array('class' => 'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                    ),*/
                    array(
                        'header' => 'Информация',
                        'name' => 'status',
                        'type' => 'raw',
                        'value' => '(($data->status==' . Questionnaire::STATUS_OK . ')?( SiteService::checkTurn($data->user_id, $data->shift_id)?"Вам присвоен номер ".$data->booking_id." брони на путевку":"Ваша заявка находится в листе ожидания") :"").(((Yii::app()->user->role==User::ROLE_ADMIN)&& ($data->booking_id))?"Резерв":"") ',
                        'filter' => false,
                        'htmlOptions' => array('class' => 'text-left'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                    ),
                    array(
                        'header' => 'Статус',
                        'name' => 'status',
                        'type' => 'raw',
                        'value' => 'CHtml::link(Questionnaire::getStatusName($data->status),"/profile/bid/".$data->id, array("class"=>"btn btn-success btn-sm") )',
                        'filter' => false,
                        'htmlOptions' => array('class' => 'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                    ),

                ),
            ));
            ?>
        </div>
    </div>
</div>