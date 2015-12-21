<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->id,
);

?>

<h1>View Empresa #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'razon_social',
		'rut',
		'direccion_comercial',
		'contacto_facturacion',
		'telefono_fijo',
		'telefono_celular',
		'email_contacto',
		'contacto_administracion',
		'telefono_administracion',
		'pais_prestacion_servicios',
		'logo',
		'tipo_empresa_id',
	),
)); ?>
