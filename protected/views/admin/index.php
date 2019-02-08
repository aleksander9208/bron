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
            'ajaxUpdate' =>  'vacr-grid', //false
            'summaryText' => '',
            'filter' => $model,
            'enableHistory' => false,
            'pagerCssClass' => 'pagination',
            'htmlOptions' => array('class' => 'table table-hover'),
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
                    'name' => 'id',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->id,"/admin/bid/".$data->id)',
                    'htmlOptions' => array('class' => 'font-weight-bold'),
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                    'filter' => CHtml::activeTextField($model, 'id', array('class' => 'form-control')),
                ),
                array(
                    'header' => 'Дата подачи',
                    'name' => 'created',
                    'value' => '$data->created',
                    'htmlOptions' => array('class'=>'text-center', 'scope' => 'row'),
                    'filter' => false,
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col')
                ),
                array(
                    'header' => 'ФИО ребенка',
                    'name' => 'fio_child',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->fio_child,"/admin/bid/".$data->id)',
                    'htmlOptions' => array('class'=>'text-center'),
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                    'filter' => CHtml::activeTextField($model, 'fio_child', array('class' => 'form-control')),
                ),
                array(
                    'header' => 'Тип',
                    'name' => 'type',
                    'value' => 'Questionnaire::getTypeName($data->type)',
                    'htmlOptions' => array('class'=>'text-center'),
                    'filter' => Questionnaire::getTypeName(),
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                ),

                array(
                    'header' => 'Статус',
                    'name' => 'status',
                    'type' => 'raw',
                    'value' => 'Questionnaire::getSatusName($data->status)',
                    'htmlOptions' => array('class'=>'text-center'),
                    'filter' => Questionnaire::getSatusName(),
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                ),

                array(
                    'header' => 'ФИО представителя',
                    'name' => 'fio_ur_contact',
                    'value' => '$data->fio_ur_contact',
                    'htmlOptions' => array('class'=>'text-center'),
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                    'filter' => CHtml::activeTextField($model, 'fio_ur_contact', array('class' => 'form-control')),
                ),
                array(
                    'header' => 'ФИО Родителя',
                    'name' => 'fio_parent',
                    'value' => '$data->fio_parent',
                    'htmlOptions' => array('class'=>'text-center'),
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                    'filter' => CHtml::activeTextField($model, 'fio_parent', array('class' => 'form-control')),
                ),
                array(
                    'header' => 'Телефон родителя',
                    'name' => 'tel_parent',
                    'value' => '$data->tel_parent',
                    'htmlOptions' => array('class'=>'text-center'),
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                    'filter' => CHtml::activeTextField($model, 'tel_parent', array('class' => 'form-control')),
                ),
                array(
                    'header' => 'Выкуплена',
                    'name' => 'paid',
                    'type' => 'raw',
                    'value' => 'CHtml::checkBox("paid",$data->paid,array("data-zid"=>$data->id))',
                    'htmlOptions' => array('class'=>'text-center'),
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                    'filter' => array('НЕТ','ДА'),
                ),

                array(
                    'header' => 'Номер брони',
                    'name' => 'booking_id',
                    'value' => '$data->booking_id',
                    'value' => '$data->booking_id',
                    'value' => '$data->booking_id',
                    'htmlOptions' => array('class'=>'text-center'),
                    'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                    'filter' => CHtml::activeTextField($model, 'booking_id', array('class' => 'form-control')),
                ),

            ),
        ));
        ?>
    </div>
</div>
