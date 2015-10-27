<?php
/* @var $this ClienteController */
/* @var $model Proyecto */
$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Clientes'), array('cliente/admin')),
        'links' => array('Editar'),
    )
);
?>

    <div class="page-header">
        <h1>Cliente <small>Editar #<?php echo $model->id?></small></h1>
    </div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>