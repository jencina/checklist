
<?php //Yii::app()->clientScript->registerCoreScript('autocomplete'); ?>
<div class="usuario col-md-12">


    <input type="hidden" class="valutarea" value="<?php echo $i?>">

    <div class="col-md-3">
        <div class="form-group">
        <label class="control-label" for="Tarea_nombre">Nombre:</label>
        <?php

        $this->widget('ext.autocomplete.myAutoComplete', array(
            'model'=>$tarea,
            'attribute'=>'nombre',
            'id'=>'Tarea_'.$i.'_nombre',
            'name'=>'Tarea['.$i.'][nombre]',
            'source'=>$listTareas,
              'options' => array(
                  'minLength'=>1,
                  'autoFill'=>false,
                  'showAnim'=>'fold',
                  'focus'=> "js:function( event, ui ) {
                        $('#Tarea_{$i}_id').val( ui.item.id);
                         return false;
                     }",
                  'select'=>"js:function(event, ui) {
                        $('#Tarea_{$i}_id').val(ui.item.id);
                        $('#Tarea_{$i}_precio').val(ui.item.precio);
                        $('#Tarea_{$i}_tiempo').val(ui.item.tiempo);
                    }",
              ),
                'htmlOptions'=>array(
                    'autocomplete'=>'off',
                    'class'=>'form-control input-1',
                    'name'=>'Tarea['.$i.'][nombre]',
                    'placeholder'=>'Nombre Tarea'
                ),
               'methodChain'=>'.data( "autocomplete" )._renderItem = function( ul, item ) {
                console.log(item);
                    return $( "<div class=\'drop_class\'></div>")
                        .data( "item.autocomplete", item )
                        .append( "<a id=\'"+item.id+"\'><div style=\'width:78%;float:left;\'>"+item.nombre+"</div></a>" )
                        .append("<div style=\'clear:both;\'></div>")
                        .appendTo(ul);
                };'
        ));

        ?>
        <?php echo $form->error($tarea,'nombre'); ?>

            </div>
    </div>

    <div class="col-md-3">
        <?php echo $form->textFieldGroup($tarea, 'precio',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                'widgetOptions' => array(
                    'htmlOptions'=>array('value'=>$tarea->precio,'id'=>'Tarea_'.$i.'_precio','name'=>'Tarea['.$i.'][precio]','readonly'=>'readonly')
                )

            )
        ); ?>
    </div>

    <div class="col-md-3">
        <?php echo $form->textFieldGroup($tarea, 'tiempo',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                'widgetOptions' => array(
                    'htmlOptions'=>array('value'=>$tarea->tiempo,'id'=>'Tarea_'.$i.'_tiempo','name'=>'Tarea['.$i.'][tiempo]','readonly'=>'readonly')
                )

            )
        ); ?>
    </div>
    

    <?php echo $form->hiddenField($tarea, 'id',array('name'=>'Tarea['.$i.'][id]')); ?>

    <?php if($i > 0){?>
        <div class="col-md-3">
            <?php echo CHtml::link('eliminar','',array('style'=>'margin-top:25px;','class'=>'btn btn-danger','onclick'=>'$(this).parents(".usuario").remove()')); ?>
        </div>
    <?php }?>

</div>


