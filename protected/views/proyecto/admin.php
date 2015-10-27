<?php
/* @var $this ClienteController */
/* @var $model Proyecto */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Clientes',
        'links' => array(''),
    )
);

?>

<div class="page-header">
    <h1>Proyectos <small>Administrador</small> <?php echo CHtml::link('Nuevo',array('proyecto/create'),array('class'=>'btn btn-primary'));?></h1>
</div>


<?php $this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model->search(),
        'template' => "{items} {pager}",
	'columns'=>array(
		'id',
		'nombre',
		//'telefono',
		//'direccion',
        array('name'=>'empresa_id',
            'value'=>'$data->empresa->nombre'
        ),
        array('name'=>'departamento_id',
            'value'=>'(isset($data->departamento_id))?$data->departamento->nombre:$data->departamento_id'
        ),

        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{anadir} {conf} {view} {update} {delete}',
            'buttons'=>array(
                'conf' => array
                (
                    'options'=>array('title'=>'Configurar Checklist'),
                    'label'=>'<i class="glyphicon glyphicon-cog "> </i>',
                    'url'=>'Yii::app()->createUrl("proyecto/configurar", array("id"=>$data->id))',

                ),
                'anadir' => array
                (
                    'options'=>array('title'=>'Añadir Checklist'),
                    'label'=>'<i class="glyphicon glyphicon-plus-sign"> </i>',
                    'url'=>'Yii::app()->createUrl("checklist/admin", array("id"=>$data->id))',

                ),
            ),
            'viewButtonUrl'=> 'Yii::app()->createUrl("/proyecto/view", array("id"=>$data["id"]))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/proyecto/update", array("id"=>$data["id"]))',
            'deleteButtonUrl'=> 'Yii::app()->createUrl("/proyecto/delete", array("id"=>$data["id"]))'

        )
	),
)); ?>
