<?php
/* @var $this CpuController */
/* @var $model Cpu */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Cpu',
        'links' => array(''),
    )
);
?>

<div class="page-header">
    <h1>Cpu <small>Administrador</small> <?php echo CHtml::link('Nuevo',array('cpu/create'),array('class'=>'btn btn-primary'));?></h1>
</div>

<?php $this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model,
        'template' => "{items} {pager}",
	'columns'=>array(
		'id',
		'marca',
		'modelo',
		//'serie',
		//'etiqueta',
		'procesador',
		/*
		'velocidad',
		*/
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'booster.widgets.TbButtonColumn',
        )
	),
)); ?>
