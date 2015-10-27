<?php

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link('Tareas',array('tarea/admin')),
        'links' => array('Editar'),
    )
);

?>

    <div class="page-header">
        <h1>Tareas <small>Editar #<?php echo $model->id?></small> </h1>
    </div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>