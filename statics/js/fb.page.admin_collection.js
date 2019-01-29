"use strict";

if (typeof window.fb == 'object')
    window.fb.page =
        {
            //Название модуля
            name:'fb_page_admin_collection',
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

                    $(document).on(
                        'click.'+_self.name,
                        '.fb_btn_remove_event:not([disabled])',
                        function (event)
                            {
                                _self.event_remove(event);
                            }
                    );

                    _self.fb.tasks.call(task_name, result_out);
                },

            //Вывод ошибок
            error: function (text)
                {
                    _self.fb.log(_self.name, 'error', text);
                    _self.fb.el.fb_alert_error.html(
                        text+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                        '</button>'
                    ).removeClass('d-none');
                },

            //Исключение события из коллекции
            event_remove: function (event)
                {
                    var _self       = this;
                    var el_event    = $(event.currentTarget);
                    var id_thead    = el_event.attr('id');
                    var event_id_my = el_event.attr('data-event_id_my');

                    el_event.attr('disabled', 'disabled');
                    _self.fb.modules.ajax.get(
                        id_thead,
                        {
                            url: _self.fb.path+'/ajax/dropevent',
                            data: {
                                id: event_id_my
                            }
                        },
                        _self.fb.tasks.add(
                            'Удаление события из коллекции',
                            '',
                            function (result, subdata)
                                {
                                    if (result.errors.length>0)
                                        _self.error(result.errors.join('<br/>'));
                                            else
                                    {
                                        $(subdata).closest('tr').remove();
                                        if(_self.fb.el.event_list_tr.children('tr').length==0)
                                            {
                                                _self.fb.el.event_list.remove();
                                                _self.fb.el.fb_alert_error.text('Нет событий!').attr('class', 'alert alert-info');
                                            }
                                    }
                                    $(subdata).removeAttr('disabled');
                                }
                        ),
                        el_event
                    );
                }
        };