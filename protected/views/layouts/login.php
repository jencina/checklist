<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" rel="stylesheet">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <![endif]-->
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top: 15px">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center">
                    <!-- <strong class="">Iniciar Sesion</strong>-->
                    <img  style="width: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"  />
                </div>
                <div class="panel-body">
                    <?php echo $content; ?>
                </div>
                <div class="panel-footer">
                   <!-- Olvido su clave? <a href="#" class="">Recuperar Aqui</a>-->
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>