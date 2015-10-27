<?php

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Clientes'), array('cliente/admin')),
        'links' => array('Detalle'),
    )
);

?>

<div class="page-header">
    <h1>Cliente <small>Detalle #<?php echo $model->id; ?></small></h1>
</div>


<?php
$this->widget(
    'booster.widgets.TbDetailView',
    array(
	'data'=> $model,
	'attributes'=>array(
		'id',
		'nombre',
		'telefono',
		'direccion',
        'region.nombre',
        'comuna.nombre',
        'departamento.nombre',
        array('name'=>'departamento_id',
              'value'=>'departamento_id'
        ),
	),
)); ?>
