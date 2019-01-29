<div id="fb_page_admin_collection" class="row fb_page">
    <div class="col">
        <h2><?php echo $title; ?></h2>
        <hr />
        <div id="fb_alert_error" class="alert alert-danger alert-dismissible d-none" role="alert" data-dismiss="alert"></div>

        <?php
        if (count($events)>0)
        {
            ?>
        <table id="event_list" class="table table-sm table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Спорт</th>
                    <th scope="col">Название</th>
                    <th scope="col">Комманды</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Действие</th>
                </tr>
            </thead>
            <tbody id="event_list_tr">
                <?php
                    foreach($events as $event)
                        echo '<tr>'.
                            '<th scope="row">'.$event['number_event'].'</th>'.
                            '<td>'.$event['sport_caption'].'</td>'.
                            '<td>'.$event['description_event'].'</td>'.
                            '<td>'.$event['team_name_a'].' - '.$event['team_name_b'].'</td>'.
                            '<td>'.(!is_null($event['win_factors'])?'Окончен':'Активен').'</td>'.
                            '<td><button type="button" class="btn btn-danger btn-sm pt-0 pb-0 fb_btn_remove_event" id="fb_btn_remove_event_'.$event['number_event'].'" data-event_id="'.$event['number_event'].'" data-event_id_my="'.$event['id'].'">Исключить</button></td>'.
                        '</tr>';
                    unset($event);
                ?>
            </tbody>
        </table>
        <?php }
                else
              echo '<div class="alert alert-info" role="alert">Нет событий!</div>';
        ?>

        <?php //print_r($events);?>
    </div>
</div>

