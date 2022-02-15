<?php /**/
$errorCode = ((isset($error['code']) ? $error['code'] . ' - ' : '') . 'Страница не найдена');
echo CHtml::image('/statics/images/error.jpg',$errorCode,array('class'=>'mx-auto d-block')); ?>
<h2 class="p404" style="text-align: center;"><?php echo $errorCode; ?></h2>
<?php
if (YII_DEBUG && isset($error)) {
    echo "<div class='error_log' style='font-size: 12px'><pre>";
    print_r($error);
    echo "</pre></div>";
}
?>