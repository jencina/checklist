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
    <h1>Usuarios <small>Detalle #<?php echo $model->id; ?></small></h1>
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
            'password',
            'email',
            //'tipo_contrato_id',
            //'fecha_inicio',
            //'fecha_termino',
        ),
    )
);

 ?>

<?php if(!empty($tecnico->contrato_adjunto)){?>
    <div class="col-md-12">
        <div class="col-md-6">
            <?php echo $tecnico->contrato_adjunto.CHtml::link('Descargar',Yii::app()->request->baseUrl.'/images/usuarios/contratos/'.$tecnico->contrato_adjunto,array('target'=>'_blanc','class'=>'btn btn-primary','style'=>'width: 48%;'));; ?>
        </div>
    </div>
<?php } ?>
