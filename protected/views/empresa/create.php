<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Empresa'), array('empresa/admin')),
        'links' => array('Crear Nuevo'),
    )
);

?>

    <div class="page-header">
        <h1>Empresa <small>Crear Nuevo</small></h1>
    </div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>