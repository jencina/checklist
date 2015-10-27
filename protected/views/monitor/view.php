<?php
/* @var $this MonitorController */
/* @var $model Monitor */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Monitor'), array('monitor/admin')),
        'links' => array('Detalle'),
    )
);

?>

<div class="page-header">
    <h1>Monitor <small>Detalle #<?php echo $model->id; ?></small></h1>
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
	),
)); ?>
