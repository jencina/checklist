<?php
/* @var $this ClienteController */
/* @var $model Cliente */
$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Email'), array('email/index')),
        'links' => array('Editar'),
    )
);
?>

    <div class="page-header">
        <h1>Email <small> Editar</small></h1>
    </div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>