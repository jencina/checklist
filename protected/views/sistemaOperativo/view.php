<?php
/* @var $this SistemaOperativoController */
/* @var $model SistemaOperativo */

$this->breadcrumbs=array(
	'Sistema Operativos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SistemaOperativo', 'url'=>array('index')),
	array('label'=>'Create SistemaOperativo', 'url'=>array('create')),
	array('label'=>'Update SistemaOperativo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SistemaOperativo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SistemaOperativo', 'url'=>array('admin')),
);
?>

<h1>View SistemaOperativo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'version',
	),
)); ?>
