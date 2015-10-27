<?php
/* @var $this SistemaOperativoController */
/* @var $model SistemaOperativo */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Sistema Operativo'), array('sistemaOperativo/admin')),
        'links' => array('Crear Nuevo'),
    )
);
?>

    <div class="page-header">
        <h1>Sistema Operativo <small>Crear Nuevo</small></h1>
    </div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>