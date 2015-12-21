<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Empresa',
        'links' => array(''),
    )
);

?>


<div class="page-header">
    <h1>Empresa <small>Administrador</small> <?php echo CHtml::link('Nuevo',array('empresa/create'),array('class'=>'btn btn-primary'));?></h1>
</div>

<?php

switch(Yii::app()->user->tipo_usuario){
    case 'admin':
        $template = '{anadir} {ver} {update} {delete}';
        break;
    case 'super_admin':
        $template = '{update} {delete}';
        break;
    case 'tecnico':
        $template = '{ver}';
        break;
    case 'cliente':
        $template = '{ver}';
        break;
    case 'reemplazo':
        $template = '{ver}';
        break;

}


$gridColumns = array(
    array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
    array('name'=>'nombre', 'header'=>'Nombre'),
    array(
        'htmlOptions' => array('nowrap'=>'nowrap'),
        'class'=>'booster.widgets.TbButtonColumn',
        'template'=>$template,
        'buttons'=>array(
            'anadir' => array
            (
                'options'=>array('title'=>'Añadir Proyectos'),
                'label'=>'<i class="glyphicon glyphicon-plus-sign"> </i>',
                'url'=>'Yii::app()->createUrl("proyecto/create", array("id"=>$data->id))',

            ),
            'ver' => array
            (
                'options'=>array('title'=>'Ver Proyectos'),
                'label'=>'<i class="glyphicon glyphicon-eye-open"> </i>',
                'url'=>'Yii::app()->createUrl("empresa/proyectos", array("id"=>$data->id))',

            ),
        ),
        'viewButtonUrl'=> 'Yii::app()->createUrl("/empresa/view", array("id"=>$data["id"]))',
        'updateButtonUrl'=>'Yii::app()->createUrl("/empresa/update", array("id"=>$data["id"]))',
        'deleteButtonUrl'=> 'Yii::app()->createUrl("/empresa/delete", array("id"=>$data["id"]))',
    )
);

$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model,
        'template' => "{items}",
        'columns'=>$gridColumns,
    )
);
?>
