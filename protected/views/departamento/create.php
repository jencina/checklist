<?php
/* @var $this DepartamentoController */
/* @var $model Departamento */
$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Departamento'), array('departamento/admin')),
        'links' => array('Crear Nuevo'),
    )
);
?>

    <div class="page-header">
        <h1>Departamento <small>Crear Nuevo</small></h1>
    </div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>