<?php
/* @var $this MonitorController */
/* @var $model Monitor */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Monitor'), array('monitor/admin')),
        'links' => array('Crear Nuevo'),
    )
);

?>

    <div class="page-header">
        <h1>Monitor <small>Crear Nuevo</small></h1>
    </div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>