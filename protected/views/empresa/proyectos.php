<?php
/* @var $this ClienteController */
/* @var $model Proyecto */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Empresa'), array('empresa/admin')),
        'links' => array('Proyectos'),
    )
);

?>

<div class="page-header">
    <h1>Proyectos <small> <?php echo $empresa->nombre?></small> <?php echo CHtml::link('Nuevo',array('proyecto/create','id'=>$empresa->id),array('class'=>'btn btn-primary'));?></h1>
</div>


<?php

switch(Yii::app()->user->tipo_usuario){

    case 'admin':
        $template = '{chart}  {anadir}  {conf}  {view}  {update}  {delete}';
        break;
    case 'tecnico':
        $template = '{anadir} {view}';
        break;
    case 'cliente':
        $template = '{anadir} {view}';
        break;

}

$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model,
        'template' => "{items} {pager}",
        'columns'=>array(
            'id',
            'nombre',
            //'telefono',
            //'direccion',
            array('name'=>'empresa_id',
                'value'=>'$data->empresa->nombre'
            ),
            array('name'=>'departamento_id',
                'value'=>'(isset($data->departamento_id))?$data->departamento->nombre:$data->departamento_id'
            ),

            array(
                'htmlOptions' => array('nowrap'=>'nowrap'),
                'class'=>'booster.widgets.TbButtonColumn',
                'template'=>$template,
                'buttons'=>array(
                    'chart' => array
                    (
                        'options'=>array('title'=>'ver graficos'),
                        'label'=>'<i class="fa fa-bar-chart-o"> </i>',
                        'url'=>'Yii::app()->createUrl("proyecto/graficos", array("id"=>$data->id))',

                    ),
                    'conf' => array
                    (
                        'options'=>array('title'=>'Configurar Checklist'),
                        'label'=>'<i class="glyphicon glyphicon-cog "> </i>',
                        'url'=>'Yii::app()->createUrl("proyecto/configurar", array("id"=>$data->id))',

                    ),
                    'anadir' => array
                    (
                        'options'=>array('title'=>'Ver Localidades'),
                        'label'=>'<i class="glyphicon glyphicon-plus-sign"> </i>',
                        'url'=>'Yii::app()->createUrl("empresa/localidades", array("id"=>$data->id))',
                    ),
                ),
                'viewButtonUrl'=> 'Yii::app()->createUrl("/proyecto/view", array("id"=>$data["id"]))',
                'updateButtonUrl'=>'Yii::app()->createUrl("/proyecto/update", array("id"=>$data["id"]))',
                'deleteButtonUrl'=> 'Yii::app()->createUrl("/proyecto/delete", array("id"=>$data["id"]))'

            )
        ),
    )); ?>
