

<div class="page-header">
    <h1>Checklist <small>Clientes</small></h1>
</div>

<?php

$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type'         => 'striped',
        'dataProvider' => $model,
        'template'     => "{items}",
        'columns'=>array(
            'id',
            array(
                'name'  => 'nombre',
                'value' => '$data->nombre',
                'header'=> 'Nombre Cliente'
            ),
            array(
                'htmlOptions' => array('nowrap'=>'nowrap'),
                'class'       => 'booster.widgets.TbButtonColumn',
                'template'    => '{ver}',
                'buttons'     => array(
                    'ver' => array
                    (
                        'options'=> array('title'=>'Ver Checklist Cliente'),
                        'label'  => '<i class="glyphicon glyphicon-eye-open"> </i>',
                        'url'    => 'Yii::app()->createUrl("checklist/admin", array("id"=>$data->id))',

                    ),
                ),

            )
        ),
    )); ?>
