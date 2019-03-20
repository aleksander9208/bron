"use strict";

if (typeof window.z == 'object')
    window.z.page =
        {
            //Название модуля
            name:'z_page_anketa_view',
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
                        [
                            'change.'+_self.name,
                            'focusout.'+_self.name
                        ].join(' '),
                        [
                            '#z_anketa_fio_parent',
                            '#z_anketa_fio_ur_contact',
                            '#z_anketa_fio_child',

                            '#z_anketa_residence',
                            '#z_anketa_place_of_work',
                            '#z_anketa_name_ur',
                            '#z_anketa_birthday_child',
                            '#z_anketa_place_of_study',

                            '#z_anketa_tel_ur_contact',
                            '#z_anketa_tel_parent',

                            '#z_anketa_email_parent',
                            '#z_anketa_email_ur_contact'

                        ].join(),
                        function ()
                            {
                                switch($(this).attr('id'))
                                    {
                                        case 'z_anketa_fio_parent':
                                        case 'z_anketa_fio_ur_contact':
                                        case 'z_anketa_fio_child':
                                            _self.validate_fio($(this));
                                        break;

                                        case 'z_anketa_residence':
                                        case 'z_anketa_place_of_work':
                                        case 'z_anketa_name_ur':
                                        case 'z_anketa_place_of_study':
                                            _self.validate_required($(this));
                                        break;

                                        case 'z_anketa_birthday_child':
                                            _self.validate_date($(this));
                                        break;

                                        case 'z_anketa_tel_ur_contact':
                                        case 'z_anketa_tel_parent':
                                            _self.validate_phone($(this));
                                        break;

                                        case 'z_anketa_email_parent':
                                        case 'z_anketa_email_ur_contact':
                                            _self.validate_email($(this));
                                        break;
                                    }
                            }
                    ).on(
                        'submit.'+_self.name,
                        '#z_anketa_view_form',
                        function (event)
                            {
                                _self.validate(event);
                            }
                    ).on(
                        'keypress.'+_self.name,
                        [
                            '#z_anketa_fio_ur_contact',
                            '#z_anketa_fio_child',
                            '#z_anketa_fio_parent'
                        ].join(),
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
                        [
                            '#z_anketa_fio_ur_contact',
                            '#z_anketa_fio_child',
                            '#z_anketa_fio_parent'
                        ].join(),
                        function (event)
                            {
                                $(this).popover('hide');
                            }
                    );

                    if (typeof _self.z.el.z_anketa_tel_ur_contact == 'object')
                        $(_self.z.el.z_anketa_tel_ur_contact).mask('(999) 999-99-99');
                    if (typeof _self.z.el.z_anketa_tel_parent == 'object')
                        $(_self.z.el.z_anketa_tel_parent).mask('(999) 999-99-99');

                    _self.z.tasks.call(task_name, result_out);
                },

            //Валидация формы
            validate: function (event)
                {
                    var _self = this;

                    //Юр
                    if (typeof _self.z.el.z_anketa_name_ur == 'object')
                        _self.validate_required(_self.z.el.z_anketa_name_ur);
                    if (typeof _self.z.el.z_anketa_fio_ur_contact == 'object')
                        _self.validate_fio(_self.z.el.z_anketa_fio_ur_contact);
                    if (typeof _self.z.el.z_anketa_tel_ur_contact == 'object')
                        _self.validate_phone(_self.z.el.z_anketa_tel_ur_contact);
                    if (typeof _self.z.el.z_anketa_email_ur_contact == 'object')
                        _self.validate_email(_self.z.el.z_anketa_email_ur_contact);

                    //Физ
                    if (typeof _self.z.el.z_anketa_fio_parent == 'object')
                        _self.validate_fio(_self.z.el.z_anketa_fio_parent);
                    if (typeof _self.z.el.z_anketa_residence == 'object')
                        _self.validate_required(_self.z.el.z_anketa_residence);
                    if (typeof _self.z.el.z_anketa_place_of_work == 'object')
                        _self.validate_required(_self.z.el.z_anketa_place_of_work);
                    if (typeof _self.z.el.z_anketa_email_parent == 'object')
                        _self.validate_email(_self.z.el.z_anketa_email_parent);

                    if (typeof _self.z.el.z_anketa_fio_child == 'object')
                        _self.validate_fio(_self.z.el.z_anketa_fio_child);
                    if (typeof _self.z.el.z_anketa_birthday_child == 'object')
                        _self.validate_date(_self.z.el.z_anketa_birthday_child);
                    if (typeof _self.z.el.z_anketa_place_of_study == 'object')
                        _self.validate_required(_self.z.el.z_anketa_place_of_study);
                    if (typeof _self.z.el.z_anketa_tel_parent == 'object')
                        _self.validate_phone(_self.z.el.z_anketa_tel_parent);

                    var is_valid = (_self.z.el.z_anketa_view_form.find('.is-invalid').length==0);
                    _self.z.el.z_anketa_view_form.toggleClass('needs-validation', is_valid==false).toggleClass('was-validated', is_valid==true);
                    if (is_valid==false)
                        {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                },

            //Валидация ФИО
            validate_fio: function (el_fio)
                {
                    var _self = this;
                    var val_fio = $.trim(el_fio.val().toLowerCase());
                    var is_valid = _self.validate_required(el_fio);
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
                            var val_mask = el_fio.attr('data-mask');
                            var val_len = val_fio.length;
                            for (var i=0; i<val_len; i++)
                                if (val_mask.indexOf(val_fio[i])==-1)
                                {
                                    is_valid = false;
                                    break;
                                }
                        }
                    el_fio.toggleClass('is-valid', is_valid==true).toggleClass('is-invalid', is_valid==false);
                    return is_valid;
                },

            //Валидация на пустоту
            validate_required: function (el_required)
                {
                    var _self = this;
                    var val_required = el_required.val();
                    var is_valid = (val_required!='');
                    el_required.toggleClass('is-valid', is_valid==true).toggleClass('is-invalid', is_valid==false);
                    return is_valid;
                },

            //Валидация телефона
            validate_phone: function (el_phone)
                {
                    var _self = this;

                    var val_phone = el_phone.val().toLowerCase();
                    var is_valid = (val_phone.length==(el_phone.attr('maxlength')));
                    if (is_valid==true)
                        {
                            val_phone = val_phone.split('-').join('').split(' ').join('').split('(').join('').split(')').join('');
                            var val_mask = el_phone.attr('data-mask');
                            var val_len = val_phone.length;
                            for (var i=0; i<val_len; i++)
                                if (val_mask.indexOf(val_phone[i])==-1)
                                    {
                                        is_valid = false;
                                        break;
                                    }
                        }

                    el_phone.toggleClass('is-valid', is_valid==true).toggleClass('is-invalid', is_valid!=true);
                    return is_valid;
                },

            //Валидация ящика
            validate_email: function (el_email)
                {
                    var _self = this;

                    var is_valid = _self.validate_required(el_email);
                    if (is_valid==true)
                        {
                            var val_email = el_email.val().toLowerCase();
                            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                            is_valid = re.test(String(val_email).toLowerCase());
                        }
                    el_email.toggleClass('is-valid', is_valid==true).toggleClass('is-invalid', is_valid!=true);
                    return is_valid;
                },

            //Валидация даты
            validate_date:function (el_date)
                {
                    var _self = this;

                    var val_date = el_date.val().toLowerCase().split('-').reverse().join('-');
                    var val_len = val_date.length;
                    var is_valid = (val_len==(el_date.attr('maxlength')));
                    if (is_valid==true)
                        {
                            var val_date_parts = val_date.split('-');
                            var is_valid = (val_date_parts.length==3);
                            if (is_valid==true)
                                {
                                    var val_mask = el_date.attr('data-mask');
                                    for (var i=0; i<val_len; i++)
                                        if (val_mask.indexOf(val_date[i])==-1)
                                        {
                                            is_valid = false;
                                            break;
                                        }
                                }
                            if (is_valid==true)
                                {
                                    var date_now = new Date();
                                    var date_val = new Date(val_date);
                                    var data_dif = date_now.getFullYear()-date_val.getFullYear();
                                    is_valid = (data_dif<=18 && data_dif>=6);
                                }
                        }
                    el_date.toggleClass('is-valid', is_valid==true).toggleClass('is-invalid', is_valid==false);
                    return is_valid;
                }
        };