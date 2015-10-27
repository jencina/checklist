<?php
/* @var $this ClienteController */
/* @var $model Proyecto */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Empresa'), array('empresa/admin')),
        'links' => array('Proyectos'=> array('empresa/proyectos','id'=>$empresa->id),'Localidades'),
    )
);

?>

    <div class="page-header">
        <h1>Localidades<small> <?php echo $proyecto->nombre?></small> </h1>
    </div>


<?php $this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'dataProvider' => $model,
        'template' => "{items} {pager}",
        'columns'=>array(
            'id',
            array('name'=>'region_id',
                'value'=>'$data->region->nombre'
            ),
            array('name'=>'comuna_id',
                'value'=>'$data->comuna->nombre'
            ),
            'direccion',
            array(
                'header'=>'Checklist',
                'name'=>'checklist',
                'value'=>array($this,'gridLocalidadesChecklist')
            ),
            array(
                'htmlOptions' => array('nowrap'=>'nowrap'),
                'class'=>'booster.widgets.TbButtonColumn',
                'template'=>'{anadir}',
                'buttons'=>array(
                    'anadir' => array
                    (
                        'options'=>array('title'=>'Añadir Checklist'),
                        'label'=>'<i class="glyphicon glyphicon-plus-sign"> </i>',
                        'url'=>'Yii::app()->createUrl("checklist/admin", array("id"=>$data->id))',
                    ),
                ),
            )
        ),
    )); ?>