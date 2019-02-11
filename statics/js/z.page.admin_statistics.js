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
                    );

                    $('table.table').find('.filters input, .filters select').addClass('form-control form-control-sm');
                    _self.z.tasks.call(task_name, result_out);
                }
        };