"use strict";

if (typeof window.z == 'object')
    window.z.page =
        {
            //Название модуля
            name:'z_page_auth',
            //Версия библиотеки
            version: '190320',
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

                $(document).on(
                    'submit.'+_self.name,
                    '#z_auth_form',
                    function (event)
                    {
                        _self.validate(event);
                    }
                ).on(
                    'change.'+_self.name,
                    '#z_auth_user_fio',
                    function ()
                    {
                        _self.validate_fio();
                    }
                ).on(
                    'change.'+_self.name,
                    '#z_auth_user_phone',
                    function ()
                    {
                        _self.validate_phone();
                    }
                ).on(
                    'keypress.'+_self.name,
                    '#z_auth_user_fio',
                    function (event)
                    {

                        var char_one = (event.which || event.keyCode);
                        var val_mask = ($(this).data('mask')).toUpperCase();
                        var val_key = String.fromCharCode(char_one).toUpperCase();
                        var val_eng_abc = 'abcdefghijklmnopqrstuvwxyz'.toUpperCase();
                        if (
                            val_mask.indexOf(val_key)==-1 &&
                            val_eng_abc.indexOf(val_key)!=-1
                        )
                            $(this).popover(
                                {
                                    container: 'body',
                                    content: 'Переключитесь на русский язык',
                                    placement: 'bottom'
                                }
                            ).popover('show');
                        else
                            $(this).popover('hide');
                    }
                ).on(
                    'blur.'+_self.name,
                    '#z_auth_user_fio',
                    function (event)
                    {
                        $(this).popover('hide');
                    }
                );

                $(_self.z.el.z_auth_user_phone).mask('(999) 999-99-99');

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
            },

            //Валидация поля ввода ФИО
            validate_fio: function ()
            {
                var _self = this;
                _self.error('');
                var val_fio = $.trim(_self.z.el.z_auth_user_fio.val().toLowerCase());
                var is_valid = (val_fio!='');
                if (is_valid==true)
                {
                    var part_val = val_fio.split(' ');
                    var part_no_epty = 0;
                    for(var key in part_val)
                        if ($.trim(part_val[key])!='')
                            part_no_epty++;
                    is_valid = (part_no_epty>=3);
                }
                if (is_valid==true)
                {
                    var val_mask = _self.z.el.z_auth_user_fio.attr('data-mask');
                    var val_len = val_fio.length;
                    for (var i=0; i<val_len; i++)
                    {
                        if (val_mask.indexOf(val_fio[i])==-1)
                        {
                            is_valid = false;
                            break;
                        }
                    }

                }
                _self.z.el.z_auth_user_fio.toggleClass('is-valid', is_valid==true).toggleClass('is-invalid', is_valid==false);
                return _self.z.el.z_auth_user_fio.hasClass('is-valid');
            },

            //Валидация поля ввода телефона
            validate_phone: function ()
            {
                var _self = this;
                _self.error('');
                var val_phone = _self.z.el.z_auth_user_phone.val().toLowerCase();
                var is_valid = (val_phone.length==(_self.z.el.z_auth_user_phone.attr('maxlength')));
                if (is_valid==true)
                {
                    val_phone = val_phone.split('-').join('').split(' ').join('').split('(').join('').split(')').join('');
                    var val_mask = _self.z.el.z_auth_user_phone.attr('data-mask');
                    var val_len = val_phone.length;
                    for (var i=0; i<val_len; i++)
                        if (val_mask.indexOf(val_phone[i])==-1)
                        {
                            is_valid = false;
                            break;
                        }
                }

                _self.z.el.z_auth_user_phone.toggleClass('is-valid', is_valid==true).toggleClass('is-invalid', is_valid!=true);
                return _self.z.el.z_auth_user_phone.hasClass('is-valid');
            },

            //Валидация формы
            validate: function (event)
            {
                var _self = this;
                _self.validate_fio();
                _self.validate_phone();
                var is_valid = (_self.z.el.z_auth_form.find('.is-invalid').length==0);
                _self.z.el.z_auth_form.toggleClass('needs-validation', is_valid==false).toggleClass('was-validated', is_valid==true);
                if (is_valid==false)
                {
                    event.preventDefault();
                    event.stopPropagation();
                }
            }
        };