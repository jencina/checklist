<?php
/* @var $this MonitorController */
/* @var $model Monitor */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Monitor',
        'links' => array(''),
    )
);

?>

<div class="page-header">
    <h1>Monitor <small>Administrador</small> <?php echo CHtml::link('Nuevo',array('monitor/create'),array('class'=>'btn btn-primary'));?></h1>
</div>


<?php $this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model->search(),
        'template' => "{items} {pager}",
	'columns'=>array(
		'id',
		'marca',
		'modelo',
		//'serie',
		//'etiqueta',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'booster.widgets.TbButtonColumn',
        )
	),
)); ?>
