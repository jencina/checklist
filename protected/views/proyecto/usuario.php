
<?php //Yii::app()->clientScript->registerCoreScript('autocomplete'); ?>
<div class="usuario col-md-12">


    <input type="hidden" class="valusuario" value="<?php echo $i?>">

    <div class="col-md-3">
        <div class="form-group">
        <label class="control-label" for="Usuario_nombre">Nombre:</label>
        <?php

        $this->widget('ext.autocomplete.myAutoComplete', array(
            'model'=>$usuario,
            'attribute'=>'nombre',
            'id'=>'Usuario_'.$i.'_nombre',
            'name'=>'Usuario['.$i.'][nombre]',
            'source'=>$listUsuarios,
              'options' => array(
                  'minLength'=>1,
                  'autoFill'=>false,
                  'showAnim'=>'fold',
                  'focus'=> "js:function( event, ui ) {
                        $('#Usuario_{$i}_id').val( ui.item.nombre);
                         return false;
                     }",
                  'select'=>"js:function(event, ui) {
                        $('#Usuario_{$i}_id').val(ui.item.id);
                        $('#Usuario_{$i}_email').val(ui.item.email);
                        $('#Usuario_{$i}_tipo_usuario_id').val(ui.item.tipo);
                    }",
              ),
                'htmlOptions'=>array(
                    'autocomplete'=>'off',
                    'class'=>'form-control input-1',
                    'name'=>'Usuario['.$i.'][nombre]',
                    'placeholder'=>'Nombre Usuario'
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
        <?php echo $form->error($usuario,'nombre'); ?>

            </div>
    </div>

    <div class="col-md-3">
        <?php echo $form->textFieldGroup($usuario, 'tipo_usuario_id',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                'widgetOptions' => array(
                    'htmlOptions'=>array('value'=>(isset($usuario->tipoUsuario->nombre))?$usuario->tipoUsuario->nombre:'','id'=>'Usuario_'.$i.'_tipo_usuario_id','name'=>'Usuario['.$i.'][tipo_usuario_id]','readonly'=>'readonly')
                )

            )
        ); ?>
    </div>

    <div class="col-md-3">
        <?php echo $form->textFieldGroup($usuario, 'email',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                'widgetOptions' => array(
                    'htmlOptions'=>array('id'=>'Usuario_'.$i.'_email','name'=>'Usuario['.$i.'][email]','readonly'=>'readonly')
                )

            )
        ); ?>
    </div>

    <?php echo $form->hiddenField($usuario, 'id',array('name'=>'Usuario['.$i.'][id]')); ?>

    <?php if($i > 0){?>
        <div class="col-md-3">
            <?php echo CHtml::link('eliminar','',array('style'=>'margin-top:25px;','class'=>'btn btn-danger','onclick'=>'$(this).parents(".usuario").remove()')); ?>
        </div>
    <?php }?>

</div>


