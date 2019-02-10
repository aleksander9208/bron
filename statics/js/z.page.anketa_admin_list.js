"use strict";

if (typeof window.z == 'object')
    window.z.page =
        {
            //Название модуля
            name:'z_page_anketa_admin_list',
            //Версия библиотеки
            version: '190209',
            //Указатель на глобалный объект
            z: window.z,
            //Хранилище данных
            data: {},

            //Открыте страницы
            init: function (task_name)
                {
                    var _self = this;
                    var result_out =
                        {
                            errors: [],
                            data: {}
                        };

                    $(document).on(
                        'change.'+_self.name,
                        'input[type="checkbox"][data-zid]',
                        function ()
                            {
                                $( '<div class="comment-snipper d-flex justify-content-center align-items-center"><div class="spinner-border" role="status"><span class="sr-only">Обмен данными...</span></div></div>' ).insertBefore(this);
                                _self.z.modules.ajax.get(
                                    'setpaid',
                                    {
                                        url: _self.z.path+'ajax/setpaid',
                                        data: {
                                            questionnaire_id: $(this).attr('data-zid')|0,
                                            paid: ($(this).is(':checked')?1:0)
                                        }
                                    },
                                    _self.z.tasks.add(
                                        'Смена состояния оплаты',
                                        '',
                                        function (result)
                                            {
                                                if (result.errors.length>0)
                                                    _self.z.log(_self.name, 'init_listners', result.errors.join('<br/>'), false);
                                                        else
                                                    $('input[type="checkbox"][data-zid="'+result.data.questionnaire_id+'"]').prop('checked', result.data.paid==1);
                                                $('.comment-snipper').remove();
                                            }
                                    )
                                );
                            }
                    );

                    _self.z.el.z_anketa_admin_list_table.find('.filters input, .filters select').addClass('form-control form-control-sm');
                    _self.z.tasks.call(task_name, result_out);
                }
        };