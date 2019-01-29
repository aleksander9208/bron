"use strict";

if (typeof window.fb == 'object')
    window.fb.modules.ajax =
        {
            //Название модуля
            name:'fb_ajax',
            //Версия библиотеки
            version: '190114',
            //Приоритет загрузки
            indent: 1,
            //Указатель на глобалный объект
            fb: null,
            //Кол-во процессов
            process: 0,
            //Инициализация модуля
            inited: false,
            //Указатели на запрос
            ajax_handle:
                {
                },

            //Инициализация
            init: function (fb, task_name)
                {
                    var _self = this;
                    var result_out = {
                        errors: [],
                        data: {}
                    };
                    _self.fb = fb;
                    _self.fb.info[_self.name] = _self.version;
                    _self.inited = true;
                    _self.fb.tasks.call(task_name, result_out);
                },

            //Теневой  HTTP запрос
            ajax: function ( params, task_name, task_name_get )
                {
                    var _self = this;
                    if (typeof task_name_get == 'undefined')
                        task_name_get = '';
                    return $.ajax(
                        $.extend(
                            true,
                            {
                                url: _self.fb.path+'ajax',
                                data: {},
                                dataType: 'json',
                                type: 'POST',
                                xhrFields:
                                    {
                                        withCredentials: true
                                    },
                                success: function ( data, textStatus, jqXHR )
                                    {
                                        _self.fb.tasks.call(
                                            jqXHR.task_name,
                                            {
                                                errors: (data != null && typeof data.errors !== 'undefined'?data.errors:[]),
                                                data: (data != null && typeof data.data != 'undefined'?data.data:(data != null?data:{}))
                                            }
                                        );
                                    },
                                error: function ( jqXHR, textStatus, errorThrown  )
                                    {
                                        if (textStatus!='abort')
                                            _self.fb.tasks.call(
                                                jqXHR.task_name, {
                                                    errors: [((textStatus=='error' && jqXHR.status == 0)?'Нет связи с сервером':(_self.name+': '+jqXHR.status+' '+textStatus+' ('+errorThrown+')'))],
                                                    data: {}
                                                }
                                            );
                                    },
                                beforeSend: function( jqXHR, settings )
                                    {

                                        jqXHR.task_name_get = task_name_get;
                                        jqXHR.task_name = task_name;
                                        _self.process++;
                                        if (_self.process==1)
                                            _self.fb.fired_event(_self.name+'_active', { process: _self.process });
                                        _self.fb.fired_event(_self.name+'_change', { process: _self.process, active: true, task_name_get:jqXHR.task_name_get });
                                    },
                                complete: function( jqXHR, textStatus )
                                    {
                                        _self.process--;
                                        _self.fb.fired_event(_self.name+'_change', { process: _self.process, active: false, task_name_get:jqXHR.task_name_get });
                                        if (_self.process==0)
                                            _self.fb.fired_event(_self.name+'_noactive', { process: _self.process });
                                    }
                            },
                            params
                        )
                    );
                },

            //Обертка контроллер конкретных запросов
            get: function (action, params, task_name, subdata)
                {
                    var _self = this;
                    var result_out =
                        {
                            errors: [],
                            data: {}
                        };

                    if (typeof _self.ajax_handle[action]!='undefined' && _self.ajax_handle[action]!=null)
                        {
                            _self.ajax_handle[action].abort();
                            _self.ajax_handle[action] = null;
                        }
                    _self.ajax_handle[action] = _self.ajax(
                        params,
                        _self.fb.tasks.add(
                            'Ajax запрос "'+action+'"',
                            task_name,
                            function (result, data)
                                {
                                    if (result.errors.length > 0)
                                        result_out = _self.fb.result_merge(result_out, result);
                                    result_out.data = result.data;
                                },
                            subdata
                        ),
                        task_name
                    );
                    _self.fb.tasks.call(task_name, result_out);
                    return _self.ajax_handle[action];
                },

            //Отмена всех активных запросов
            abort_all: function ()
                {
                    var _self = this;
                    for(var action in _self.ajax_handle)
                        if (_self.ajax_handle[action]!=null)
                            {
                                _self.ajax_handle[action].abort();
                                _self.ajax_handle[action] = null;
                            }
                }
        };