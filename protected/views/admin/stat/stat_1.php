<?php
$this->widget('MyGridView', array(
    'id' => 'vacr-grid',
    'dataProvider' => $model->getBidList('/admin/stat', true),
    'ajaxUpdate' => 'vacr-grid',// false,
    'ajaxUrl' => Yii::app()->createUrl('/admin/stat'),
    'afterAjaxUpdate' => "function()  { jQuery.datepicker.regional['ru'].dateFormat='yy-mm-dd'; jQuery('#from_date').datepicker(jQuery.datepicker.regional['ru'],{'dateFormat':'yy-mm-dd','changeMonth':true, 'changeYear':true,'yearRange':'2000:2019'}); jQuery('#to_date').datepicker(jQuery.datepicker.regional['ru'],{'dateFormat':'yy-mm-dd','changeMonth':true, 'changeYear':true,'yearRange':'2000:2019'});  }",
    'summaryText' => '',
    'filter' => $model,
    'enableHistory' => false,
    'pagerCssClass' => 'pagination',

    'htmlOptions' => array('class' => 'table table-hover'),
//'headerHtmlOptions' => array('class' => 'thead-light'),
    'itemsCssClass' => 'table table-bordered table-striped table-hover table-sm',
    'ajaxUrl' => Yii::app()->createUrl('/admin/stat'),
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
            'filter' => CHtml::activeTextField($model, 'id', array('class' => 'form-control')),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'Лагерь',
            'name' => 'camp_id',
            'type' => 'raw',
            'value' => 'Questionnaire::getCAMPName($data->camp_id)',
            'filter' => Questionnaire::getCAMPName(),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'Смена',
            'name' => 'shift_name',
            'type' => 'raw',
            'value' => 'Questionnaire::getShiftName($data->shift_id)',
            'filter' => array(1 => 'Смена 1', 2 => 'Смена 2', 3 => 'Смена 3', 4 => 'Смена 4', 5 => 'Смена 5'),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'Дата подачи',
            'name' => 'created',
            'value' => '$data->created',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'fromDate',
                    'options' => array('firstDay' => 6, 'dateFormat' => 'yy-mm-dd', 'language' => 'ru'), //, 'changeMonth' => true, 'changeYear' => true, 'yearRange' => '2013:2099'
                    'language' => 'ru',
                    'htmlOptions' => array('placeHolder' => 'С:', 'id' => 'from_date', 'readonly' => 'readonly', "class" => "input-medium"),
                ), true) . ' ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'toDate',
                    'options' => array('firstDay' => 6, 'dateFormat' => 'yy-mm-dd', 'language' => 'ru'), //, 'changeMonth' => true, 'changeYear' => true, 'yearRange' => '2013:2099'
                    'language' => 'ru',
                    'htmlOptions' => array('placeHolder' => 'По:', 'id' => 'to_date', 'readonly' => 'readonly', "class" => "input-medium"),
                ), true),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'ФИО ребенка',
            'name' => 'fio_child',
            'type' => 'raw',
            'value' => 'CHtml::link($data->fio_child,"/admin/bid/".$data->id)',
            'filter' => CHtml::activeTextField($model, 'fio_child', array('class' => 'form-control')),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'Тип',
            'name' => 'type',
            'value' => 'Questionnaire::getTypeName($data->type)',
            'filter' => Questionnaire::getTypeName(),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),

        array(
            'header' => 'Статус',
            'name' => 'status',
            'type' => 'raw',
            'value' => 'Questionnaire::getSatusName($data->status)',
            'filter' => Questionnaire::getSatusName(),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),

        array(
            'header' => 'ФИО представителя',
            'name' => 'fio_ur_contact',
            'value' => '$data->fio_ur_contact',
            'filter' => CHtml::activeTextField($model, 'fio_ur_contact', array('class' => 'form-control')),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'ФИО Родителя',
            'name' => 'fio_parent',
            'value' => '$data->fio_parent',
            'filter' => CHtml::activeTextField($model, 'fio_parent', array('class' => 'form-control')),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'Телефон родителя',
            'name' => 'tel_parent',
            'value' => '$data->tel_parent',
            'filter' => CHtml::activeTextField($model, 'tel_parent', array('class' => 'form-control')),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'Выкуплена',
            'name' => 'paid',
            'type' => 'raw',
            'value' => '$data->paid?"ДА":"НЕТ"',
            'filter' => array('НЕТ', 'ДА'),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'Комментарий',
            'name' => 'paid',
            'value' => '$data->comment',
            'filter' => CHtml::activeTextField($model, 'comment', array('class' => 'form-control')),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
        array(
            'header' => 'Номер брони',
            'name' => 'booking_id',
            'value' => '$data->booking_id',
            'filter' => CHtml::activeTextField($model, 'booking_id', array('class' => 'form-control')),
            'htmlOptions' => array('class' => 'num_string'),
            'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
        ),
    ),
));

?>