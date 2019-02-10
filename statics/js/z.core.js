"use strict";

window.z =
    {
        //Режим отладки
        debug: true,
        //Название модуля
        name:'z_core',
        //Версия библиотеки
        version: '190210',
        //Поддиректория проекта
        path: '/',
        //Активность системы
        active: true,
        //Инициализация модуля
        inited: false,
        //Хранилище объектов
        el: {},
        //Хранилище модулей
        modules: {},
        //Управление задачами
        tasks: {},
        //Информация о версиях библиотеки
        info: {},
        //Текущая страница
        page: {},
        //Роль пользователя
        role:'guest',
        //Идентификатор пользователя
        user_id: 0,
        //Настройки вывода логов
        log_access:
            {
                'z_tasks.add': false,
                'z_tasks.call': false,
                'z_tasks.remove': false,
                'z_core.event': false
            },

        //Метод инициализации
        init: function ( task_name )
            {
                var _self = this;
                var result_out =
                    {
                        errors: [],
                        data: {}
                    };

                $('[id]').each(
                    function ()
                        {
                            var id = $(this).attr('id');
                            _self.el[id] = $(this);
                        }
                );

                /*
                var path = _self.el.z_wrap.data('path');
                _self.path =  (typeof path == 'undefined'?'/':path);
                var debug = _self.el.z_wrap.data('debug');
                _self.debug = (typeof debug == 'undefined'?false:!!debug);
                */

                _self.modules_init(
                    _self.tasks.add(
                        'Инициализация модулей',
                        task_name,
                        function (result)
                            {
                                if (result.errors.length==0)
                                    {
                                        _self.init_listners();
                                        _self.comment_edit();
                                        if (typeof _self.page.name == 'string')
                                            _self.page.init(
                                                _self.tasks.add(
                                                    'Открытие страницы "'+_self.page.name+'"',
                                                    '',
                                                    function (result)
                                                        {
                                                            if (result.errors.length>0)
                                                                _self.log(_self.name, 'init', 'Открытие страницы "'+_self.page.name+' при переходе: '+result.errors.join("\n"));
                                                        }
                                                )
                                            );
                                        _self.inited = true;
                                    }
                            }
                    )
                );

                _self.tasks.call(task_name, result_out);
            },

        //Добавлеие атрибутов для мех ред комментариев
        comment_edit: function ()
            {
                var _self = this;
                $('[data-anketa-id]').each(
                    function ()
                        {
                            var a_id = $(this).attr('data-anketa-id');
                            $(this).parent().attr('data-comment-id', a_id);
                            $(this).remove();
                        }
                );
            },

        //Инициализация обработчиков событий
        init_listners: function ()
            {
                var _self = this;

                $(document).off(
                    '.'+_self.name
                ).on(
                    'keydown.'+_self.name,
                    function(event) {
                        var keycode = (event.which || event.keyCode);
                        if (event.shiftKey && keycode == 192)
                            {
                                var v_text = [];
                                v_text.push('JQuery: '+jQuery.fn.jquery);
                                v_text.push('Tasks: '+_self.tasks.version);
                                v_text.push('Ядро: '+_self.version);
                                v_text.push('Страница: '+_self.page.name + ' - ' + _self.page.version);

                                var v_modules = [];
                                for (var key in _self.modules)
                                    v_modules.push('         '+key + ': ' + _self.modules[key].version);
                                v_text.push('Модули: '+"\n"+v_modules.join("\n"));

                                alert(v_text.join("\n"));
                            }
                    }
                ).on(
                    'keypress.'+_self.name,
                    'input[data-mask]',
                    function (event)
                        {

                            var char_one = (event.which || event.keyCode);
                            //8,9,13,16,20,37,38,39,40
                            if (([13, 8].indexOf(char_one)!=-1 || ($(this).data('mask')).toUpperCase().indexOf(String.fromCharCode(char_one).toUpperCase())!=-1)==false)
                                event.preventDefault();
                        }
                ).on(
                    [
                        'dragstart.'+_self.name,
                        'drop.'+_self.name
                    ].join(' '),
                    function(event)
                        {
                            event.preventDefault();
                            return false;
                        }
                ).on(
                    'click.'+_self.name,
                    '[data-comment-id]',
                    function ()
                        {
                            if ($(this).children('textarea').length==0)
                                {
                                    var val_anketa_id = $(this).attr('data-comment-id')|0;
                                    var val = $(this).html();
                                    var el_text_area = $('<textarea class="form-control" rows="3"></textarea>');
                                    el_text_area.attr('data-aid', val_anketa_id).val(val);
                                    $(this).html(el_text_area);
                                    el_text_area.focus();
                                }
                        }
                ).on(
                    'blur.'+_self.name,
                    'textarea[data-aid]',
                    function ()
                        {
                            var val = $(this).val();
                            var val_anketa_id = $(this).attr('data-aid')|0;
                            $( '<div class="comment-snipper d-flex justify-content-center align-items-center"><div class="spinner-border" role="status"><span class="sr-only">Обмен данными...</span></div></div>' ).insertBefore(this);

                            _self.modules.ajax.get(
                                'setcomment',
                                {
                                    url: _self.path+'ajax/setcomment',
                                    data: {
                                        questionnaire_id: val_anketa_id,
                                        comment: val
                                    }
                                },
                                _self.tasks.add(
                                    'Добавление комметария',
                                    '',
                                    function (result)
                                        {
                                            if (result.errors.length>0)
                                                {
                                                    _self.log(_self.name, 'init_listners', result.errors.join('<br/>'), false);
                                                    $('.comment-snipper').remove();
                                                }
                                                    else
                                                $('[data-comment-id="'+result.data.questionnaire_id+'"]').html(result.data.comment);
                                        }
                                )
                            );
                        }
                );


                $(window).off(
                    '.'+_self.name
                ).on(
                    'contextmenu.'+_self.name,
                    function(event)
                        {
                            if (_self.debug==false)
                                {
                                    event.preventDefault();
                                    return false;
                                }
                        }
                ).on(
                    'focus.'+_self.name,
                    function (event)
                        {
                            _self.log(_self.name, 'event focus', 'Система активна');
                            _self.active = true;
                        }
                ).on(
                    'blur.'+_self.name,
                    function (event)
                        {
                            _self.log(_self.name, 'event blur', 'Система не активна');
                            _self.active = false;
                        }
                ).on(
                    'resize.'+_self.name,
                    function (event)
                        {
                            _self.log(_self.name, 'event resize', 'Система изменила размеры');
                        }
                );

                if (_self.debug==true)
                    window.onerror = function (errorMsg, url, lineNumber)
                        {
                            alert('Error: ' + errorMsg + ' Script: ' + url + ' Line: ' + lineNumber);
                        };
            },

        //Экранирование значения атрибутов
        quoteattr: function(s)
            {
                return ('' + s)
                    .replace(/&/g, '&amp;')
                    .replace(/'/g, '&apos;')
                    .replace(/"/g, '&quot;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/\r\n/g, '\n')
                    .replace(/[\r\n]/g, '\n');
            },

        //Инициализация модулей
        modules_init: function (task_name)
            {
                var _self = this;
                var result_out =
                    {
                        errors: [],
                        data: {}
                    };

                for (var indent=1; indent<=10; indent++)
                    for(var key in _self.modules)
                        if (_self.modules[key].indent == indent)
                            _self.modules[key].init(
                                _self,
                                _self.tasks.add(
                                    'Инициализация модуля "'+key+'"',
                                    task_name,
                                    function (result)
                                        {
                                        }
                                )
                            );
                _self.tasks.call(task_name, result_out);
            },

        //Объединение результатов
        result_merge: function (result_main, result_sub)
            {
                for(var key in result_sub.errors)
                    result_main.errors.push(result_sub.errors[key]);
                return result_main;
            },

        //Генератор событий
        fired_event: function (name, data)
            {
                var _self = this;
                _self.log(_self.name, 'fired_event', 'Вызов события "z_'+name+'"');
                $(document).trigger(
                    $.Event('z_'+name, data )
                );
            },

        //Вывод сообщений
        log: function (module, method, text)
            {
                var _self = this;
                if (
                    _self.debug == true &&
                    (
                        typeof _self.log_access[module+'.'+method]=='undefined' ||
                        (
                            typeof _self.log_access[module+'.'+method]=='boolean' &&
                            _self.log_access[module+'.'+method] == true
                        )
                    )
                )
                    {
                        var out = module+'.'+method+': '+text;
                        if (typeof window.console != 'undefined')
                            window.console.log(out);
                                else
                            window.alert(out);
                    }
            }
    };