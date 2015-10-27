<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Clientes'), array('cliente/admin')),
        'links' => array('Crear Nuevo'),
    )
);


?>

    <div class="page-header">
        <h1>Cliente <small>Crear Nuevo</small></h1>
    </div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>