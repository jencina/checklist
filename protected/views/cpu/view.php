<?php
/* @var $this CpuController */
/* @var $model Cpu */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Cpu'), array('cpu/admin')),
        'links' => array('Detalle'),
    )
);
?>

<div class="page-header">
    <h1>Cpu <small>Detalle #<?php echo $model->id; ?></small></h1>
</div>

<?php
$this->widget(
    'booster.widgets.TbDetailView',
    array(
        'data'=> $model,
	'attributes'=>array(
		'id',
		'marca',
		'modelo',
		'serie',
		'etiqueta',
		'procesador',
		'velocidad',
	),
)); ?>
