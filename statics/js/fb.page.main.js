"use strict";

if (typeof window.fb == 'object')
    window.fb.page =
        {
            //Название модуля
            name:'fb_page_main',
            //Версия библиотеки
            version: '190128',
            //Указатель на глобалный объект
            fb: window.fb,
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
                        'click.'+_self.name,
                        '.fb_btn_bet:not([disabled])',
                        function (event)
                            {
                                _self.bet_mm(event);
                            }
                    ).on(
                        'click.'+_self.name,
                        '#fb_bet_options_accept',
                        function (event)
                            {
                                if (typeof $(this).attr('disabled') == 'undefined')
                                    _self.bet_add(
                                        $(this).attr('data-event_id'),
                                        $(this).attr('data-factor_id'),
                                        _self.fb.el.fb_bet_options_value.val(),
                                        _self.fb.el.fb_bet_options_value.attr('min'),
                                        _self.fb.el.fb_bet_options_value.attr('max')
                                    );
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

            //Добавление ставки
            bet_mm: function (event)
                {
                    var _self = this;
                    var el_event    = $(event.currentTarget);
                    var event_id    = el_event.data('event_id_my');
                    var factor_id   = el_event.data('event_factor_id');

                    var balance_str = _self.fb.el.fb_user_balance.text();
                    var balance_arr = balance_str.split(':');
                    if (balance_arr.length>=2)
                        {
                            var balance = balance_arr[1];
                            if (balance<=0)
                                alert('Недостаточно средств!');
                                    else
                                {
                                    el_event.attr('disabled', 'disabled');
                                    _self.fb.el.fb_preloader.removeClass('d-none');
                                    _self.fb.modules.ajax.get(
                                        'minmax_'+event_id+'_'+factor_id,
                                        {
                                            url: _self.fb.path+'/ajax/getamountrange',
                                            data: {
                                                event: event_id,
                                                factor: factor_id
                                            }
                                        },
                                        _self.fb.tasks.add(
                                            'Мин макс ставки',
                                            '',
                                            function (result, subdata)
                                                {
                                                    if (result.errors.length>0)
                                                        _self.error(result.errors.join('<br/>'));
                                                            else
                                                        {
                                                            var event_key = -1;
                                                            for (var key in data_events)
                                                                if (data_events[key].id == result.data.event_id)
                                                                    event_key = key;
                                                            if (event_key !=-1)
                                                                {
                                                                    var factor_str = '';
                                                                    for (var key in data_events[event_key].factors)
                                                                        if (data_events[event_key].factors[key].factor_num == result.data.factor_id)
                                                                            factor_str = data_events[event_key].factors[key].coef;

                                                                    _self.fb.el.fb_bet_options_accept.attr('data-event_id', result.data.event_id).attr('data-factor_id', result.data.factor_id);
                                                                    _self.fb.el.fb_bet_options_value.attr('min', result.data.min).attr('max', result.data.max).val(result.data.min);
                                                                    _self.fb.el.fb_bet_options_help.text('Значение должно быть в диапазоне от '+result.data.min+' до '+result.data.max+'');
                                                                    _self.fb.el.fb_bet_options_info.html(
                                                                        '<div>'+
                                                                            'Спорт: '+data_events[key].sport_caption+
                                                                        '</div>'+
                                                                        '<div>' +
                                                                            'Команды: <strong>'+data_events[key].team_name_a+' - '+data_events[key].team_name_b+'</strong>' +
                                                                        '</div>'+
                                                                        '<div>'+
                                                                            'Коэффициент: '+
                                                                            factor_str+
                                                                        '</div>'
                                                                    );
                                                                    _self.fb.el.fb_bet_options.modal('show');
                                                                }
                                                                    else
                                                                _self.error('Нет данных по событию');
                                                        }
                                                    $(subdata).removeAttr('disabled');
                                                    _self.fb.el.fb_preloader.addClass('d-none');
                                                }
                                        ),
                                        el_event
                                    );
                                }
                        }
                },

            //Добавление ставки
            bet_add: function (event_id, factor_id, bet_money, bmin, bmex )
                {
                    var _self       = this;
                    var balance_str = _self.fb.el.fb_user_balance.text();
                    var balance_arr = balance_str.split(':');
                    if (balance_arr.length>=2)
                        {
                            var balance = balance_arr[1]|0;
                            bmin = bmin|0;
                            if (balance < bmin)
                                _self.error('Недостаточно средств для выполнения ставки');
                                    else
                                {
                                    _self.fb.el.fb_preloader.removeClass('d-none');
                                    _self.fb.el.fb_bet_options.modal('hide');
                                    _self.fb.modules.ajax.get(
                                        'bet_' + event_id + '_' + factor_id,
                                        {
                                            url: _self.fb.path + '/ajax/addbet',
                                            data: {
                                                event_id: event_id,
                                                factor_id: factor_id,
                                                sum: bet_money
                                            }
                                        },
                                        _self.fb.tasks.add(
                                            'Добавление ставки',
                                            '',
                                            function (result) {
                                                if (result.errors.length > 0)
                                                    _self.error(result.errors.join('<br/>'));
                                                        else
                                                    {
                                                        _self.fb.el.fb_user_balance.text('Баланс: ' + (balance - bet_money));
                                                        alert('Ставка принята!');
                                                    }
                                                _self.fb.el.fb_preloader.addClass('d-none');
                                            }
                                        )
                                    );
                            }
                        }
                            else
                        _self.error('Ошибка получения баланса клиента');
                }
        };