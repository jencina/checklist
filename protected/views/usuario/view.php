<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Usuarios'), array('usuario/admin')),
        'links' => array('Detalle'),
    )
);

?>

<div class="page-header">
    <h1>Usuario <small>Detalle #<?php echo $model->id; ?></small></h1>
</div>




<?php

$this->widget(
    'booster.widgets.TbDetailView',
    array(
        'data' => $model,
        'attributes'=>array(
            'id',
            'nombre',
            'apellido',
            array(
                'label' => 'Empresa',
                'value' => (isset($model->empresa->nombre))?$model->empresa->nombre:''
            ),
            'usuario',
            'email',
            array(
                'label' => 'Tipo Usuario',
                'value' => (isset($model->tipoUsuario->nombre))?$model->tipoUsuario->nombre:''
            ),
        ),
    )
); ?>

<?php

if(!empty($tecnico)){ ?>

    <div class="page-header">
        <h1>Datos Adicionales</h1>
    </div>

    <?php $this->widget(
        'booster.widgets.TbDetailView',
        array(
            'data' => $tecnico,
            'attributes'=>array(
                'rut',
                'fecha_inicio',
                'fecha_termino',
                'telefono_fijo',
                'telefono_celular',
                'direccion'

            ),
        )
    );
}

 ?>

<?php if(!empty($tecnico->contrato_adjunto)){?>
    <div class="page-header">
        <h1>Documentos</h1>
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
            <?php echo $tecnico->contrato_adjunto.'</br>'.CHtml::link('Descargar',Yii::app()->request->baseUrl.'/images/usuarios/contratos/'.$tecnico->contrato_adjunto,array('target'=>'_blanc','class'=>'btn btn-primary','style'=>'width: 48%;'));; ?>
        </div>
    </div>
<?php } ?>
