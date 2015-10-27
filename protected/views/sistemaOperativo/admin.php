<?php
/* @var $this SistemaOperativoController */
/* @var $model SistemaOperativo */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Sistema Operativo',
        'links' => array(''),
    )
);

?>

<div class="page-header">
    <h1>Sistema Operativo <small>Administrador</small> <?php echo CHtml::link('Nuevo',array('sistemaOperativo/create'),array('class'=>'btn btn-primary'));?></h1>
</div>


<?php $this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model,
        'template' => "{items} {pager}",
	'columns'=>array(
		'id',
		'version',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{update}  {delete}'
        )
	),
)); ?>
