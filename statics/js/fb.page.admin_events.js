"use strict";

if (typeof window.fb == 'object')
    window.fb.page =
        {
            //Название модуля
            name:'fb_page_admin_events',
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
                        '.fb_btn_add_event:not([disabled])',
                        function (event)
                            {
                                _self.event_add(event);
                            }
                    ).on(
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

            //Получение названия фактора по его номеру
            factor_name_by_num: function ($f_num)
                {
                    var out = '';
                    switch($f_num)
                        {
                            case 921: out = '1'; break;
                            case 922: out = 'X'; break;
                            case 923: out = '2'; break;
                        }
                    return out;
                },

            //Добавление события в коллекцию
            event_add: function (event)
                {
                    var _self       = this;
                    var el_event    = $(event.currentTarget);
                    var id_thead    = el_event.attr('id');
                    var data_json   = el_event.data('event_data');
                    var data        = data_json;// = JSON.parse(data_json);
                    var factors = [];

                    for (var key in data.factors)
                        factors.push(
                            {
                                factor_num: key,
                                factor: _self.factor_name_by_num(key),
                                coef: data.factors[key]
                            }
                        );
                    el_event.attr('disabled', 'disabled');
                    _self.fb.modules.ajax.get(
                        id_thead,
                        {
                            url: _self.fb.path+'/ajax/addshowevent',
                            data: {
                                'start_timestamp': data.time,
                                'sport_caption': data.sport_name,
                                'description_event': (data.name!=''?data.name:(data.team_1+(data.team_2!=''?' - '+data.team_2:''))),
                                'score_team_a': data.score1,
                                'score_team_b': data.score2,
                                'team_name_a': data.team_1,
                                'team_name_b': data.team_2,
                                'coef_array': factors,
                                'number_event': data.id,
                                'num': data.num
                            }
                        },
                        _self.fb.tasks.add(
                            'Добавление события в коллекцию',
                            '',
                            function (result, subdata)
                                {
                                    if (result.errors.length>0)
                                        _self.error(result.errors.join('<br/>'));
                                            else
                                        {
                                            var event_id = $(subdata).addClass('d-none').attr('data-event_id');
                                            $('#fb_btn_remove_event_'+event_id).attr('data-event_id_my', result.data.event_id).removeClass('d-none');
                                        }
                                    $(subdata).removeAttr('disabled');
                                }
                        ),
                        el_event
                    );
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
                            'Удаление события в коллекцию',
                            '',
                            function (result, subdata)
                                {
                                    if (result.errors.length>0)
                                        _self.error(result.errors.join('<br/>'));
                                            else
                                        {
                                            var event_id = $(subdata).addClass('d-none').attr('data-event_id');
                                            $('#fb_btn_add_event_'+event_id).removeClass('d-none');
                                        }
                                    $(subdata).removeAttr('disabled');
                                }
                        ),
                        el_event
                    );
                }
        };