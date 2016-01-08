<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Usuarios',
        'links' => array(''),
    )
);
?>


<div class="page-header">
    <h1>Usuarios <small>Administrador</small>
        <?php echo CHtml::link('Nuevo',array('usuario/create'),array('class'=>'btn btn-primary'));?>
        <?php echo CHtml::link('Verificar Tecnicos',array('usuario/verificarTecnico'),array('class'=>'btn btn-success'));?>
    </h1>
</div>

<?php

$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model,
		'filter'=>$model,
        'template' => "{items} {pager}",
        'columns'=>array(
            'id',
            'nombre',
            'apellido',
          //  'usuario',
           // 'password',
            'email',
            array('name'=>'tipo_usuario_id',
                'value'=>'$data->tipoUsuario->nombre'
            ),
            //'activo',
            array(
                'htmlOptions' => array('nowrap'=>'nowrap'),
                'class'=>'booster.widgets.TbButtonColumn',
                'viewButtonUrl'=> 'Yii::app()->createUrl("/usuario/view", array("id"=>$data["id"]))',
                'updateButtonUrl'=>'Yii::app()->createUrl("/usuario/update", array("id"=>$data["id"]))',
                'deleteButtonUrl'=> 'Yii::app()->createUrl("/usuario/delete", array("id"=>$data["id"]))',
            )
        ),
    )
);


 ?>
