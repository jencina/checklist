<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Sistema Operativo'), array('sistemaOperativo/admin')),
        'links' => array('Editar'),
    )
);
?>
    <div class="page-header">
        <h1>Empresa <small>Editar #<?php echo $model->nombre?></small></h1>
    </div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>