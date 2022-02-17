"use strict";

if (typeof window.z == 'object')
    window.z.page =
        {
            //Название модуля
            name:'z_page_admin_reserv',
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
                                _self.blur_input(this);
                            }
                    );

                    $('[data-toggle="tooltip"]').tooltip();

                    _self.z.tasks.call(task_name, result_out);
                },

            //Потеря фокуса
            blur_input: function (el_input)
                {
                    var _self = this;
                    el_input = $(el_input);
                    var val = el_input.val();
                    var val_int = (val|0);
                    var val_max = (el_input.attr('data-max')|0);
                    if (val_int>val_max)
                        val_int = val_max;
                    else if (val_int<0)
                        val_int = 0;
                    if (val != (val_int).toString())
                        el_input.val(val_int);
                }
        };