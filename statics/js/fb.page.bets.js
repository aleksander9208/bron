"use strict";

if (typeof window.fb == 'object')
    window.fb.page =
        {
            //Название модуля
            name:'fb_page_bets',
            //Версия библиотеки
            version: '190122',
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

                    _self.fb.tasks.call(task_name, result_out);
                }
        };