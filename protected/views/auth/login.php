<div id="z_page_auth" class="row">
    <div class="col">
        <h3 class="mb-2">Электронная заявка на&nbsp;бронирование путевки в&nbsp;детский лагерь отдыха.</h3>
        <p>Чтобы заполнить электронную форму заявки для бронирования путевки в&nbsp;детский лагерь отдыха в&nbsp;период летней кампании 2021&nbsp;года, нажмите кнопку &laquo;Подать заявку&raquo;. После подачи заявки, автоматически будет сформирован &laquo;Личный кабинет&raquo;.</p>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/addstatement'); ?>" class="btn btn-block btn-success mb-2 mx-auto mw-50 w-50">Подать заявку</a>
        <p>Для уточнения текущего статуса поданных заявок, отказа от&nbsp;них, подачи новых заявок на&nbsp;бронирование, пожалуйста, пройдите авторизацию и&nbsp;перейдите в &laquo;Личный кабинет&raquo;.</p>
        <div class="card mw-50 w-50 mx-auto mb-2">
            <h5 class="card-header">Авторизация в личный кабинет</h5>
            <div class="card-body">
                <form id="z_auth_form" class="needs-validation" method="post">
                    <div class="form-group">
                        <label for="z_auth_user_fio" class="col-form-label">ФИО родителя:</label>
                        <?php echo CHtml::activeTextField($model, 'username', array('placeholder' => 'Введите ФИО', 'class' => 'form-control', 'required'=>'required', 'id'=>'z_auth_user_fio', 'data-mask'=>' абвгдеёжзийклмнопрстуфхцчшщъыьэюя-')); ?>
                        <div class="invalid-feedback">Укажите ФИО подавшего заявку</div>
                    </div>
                    <div class="form-group">
                        <label for="z_auth_user_phone" class="col-form-label">Телефон родителя:</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+7</div>
                            </div>
                            <?php echo CHtml::activeTextField($model, 'password', array('placeholder' => 'Введите телефон', 'class' => 'form-control', 'required'=>'required', 'id'=>'z_auth_user_phone', 'maxlength'=>15, 'data-mask'=>'0123456789')); ?>
                            <div class="invalid-feedback">Укажите телефон подавшего заявку (Например: (905) 123-45-67)</div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button id="z_auth_sign" type="submit" class="btn btn-block btn-primary">Вход</button>
                    </div>
                    <div id="z_auth_user_error" class="mt-2 mb-0 alert alert-danger alert-dismissible <?php echo ($model->errors_arr?'':'d-none'); ?>" role="alert" data-dismiss="alert"><?php if ($model->errors_arr) echo $model->errors_str; ?></div>
                </form>
            </div>
        </div>

    </div>
</div>
