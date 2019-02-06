"use strict";

if (typeof window.z == 'object')
    window.z.page =
        {
            //Название модуля
            name:'z_page_anketa',
            //Версия библиотеки
            version: '190206',
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

                    $("#Questionnaire_type_0").click(function () {
                        $("#ur_block").addClass('d-none');
                    });
                    $("#Questionnaire_type_1").click(function () {
                        $("#ur_block").removeClass('d-none');
                    });

                    _self.z.tasks.call(task_name, result_out);
                },

            //Вывод ошибок
            error: function (text)
                {
                    var _self = this;
                    _self.z.log(_self.name, 'error', text);
                    _self.z.el.z_auth_user_error.html(
                        text+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                        '</button>'
                    ).toggleClass('d-none', text=='');
                }
        };