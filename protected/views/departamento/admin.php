<?php
/* @var $this DepartamentoController */
/* @var $model Departamento */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Departamento',
        'links' => array(''),
    )
);
?>

<div class="page-header">
    <h1>Departamento <small>Administrador</small> <?php echo CHtml::link('Nuevo',array('departamento/create'),array('class'=>'btn btn-primary'));?></h1>
</div>


<?php $this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model,
        'template' => "{items}",
	'columns'=>array(
		'id',
		'nombre',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{update}  {delete}',
            'viewButtonUrl'=> 'Yii::app()->createUrl("/departamento/view", array("id"=>$data["id"]))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/departamento/update", array("id"=>$data["id"]))',
            'deleteButtonUrl'=> 'Yii::app()->createUrl("/departamento/delete", array("id"=>$data["id"]))',
        )
	),
)); ?>
