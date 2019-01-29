"use strict";

if (typeof window.fb == 'object')
    window.fb.page =
        {
            //Название модуля
            name:'fb_page_auth',
            //Версия библиотеки
            version: '190128',
            //Указатель на глобалный объект
            fb: window.fb,

            //Открыте страницы
            init: function (task_name)
                {
                    var _self = this;
                    var result_out =
                        {
                            errors: [],
                            data: {}
                        };

                    $(document).off(
                        '.'+_self.name
                    );

                    _self.fb.tasks.call(task_name, result_out);
                },

            //Вывод уведомлений
            error: function (message, success)
                {
                    var _self = this;
                    _self.fb.el.fb_alert_error
                        .html(message)
                        .toggleClass('alert-success', success)
                        .toggleClass('alert-danger', !success)
                        .toggleClass('d-none', message=='');
                }
        };