<?php
/* @var $this TareaController */
/* @var $model Tarea */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link('Tareas',array('tarea/admin')),
        'links' => array('Crear'),
    )
);

?>

    <div class="page-header">
        <h1>Tarea <small>Crear Nuevo</small></h1>
    </div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>