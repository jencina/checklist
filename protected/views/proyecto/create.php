<?php
/* @var $this ClienteController */
/* @var $model Proyecto */


?>

    <div class="page-header">
        <h1>Proyecto <small>Crear Nuevo</small></h1>
    </div>

<?php $this->renderPartial('_form', array(
        'model'=>$model,
        'localidades'=>$localidades,
        'internos'=>$internos,
        'externos'=>$externos,
        'usuarios'=>$usuarios,
        'listUsuarios'=>$listUsuarios,
        'tareas'=>$tareas,
        'listTareas'=>$listTareas,
        'id'=>$id,
        'configuracion'=>$configuracion
)); ?>