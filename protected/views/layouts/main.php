<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
     <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="menu">
    <div class="container">
    <?php
    $usuario = Yii::app()->user->tipo_usuario;

    $logo = '';

    if(!empty(Empresa::model()->findByPk(Yii::app()->user->empresa)->logo)){
       $logo = '<img src="'.Yii::app()->request->baseUrl.'/images/'.Empresa::model()->findByPk(Yii::app()->user->empresa)->logo.'" class="logo"/>';
    }else{
       $logo = '23kyCorp';
    }
    $this->widget(
        'booster.widgets.TbNavbar',
        array(
            'type' => 'inverse',
            'brand' => $logo,
            'brandUrl' => '#',
            'collapse' => true, // requires bootstrap-responsive.css
            'fixed' => false,
            'htmlOptions'=>array('style'=>'margin-bottom:0;'),
            'fluid' => true,
            'items' => array(
                array(
                    'class' => 'booster.widgets.TbMenu',
                    'type' => 'navbar',
                    'items' => array(
                        array('label' => 'Usuarios','icon'=>'fa fa-user', 'url' => array('usuario/admin'),'visible'=>($usuario == 'admin' || $usuario == 'super_admin'),'active' => (Yii::app()->controller->menu_activo == 'usuario')?true:(Yii::app()->controller->id == 'usuario' && Yii::app()->controller->menu_activo == '')?true : false),
                        array('label' => 'Empresa'  ,'icon'=>'fa fa-building', 'url' => array('empresa/admin'),'active' => (Yii::app()->controller->menu_activo == 'empresa')?true:(Yii::app()->controller->id == 'empresa' && Yii::app()->controller->menu_activo == '')?true : false),
                       // array('label' => 'Proyectos' ,'icon'=>'fa fa-folder-open' , 'url' => array('proyecto/admin'),'visible'=>$usuario == 'admin','active' => (Yii::app()->controller->menu_activo == 'proyecto')?true:(Yii::app()->controller->id == 'proyecto' && Yii::app()->controller->menu_activo == '')?true : false),
                        array('label' => 'Dashboard','icon'=>'fa fa-file-text-o' , 'url' => array('dashboard/index'),'visible'=>($usuario == 'admin' || $usuario == 'super_admin'),'active' => (Yii::app()->controller->menu_activo == 'dashboard')?true:(Yii::app()->controller->id == 'dashboard' && Yii::app()->controller->menu_activo == '')?true : false),
                        array('label' => 'Documentos','icon'=>'fa fa-check-square-o', 'url' => array('documento/index'),'visible'=>($usuario == 'admin' && $usuario == 'tecnico')),
                        array('label' => 'Tareas'    ,'icon'=>'fa fa-check-square-o', 'url' => array('tarea/admin'),'visible'=>$usuario == 'admin'),
                        array(
                            'label' => 'Configuraciones',
                            'icon'=>'fa fa-cog',
                            'url' => '#',
                            'items' => array(

                                array('label' => 'Sistema Operativo',  'icon'=>'fa fa-windows', 'url' => array('sistemaOperativo/admin')),
                                array('label' => 'Departamento',   'icon'=>'fa fa-sitemap','url' => array('departamento/admin')),
                                array('label' => 'Monitor',  'icon'=>'fa fa-television-o', 'url' => array('monitor/admin')),
                                array('label' => 'Cpu',  'icon'=>'fa fa-cogs', 'url' => array('cpu/admin')),
                                array('label' => 'Email',  'icon'=>'fa fa-google-plus-square', 'url' => array('email/index')),

                            ),'visible'=>Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre == 'admin'
                        ),
                        array('label'=>'Logout ('.Yii::app()->user->name.')',  'icon'=>'fa fa-power-off', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ),
                ),
            ),
        )
    );

    ?>
        </div>
    </div>

<div class="container" id="page">


	<?php

    if(!empty($this->breadcrumbs)):?>
		<?php
        $this->widget(
            'booster.widgets.TbBreadcrumbs',
               $this->breadcrumbs
        );

        ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer"></div><!-- footer -->

</div><!-- page -->

</body>
</html>
