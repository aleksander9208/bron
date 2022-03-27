"use strict";

if (typeof window.z == 'object')
    window.z.page =
        {
            //Название модуля
            name:'z_page_freeprint',
            //Версия библиотеки
            version: '190211',
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

                    $(document);

                    _self.z.el.z_page_freeprint.find('tr.filters').remove();

                    setTimeout(
                        function ()
                            {
                                window.print();
                            },
                        1000
                    );

                    _self.z.tasks.call(task_name, result_out);
                }
        };