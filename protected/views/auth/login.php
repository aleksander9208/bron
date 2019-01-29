<div id="fb_page_auth" class="row justify-content-center fb_page h-100">
    <div class="col-4 align-self-center">
        <div class="card">
            <h5 class="card-header">Авторизация</h5>
            <div class="card-body">
                <form id="fb_auth_form" class="needs-validation" method="post">
                    <div class="form-group">
                        <label for="fb_auth_login" class="col-form-label">Логин:</label>
                        <?php echo CHtml::activeTextField($model, 'username', array('placeholder' => 'Логин', 'class' => 'form-control', 'required'=>'required', 'id'=>'fb_auth_login')); ?>
                    </div>
                    <div class="form-group">
                        <label for="fb_auth_password" class="col-form-label">Пароль:</label>
                        <?php echo CHtml::activePasswordField($model, 'password', array('placeholder' => 'Ваш пароль…', 'class' => 'form-control', 'required'=>'required', 'id'=>'fb_auth_password')); ?>
                    </div>
                    <?php if ($model->errors_arr) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $model->errors_str; ?>
                        </div>
                    <?php } ?>
                    <div class="form-group mb-0">
                        <button id="fb_auth_sign" type="submit" class="btn btn-block btn-primary">Вход</button>
                    </div>
                    <div id="fb_alert_error" class="alert alert-danger alert-dismissible d-none" role="alert" data-dismiss="alert"></div>
                </form>
            </div>
        </div>
    </div>
</div>