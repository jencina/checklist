

<?php
//Yii::app()->clientScript->registerCoreScript('jquery.ui');

$form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'cliente-form',
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well')
    )
);

?>

<fieldset>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Datos</h3>
        </div>
        <div class="panel-body">

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'nombre',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'telefono',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                'widgetOptions' => array(
                    'htmlOptions'=>array('placeholder'=>'Ej: +569 587 99 122')
                )
            )
        ); ?>
    </div>



    <div class="col-md-6">
        <?php echo $form->dropDownListGroup(
            $model,
            'departamento_id',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'widgetOptions' => array(
                    'data' => CHtml::listData(Departamento::model()->findAll(),'id', 'nombre'),
                    'htmlOptions'=>array('prompt'=>'Seleccione Departamento')
                )
            )
        ); ?>
    </div>


    <div class="col-md-6">

        <?php

        if(!empty($model->empresa_id)){ ?>
          <!--  echo $form->textFieldGroup(
                $model,
                'empresa_id',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                    'widgetOptions' => array(
                        'htmlOptions' => array('value'=>(isset($model->empresa->nombre))?$model->empresa->nombre:'','disabled' => true)
                    )
                )
            ); -->

            <div class="form-group">
                <label class="control-label required" for="Proyecto_empresa_id">
                    Empresa
                    <span class="required">*</span>
                </label>
                <input id="empresa" class="form-control" type="text" name="empresa" placeholder="Empresa" disabled="disabled" value="<?php echo (isset($model->empresa->nombre))?$model->empresa->nombre:''?>">
            </div>
        <?PHP }else{
            echo $form->dropDownListGroup(
                $model,
                'empresa_id',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                    'widgetOptions' => array(
                        'data' => CHtml::listData(Empresa::model()->findAllByAttributes(array('empresa_id'=>Usuario::model()->findByPk(Yii::app()->user->id)->empresa_id)),'id', 'nombre'),
                        'htmlOptions'=>array('prompt'=>'Seleccione Empresa')
                    )
                )
            );
        }

        ?>
    </div>

            <div class="col-md-6">

                <?php

                echo $form->datePickerGroup(
                    $model,
                    'fecha_inicio',
                    array(
                        'widgetOptions' => array(
                            'options' => array(
                                'format'=>'yyyy-mm-dd',
                                'language' => 'es',
                                'autoclose'=> true,
                            ),
                        ),
                        'wrapperHtmlOptions' => array(
                            'class' => 'col-sm-5',
                        ),
                        // 'hint' => 'Click inside! This is a super cool date field.',
                        'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
                    )
                );

                ?>
            </div>

            <div class="col-md-6">

                <?php

                echo $form->datePickerGroup(
                    $model,
                    'fecha_termino',
                    array(
                        'widgetOptions' => array(
                            'options' => array(
                                'format'=>'yyyy-mm-dd',
                                'language' => 'es',
                                'autoclose'=> true,
                            ),
                        ),
                        'wrapperHtmlOptions' => array(
                            'class' => 'col-sm-5',
                        ),
                        // 'hint' => 'Click inside! This is a super cool date field.',
                        'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
                    )
                );

                ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default jefeInterno">
        <div class="panel-heading">
            <h3 class="panel-title">Jefe Proyecto Interno<?php echo CHtml::link('Agregar','',array('style'=>'color:#fff;','id'=>'btn-interno','class'=>'btn btn-success btn-agregar'));?></h3>
        </div>
        <div class="panel-body">
            <?php
            foreach($internos as $index=>$jefeProyecto){
                $this->renderPartial('application.views.proyecto.jefeProyecto',array('jefeProyecto'=>$jefeProyecto,'i'=>$index,'form'=>$form,'tipo'=>'interno'));
            }
          ?>
        </div>
    </div>

    <div class="panel panel-default jefeExterno">
        <div class="panel-heading">
            <h3 class="panel-title">Jefe Proyecto Externo<?php echo CHtml::link('Agregar','',array('style'=>'color:#fff;','id'=>'btn-externo','class'=>'btn btn-success btn-agregar'));?></h3>
        </div>
        <div class="panel-body">
            <?php
            foreach($externos as $index=>$jefeProyecto){
                $this->renderPartial('application.views.proyecto.jefeProyecto',array('jefeProyecto'=>$jefeProyecto,'i'=>$index,'form'=>$form,'tipo'=>'externo'));
            }
            ?>
        </div>
    </div>

    <div class="panel panel-default localidades">
        <div class="panel-heading">
            <h3 class="panel-title">Localidades<?php echo CHtml::link('Agregar','',array('style'=>'color:#fff;','id'=>'btn-localidad','class'=>'btn btn-success btn-agregar'));?></h3>
        </div>
        <div class="panel-body">
            <?php
            foreach($localidades as $index=>$localidad){
                $this->renderPartial('application.views.proyecto.localidad',array('localidad'=>$localidad,'i'=>$index,'form'=>$form));
            }
            ?>
        </div>
    </div>

    <div class="panel panel-default usuarios">
        <div class="panel-heading">
            <h3 class="panel-title">Usuarios<?php echo CHtml::link('Agregar','',array('onclick'=>"setUsuario()",'style'=>'color:#fff;','class'=>'btn btn-success btn-agregar'));?></h3>
        </div>

        <div class="panel-body">
            <?php
            foreach($usuarios as $index=>$usuario){
                $this->renderPartial('application.views.proyecto.usuario',array('usuario'=>$usuario,'i'=>$index,'listUsuarios'=>$listUsuarios,'form'=>$form));
            }
            ?>
        </div>
    </div>


    <div class="panel panel-default configuracion">

        <div class="panel-heading">
            <h3 class="panel-title">Configuracion Checklist</h3>
        </div>

        <div class="panel-body">

            <div class="col-md-6">
            <?php echo $form->dropDownListGroup(
                $model,
                'tipo_checklist_id',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                    'widgetOptions' => array(
                        'data' => CHtml::listData(TipoChecklist::model()->findAll(),'id', 'nombre'),
                        'htmlOptions'=>array('prompt'=>'Seleccione Tipo Checklist')
                    )
                )
            ); ?>
            </div>

            <div id="configuracion" class="col-md-12" style="min-width: 100%;display:none;">
            <?php
            $this->renderPartial('application.views.configuracion.index',array('configuracion'=>$configuracion));
            ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default tareas">

        <div class="panel-heading">
            <h3 class="panel-title">Tareas<?php echo CHtml::link('Agregar','',array('onclick'=>"setTarea()",'style'=>'color:#fff;','class'=>'btn btn-success btn-agregar'));?></h3>
        </div>

        <div class="panel-body">
            <?php
            foreach($tareas as $index=>$tarea){
                $this->renderPartial('application.views.proyecto.tarea',array('tarea'=>$tarea,'i'=>$index,'listTareas'=>$listTareas,'form'=>$form));
            }
            ?>
        </div>
    </div>


    <div class="form-actions col-md-12" >
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Guardar'
            )
        ); ?>
        <?php echo CHtml::link('Cancelar',array('empresa/proyectos','id'=>$model->empresa_id),array('class'=>'btn btn-danger')); ?>
    </div>

