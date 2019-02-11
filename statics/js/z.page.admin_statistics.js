"use strict";

if (typeof window.z == 'object')
    window.z.page =
        {
            //Название модуля
            name:'z_page_admin_statistics',
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
                        '#z_admin_statistics_stat_id',
                        function ()
                            {
                                _self.z.el.z_admin_statistics_form.submit();
                            }
                    ).on(
                        'click.'+_self.name,
                        '#z_page_admin_statistics .z_btn_print',
                        function ()
                            {
                                _self.print_table($(this));
                            }
                    );

                    $('table.table').find('.filters input, .filters select').addClass('form-control form-control-sm');
                    _self.z.tasks.call(task_name, result_out);
                },

            //Печать контента
            print_table: function (el_btn)
                {
                    var _self = this;
                    var print_selector = $(el_btn).attr('data-target');
                    var el_form =  $('<form action="'+_self.z.path+'profile/freeprint" method="post" target="_blank"></form>');
                    var el_input = $('<input type="hidden" name="str" />');
                    el_form.html(el_input);
                    el_input.val($(print_selector).get(0).outerHTML);
                    $('body').append(el_form);
                    el_form.submit();
                    el_form.remove();
                }
        };