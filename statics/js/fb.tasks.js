"use strict";

if (typeof window.fb == 'object')
    window.fb.tasks =
        {
            //Название модуля
            name:'fb_tasks',
            //Версия библиотеки
            version: '190121',
            //Указатель на родительский объект
            fb: window.fb,
            //Хранилище задачь
            data: {},
            //Номер задачи
            index: 0,

            //Добавление задачи
            add: function (text, parent_task_name, callback_link, subdata)
                {
                    var _self = this;
                    _self.index++;
                    var name = 't'+_self.index;
                    _self.data[name] =
                        {
                            info: text,
                            need: {},
                            callback: callback_link,
                            params: {
                                errors: [],
                                data: {}
                            },
                            wait: false,
                            data: (typeof subdata == 'undefined'?{}:subdata)
                        };
                    if (parent_task_name != '')
                        {
                            if(typeof _self.data[parent_task_name] == 'object')
                                _self.data[parent_task_name].need[name] = name;
                                    else
                                _self.fb.log(_self.name, 'add', 'Нет родительской задачи "'+parent_task_name+'" для задачи "'+name+'"!');
                        };
                    _self.fb.log(_self.name, 'add', 'Создание новой задачи "'+name+'" ('+text+')!');
                    return name;
                },

            //Удаление задачи
            remove: function (name)
                {
                    var _self = this;
                    if (typeof _self.data[name] == 'object')
                        {
                            var params = _self.data[name].params;
                            delete _self.data[name];
                            _self.fb.log(_self.name, 'remove', 'Задача "'+name+'" удалена!', 0);

                            for (var key in _self.data)
                                if (typeof _self.data[key].need[name] != 'undefined')
                                    {
                                        delete _self.data[key].need[name];
                                        //_self.data[key].params = _self.marge(_self.data[key].params, params);
                                        if (_self.data[key].wait == true && Object.keys(_self.data[key].need).length==0)
                                            _self.call(key, {errors:[], data:{}});
                                    }
                        }
                            else
                        _self.log(_self.name, 'remove', 'Удаление несуществующей задачи "'+name+'"!');
                },

            //Отработка задачи, приведение в актуальное состояние системы
            call: function (name, result)
                {
                    var _self = this;
                    var out = null;
                    if (typeof _self.data[name] == 'object')
                        {
                            //_self.data[name].params = $.extend(true, {}, _self.data[name].params, result);
                            _self.data[name].params = _self.marge(_self.data[name].params, result);

                            var link = [];
                            for (var key in _self.data[name].need)
                                if (typeof _self.data[key] == 'object')
                                    link.push(key);
                            if (link.length==0)
                                {
                                    _self.fb.log(_self.name, 'call', 'Задача "'+name+'" выполнена! ('+_self.data[name].info+')');
                                    _self.data[name].callback(_self.data[name].params, _self.data[name].data);
                                    for (var key in _self.data)
                                        if (typeof _self.data[key].need[name] != 'undefined')
                                        {
                                            _self.data[key].data = _self.data[name].data;
                                            _self.data[key].params = _self.marge(_self.data[key].params, _self.data[name].params);
                                        }
                                    _self.remove(name);
                                }
                                    else
                                {
                                    _self.data[name].wait = true;
                                    _self.fb.log(_self.name, 'call', 'Задача "'+name+'" отложена, до отработки задач: '+link.join(', ')+'!');
                                }
                        }
                            else
                        _self.fb.log(_self.name, 'call', 'Вызов несуществующей задачи "'+name+'"!');
                    return out;
                },

            marge: function (data_1, data_2)
                {
                    var errors_count = data_2.errors.length;
                    if (errors_count>0)
                        for(var i=0; i<errors_count; i++)
                            data_1.errors.push(data_2.errors[i]);

                    for (var key in data_2.data)
                        data_1.data[key] = data_2.data[key];
                    return data_1;
                }
        };