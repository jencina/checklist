


<div class="page-header">
    <h1>Checklist <small> <?php echo $proyecto->region->nombre.' - '.$proyecto->comuna->nombre; ?> </small>
        <?php
            if(Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre == 'admin'){
                echo CHtml::link('Nuevo','',array('onclick'=>'addChecklist('.$id.')','class'=>'btn btn-primary'));
            }
        ?>
    </h1>
</div>

<?php

$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped',
        'id'   =>  'checklist-grid',
        'dataProvider' => $model,
        'template' => "{items} {pager}",
        'enablePagination' => true,
     // 'summaryText'=>'Displaying {start}-{end} of {count} results.',
        'columns'=>array(
            array(
                'header'=>'No.',
                'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            ),

            //'id',
           // 'precio',
            'fecha_inicio',
            'fecha_termino',
            array('name'  => 'estado_id',
                  'value' => '$data->estado->nombre',
            ),

            array(
                'htmlOptions' => array('nowrap'=>'nowrap'),
                'class'=>'booster.widgets.TbButtonColumn',
                'template'=>'{ver} {update} {delete} {pdf}',
                'updateButtonUrl'=>'Yii::app()->createUrl("/checklist/update", array("id"=>$data["id"]))',
                'buttons'=>array(
                    'delete' => array
                    (
                        'options' => array('title'=>'Eliminar'),
                        'label'   => '<i class="glyphicon glyphicon-trash"> </i>',
                        'url'     => 'Yii::app()->createUrl("checklist/delete", array("id"=>$data->id))',
                        'visible' => 'Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre == "admin"'
                    ),

                    'update' => array
                    (
                        'options'=>array('title'=>'Editar'),
                        'label'=>'<i class="glyphicon glyphicon-pencil"> </i>',
                        'url'=>'Yii::app()->createUrl("checklist/update", array("id"=>$data->id))',
                        'visible' => 'Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre != "cliente"'

                    ),

                    'ver' => array
                    (
                        'options'=>array('title'=>'Ver Checklist'),
                        'label'=>'<i class="glyphicon glyphicon-eye-open"> </i>',
                        'url'=>'Yii::app()->createUrl("checklist/view", array("id"=>$data->id))',

                    ),

                    'pdf' => array
                    (
                        'options'=>array('title'=>'Exportar a Pdf'),
                        'label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/pdf-icon.png" style="width: 20px;margin-top: -5px" />',
                        'url'=>'Yii::app()->createUrl("checklist/exportPdf", array("id"=>$data->id))',

                    ),

                   /* 'excel' => array
                    (
                        'options'=>array('title'=>'Exportar a excel'),
                        'label'=>'<img src="'.Yii::app()->request->baseUrl.'/images/excel-xls-icon.png" style="width: 20px;margin-top: -5px" />',
                         'url'=>'Yii::app()->createUrl("checklist/exportExcel", array("id"=>$data->id))',

                    ),*/

                ),
            )
        ),
    ));

?>

<!--
<div class="precio-total col-md-4"
     style="background-color: #428bca;
            border: 1px solid #ddd;
            border-radius: 10px;
            color: #fff;
            padding: 10px;">
    <span>Precio Total: </span>
    <span><?php echo ' $'.$precio?></span>
</div>
-->



<script>

    function addChecklist(id){

        $.ajax({

            url  : "<?php echo Yii::app()->createURL('checklist/addChecklist');?>",
            type : 'post',
            cache: false ,
            data : { id: id },
            success: function(data){
                if(data.status == 'success'){

                    $.fn.yiiGridView.update('checklist-grid');

                }
            }
        });

        return false;

    }

</script>



