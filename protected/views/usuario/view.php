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
            'empresa_id',
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
