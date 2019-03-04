<div id="z_page_anketa_admin_list" class="container-fluid">
    <div class="row">
        <div class="col">
            <h3><?php echo $title; ?></h3>
            <div id="z_page_anketa_admin_list_alert" class="alert alert-danger d-none" role="alert"></div>

            <div class="text-right">
                <button class="btn btn-info btn-sm my-1 z_btn_print" role="button" data-target="#z_anketa_admin_list_table">Печать таблицы</button>
            </div>

            <?php
            $this->widget('MyGridView', array(
                'id' => 'z_anketa_admin_list_table',
                'dataProvider' => $model->getBidList('/admin/index'),
                'ajaxUpdate' =>  'z_anketa_admin_list_table', //false
                'afterAjaxUpdate' => "function()  { $('#z_anketa_admin_list_table').find('.filters input, .filters select').addClass('form-control form-control-sm'); window.z.comment_edit(); jQuery.datepicker.regional['ru'].dateFormat='dd-mm-yy'; jQuery('#from_date').datepicker(jQuery.datepicker.regional['ru'],{'dateFormat':'dd-mm-yy','changeMonth':true, 'changeYear':true,'yearRange':'2000:2019'}); jQuery('#to_date').datepicker(jQuery.datepicker.regional['ru'],{'dateFormat':'dd-mm-yy','changeMonth':true, 'changeYear':true,'yearRange':'2000:2019'});  }",
                'summaryText' => '',
                'filter' => $model,
                'enableHistory' => false,
                'pagerCssClass' => 'pagination',
                'htmlOptions' => array('class' => ''),
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
                        'value' => '$data->id',
                        'htmlOptions' => array('class' => 'font-weight-bold text-center', 'scope' => 'row'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                        'filter' => CHtml::activeTextField($model, 'id', array('class' => 'form-control'))
                    ),
                    array(
                        'header' => 'Лагерь',
                        'name' => 'camp_id',
                        'type' => 'raw',
                        'value' => 'Questionnaire::getCAMPName($data->camp_id)',
                        'filter' => Questionnaire::getCAMPName(),
                        'htmlOptions' => array('class' => 'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                    ),
                    array(
                        'header' => 'Смена',
                        'name' => 'shift_name',
                        'type' => 'raw',
                        'value' => 'Questionnaire::getShiftName($data->shift_id)."<br/>".SiteService::templateDloRange($data->shift_id)',
                        'filter' => array(1 => 'Смена 1', 2 => 'Смена 2', 3 => 'Смена 3', 4 => 'Смена 4', 5 => 'Смена 5'),
                        'htmlOptions' => array('class' => 'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center', 'scope' => 'col'),
                    ),
                    array(
                        'header' => 'Дата подачи',
                        'name' => 'created',
                        'value' => 'date("H:i:s d-m-Y", strtotime($data->created))',
                        'htmlOptions' => array('class'=>'text-center', 'scope' => 'row'),
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'fromDate',
                                'options' => array('firstDay' => 6, 'dateFormat' => 'dd-mm-yy', 'language' => 'ru'), //, 'changeMonth' => true, 'changeYear' => true, 'yearRange' => '2013:2099'
                                'language' => 'ru',
                                'htmlOptions' => array('placeHolder' => 'С:', 'id' => 'from_date', 'readonly' => 'readonly', "class" => "input-medium"),
                            ), true) . ' ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'toDate',
                                'options' => array('firstDay' => 6, 'dateFormat' => 'dd-mm-yy', 'language' => 'ru'), //, 'changeMonth' => true, 'changeYear' => true, 'yearRange' => '2013:2099'
                                'language' => 'ru',
                                'htmlOptions' => array('placeHolder' => 'По:', 'id' => 'to_date', 'readonly' => 'readonly', "class" => "input-medium"),
                            ), true),
                        'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col')
                    ),
                    array(
                        'header' => 'ФИО ребенка',
                        'name' => 'fio_child',
                        'type' => 'raw',
                        'value' => '$data->fio_child',
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
                        'header' => 'Название юр. лица',
                        'name' => 'name_ur',
                        'value' => '$data->name_ur',
                        'htmlOptions' => array('class'=>'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                        'filter' => CHtml::activeTextField($model, 'name_ur', array('class' => 'form-control')),
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
                        'htmlOptions' => array('class'=>'text-center z_snippet'),
                        'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                        'filter' => array('НЕТ','ДА'),
                    ),
                    array(
                        'header' => 'Резервирован',
                        'name' => 'is_main',
                        'type' => 'raw',
                        'value' => 'CHtml::checkBox("is_main",$data->is_main,array("data-zbid"=>$data->id))',
                        'htmlOptions' => array('class'=>'text-center z_snippet'),
                        'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                        'filter' => array('НЕТ','ДА'),
                    ),
                    array(
                        'header' => 'Номер брони',
                        'name' => 'booking_id',
                        'type' => 'raw',
                        'value' => '"<div data-banketa-id=\"".$data->id."\"></div>".($data->booking_id?$data->booking_id:"")',
                        'htmlOptions' => array('class'=>'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                        'filter' => CHtml::activeTextField($model, 'booking_id', array('class' => 'form-control')),
                    ),
                    array(
                        'header' => 'Резерв',
                        'name' => 'is_reserve',
                        'value' => '((is_numeric($data->is_reserve))?(empty($data->is_reserve)?"ДА":"НЕТ"):"")',
                        'htmlOptions' => array('class'=>'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                        'filter' => array('НЕТ','ДА'),
                    ),
                    array(
                        'header' => 'Комментарий',
                        'name' => 'comment',
                        'type' => 'raw',
                        'value' => '"<div data-canketa-id=\"".$data->id."\"></div>".$data->comment',
                        'htmlOptions' => array('class'=>'text-center'),
                        'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                        'filter' => CHtml::activeTextField($model, 'comment', array('class' => 'form-control')),
                    ),
                    array(
                        'header' => 'Статус',
                        'name' => 'status',
                        'type' => 'raw',
                        'value' => 'CHtml::link(Questionnaire::getStatusName($data->status),"/admin/bid/".$data->id, array("class"=>"btn btn-success btn-sm") )',
                        'htmlOptions' => array('class'=>'text-center'),
                        'filter' => Questionnaire::getStatusName(),
                        'headerHtmlOptions' => array('class' => 'text-center','scope'=>'col'),
                    )
                ),
            ));
            ?>
        </div>
    </div>
</div>
