<?php
/* @var $this TareaController */
/* @var $model Tarea */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Tareas',
        'links' => array(''),
    )
);

?>

<div class="page-header">
    <h1>Tareas <small>Administrador</small> <?php echo CHtml::link('Nuevo',array('tarea/create'),array('class'=>'btn btn-primary'));?></h1>
</div>


<?php $this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model,
        'template' => "{items} {pager}",
	'columns'=>array(
		'id',
		'nombre',
		'precio',
		array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{update} {delete}'
		),
	),
)); ?>
