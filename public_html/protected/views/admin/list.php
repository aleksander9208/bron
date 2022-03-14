<div id="z_page_admin_camp" class="container-fluid">
    <div class="row">
        <div class="col">
            <h3><?php echo CHtml::encode($title); ?></h3>
            <div id="z_page_admin_camp_alert" class="alert <?php echo (Yii::app()->user->hasFlash('r_error')?'alert-danger':(Yii::app()->user->hasFlash('r_done')?'alert-success':'')); ?>" role="alert">
                <?php echo (Yii::app()->user->hasFlash('r_error')?Yii::app()->user->getFlash('r_error'):''); ?>
                <?php echo (Yii::app()->user->hasFlash('r_done')?Yii::app()->user->getFlash('r_done'):''); ?>
            </div>

            <label for="z_anketa_reserv_table">Сводная таблица лагерей и смен для резервирования в них мест</label>
            <table id="z_anketa_reserv_table" class="table table-bordered table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Имя</th>
                        <th scope="col" class="text-center">Кодовое слово</th>
                        <th scope="col" class="text-center">Роль в системе</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $userList = (new User)->getListUser();

                    foreach ($userList as $user) {
                    ?>
                        <tr>
                            <td><?= $user['login'] ?></td>
                            <td><?= $user['code'] ?></td>
                            <td><?= $user['role'] ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
</div>
