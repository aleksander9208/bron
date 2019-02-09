"use strict";

if (typeof window.z == 'object')
    window.z.page =
        {
            //Название модуля
            name:'z_page_admin_reserv',
            //Версия библиотеки
            version: '190208',
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
                        'keypress.'+_self.name,
                        '#z_anketa_reserv_table .form-control',
                        function ()
                            {
                                var val = $(this).val();
                                if (val == '0')
                                    $(this).val('');
                            }
                    ).on(
                        'blur.'+_self.name,
                        '#z_anketa_reserv_table .form-control',
                        function ()
                            {
                                var val = $(this).val();
                                if (val != (val|0).toString())
                                    $(this).val(val|0);
                            }
                    );
                    _self.z.tasks.call(task_name, result_out);
                }
        };