</fieldset>
<?php $this->endWidget();
unset($form);

?>



<script>

    function setUsuario(){

        var a   = $('.valusuario').last().val();
        $.ajax({
            url  : "<?php echo Yii::app()->createURL('proyecto/setUsuario');?>",
            type : 'post',
            cache: false ,
            data:{ i:a },
            success: function(data){
                $('.usuarios .panel-body').append(data);
            }
        });
        return false;
    }

    function setTarea(){

        var a   = $('.valutarea').last().val();
        $.ajax({
            url  : "<?php echo Yii::app()->createURL('proyecto/setTarea');?>",
            type : 'post',
            cache: false ,
            data:{ i:a },
            success: function(data){
                $('.tareas .panel-body').append(data);
            }
        });
        return false;
    }

    $(document).ready(function(){

        if($('#Proyecto_tipo_checklist_id').val()==1){
            $('#configuracion').show('slow');
        }

        $('#Proyecto_tipo_checklist_id').change(function(){

            if($('#Proyecto_tipo_checklist_id').val()==1){
                $('#configuracion').show('slow');
            }else{
                $('#configuracion').hide('slow');
            }
        });

        $('#btn-interno').click(function(){
            var a   = $('.valinterno').last().val();
            var tipo= 'interno';
            $.ajax({
                url  : "<?php echo Yii::app()->createURL('proyecto/setJefeProyecto');?>",
                type : 'post',
                cache: false ,
                data:{ i:a ,tipo:tipo},
                success: function(data){
                    $('.jefeInterno .panel-body').append(data.div);
                }
            });
            return false;
        });

        $('#btn-externo').click(function(){
            var a = $('.valexterno').last().val();
            var tipo = 'externo';
            $.ajax({
                url  : "<?php echo Yii::app()->createURL('proyecto/setJefeProyecto');?>",
                type : 'post',
                cache: false ,
                data:{ i:a ,tipo:tipo},
                success: function(data){
                    $('.jefeExterno .panel-body').append(data.div);
                }
            });
            return false;
        });

        $('#btn-localidad').click(function(){
            var a = $('.val').last().val();

            $.ajax({
                url  : "<?php echo Yii::app()->createURL('proyecto/setLocalidad');?>",
                type : 'post',
                cache: false ,
                data:{ i:a },
                success: function(data){
                    $('.localidades .panel-body').append(data.div);
                }
            });
            return false;
        });



    });
</script>