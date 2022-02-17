<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/z.style.css" type="text/css" media="screen" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body id="fb_wrap">
<?php echo $content; ?>
</body>
</html>