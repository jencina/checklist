<?php
/* @var $this SistemaOperativoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sistema Operativos',
);

$this->menu=array(
	array('label'=>'Create SistemaOperativo', 'url'=>array('create')),
	array('label'=>'Manage SistemaOperativo', 'url'=>array('admin')),
);
?>

<h1>Sistema Operativos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
