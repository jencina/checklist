<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Clientes',
        'links' => array(''),
    )
);

?>

<div class="page-header">
    <h1>Clientes <small>Administrador</small> <?php echo CHtml::link('Nuevo',array('cliente/create'),array('class'=>'btn btn-primary'));?></h1>
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
        array('name'=>'region_id',
            'value'=>'$data->region->nombre'
        ),
        array('name'=>'comuna_id',
            'value'=>'$data->comuna->nombre'
        ),
        array('name'=>'empresa_id',
            'value'=>'$data->empresa->nombre'
        ),
        array('name'=>'departamento_id',
            'value'=>'$data->departamento->nombre'
        ),

        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{conf} {view} {update} {delete}',
            'buttons'=>array(
                'conf' => array
                (
                    'options'=>array('title'=>'Configurar Checklist'),
                    'label'=>'<i class="glyphicon glyphicon-cog "> </i>',
                    'url'=>'Yii::app()->createUrl("cliente/configurar", array("id"=>$data->id))',

                ),
            ),
            'viewButtonUrl'=> 'Yii::app()->createUrl("/cliente/view", array("id"=>$data["id"]))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/cliente/update", array("id"=>$data["id"]))',
            'deleteButtonUrl'=> 'Yii::app()->createUrl("/cliente/delete", array("id"=>$data["id"]))'

        )
	),
)); ?>
