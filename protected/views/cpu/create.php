<?php
/* @var $this CpuController */
/* @var $model Cpu */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Cpu'), array('cpu/admin')),
        'links' => array('Crear Nuevo'),
    )
);

?>

    <div class="page-header">
        <h1>Cpu <small>Crear Nuevo</small></h1>
    </div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>