<div id="z_page_auth" class="row">
    <div class="col">
        <h3 class="mb-2">Регистрация заявок на&nbsp;отдых в&nbsp;летних лагерях</h3>
        <p>У&nbsp;нас на&nbsp;сайте можно подать заявки на&nbsp;отдых Ваших детей в&nbsp;летних лагерях на&nbsp;период <b>лета 2019 </b> года.</p>
        <p>Для входа в&nbsp;&laquo;Личный кабинет&raquo;, воспользуйтесь формой авторизации ниже. В&nbsp;&laquo;Личном кабинет&raquo; всегда можно уточнит текущий статус поданных заявок, отказаться от&nbsp;их, либо добавить новые заявки.</p>
        <div class="card mw-50 w-50 mx-auto mb-2">
            <h5 class="card-header">Авторизация в личный кабинет</h5>
            <div class="card-body">
                <form id="z_auth_form" class="needs-validation" method="post">
                    <div class="form-group">
                        <label for="z_auth_user_fio" class="col-form-label">ФИО:</label>
                        <?php echo CHtml::activeTextField($model, 'username', array('placeholder' => 'Введите ФИО', 'class' => 'form-control', 'required'=>'required', 'id'=>'z_auth_user_fio', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-')); ?>
                        <div class="invalid-feedback">Укажите ФИО подавшего заявку</div>
                    </div>
                    <div class="form-group">
                        <label for="z_auth_user_phone" class="col-form-label">Телефон:</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+7</div>
                            </div>
                            <?php echo CHtml::activeTextField($model, 'password', array('placeholder' => 'Введите телефон', 'class' => 'form-control', 'required'=>'required', 'id'=>'z_auth_user_phone', 'maxlength'=>16, 'data-mask'=>'0123456789')); ?>
                            <div class="invalid-feedback">Укажите телефон подавшего заявку (Например: 9051234567)</div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button id="z_auth_sign" type="submit" class="btn btn-block btn-primary">Вход</button>
                    </div>
                    <div id="z_auth_user_error" class="mt-2 mb-0 alert alert-danger alert-dismissible <?php echo ($model->errors_arr?'':'d-none'); ?>" role="alert" data-dismiss="alert"><?php if ($model->errors_arr) echo $model->errors_str; ?></div>
                </form>
            </div>
        </div>
        <p>Если Вы&nbsp;ранее не&nbsp;подавали заявки на&nbsp;отдых в&nbsp;летних лагерях и&nbsp;у&nbsp;Вас нет учетной записи для &laquo;Личного кабинета&raquo;, то&nbsp;перейдите на&nbsp;форму анкеты подачи заявки. После подачи заявки, для Вас будет автоматически сформирована учетная запись.</p>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/addstatement'); ?>" class="btn btn-block btn-success mx-auto mw-50 w-50">Подать заявку</a>
    </div>
</div>