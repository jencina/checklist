

<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'proyecto-form',
        'type' => 'vertical',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
       // 'htmlOptions' => array('class' => 'well')
    )
); ?>

<?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>

<div class="panel-group" id="accordion">

    <!-- ESTADO CHECKLIST-->

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Estado Checklist
                </a>
            </h4>
        </div>

        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">

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
                <?php echo $form->timePickerGroup(
                    $model,
                    'hora_inicio',
                    array(
                        'widgetOptions' => array(
                            'wrapperHtmlOptions' => array(
                                'class' => 'col-sm-3'
                            ),
                        ),
                        'hint' => 'Nice bootstrap time picker',
                    )
                ); ?>
                    </div>

                <div class="col-md-6">
                    <?php echo $form->datePickerGroup(
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
                    ); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->timePickerGroup(
                        $model,
                        'hora_termino',
                        array(
                            'widgetOptions' => array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-3'
                                ),
                            ),
                            'hint' => 'Nice bootstrap time picker',
                        )
                    ); ?>
                </div>


                <div class="col-md-6">
                    <?php echo  $form->dropDownListGroup(
                        $model,
                        'estado_id',
                        array(
                            'wrapperHtmlOptions' => array(
                                'class' => 'col-sm-5',
                            ),
                            'widgetOptions' => array(
                                'data' => CHtml::listData(Estado::model()->findAll(),'id', 'nombre'),
                                'htmlOptions'=>array('prompt'=>'Seleccione Estado')
                            )
                        )
                    );  ?>
                </div>

                <div class="col-md-6">
                    <?php

                    if(Usuario::model()->findByPk(Yii::app()->user->id)->tipo_usuario_id == 2){
                        echo  $form->dropDownListGroup(
                            $model,
                            'usuario_id',
                            array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-5',
                                ),
                                'widgetOptions' => array(
                                    'data' => CHtml::listData(ProyectoHasUsuario::model()->findAllByAttributes(array('proyecto_id'=>$model->localidad->proyecto_id)),'usuario_id', 'usuario.nombre'),
                                    'htmlOptions'=>array('prompt'=>'Seleccione Usuario')
                                )
                            )
                        );
                    }else{ ?>

                    <div class="form-group">
                        <label class="control-label" for="IdentificacionUsuario_proyecto_id">Tecnico Asignado</label>
                        <?php echo CHtml::textField('usuario_id',isset($model->usuario->nombre)?$model->usuario->nombre:'',array(
                            'disabled'=>'disabled', 'class' => 'form-control'));?>
                    </div>
                    <?php }?>


                </div>

            </div>
        </div>
    </div>
    <!-- FIN ESTADO CHECKLIST-->


<!-- VALIDACION TIPO CHECKLIST-->

    <?php if($model->localidad->proyecto->tipo_checklist_id == 1){?>

        <!-- INFORMACION USUARIO-->
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                        Informacion Usuario
                    </a>
                </h4>
            </div>

            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($usuario, 'nombre',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <!--<div class="col-md-6">
                        <?php echo  $form->dropDownListGroup(
                            $usuario,
                            'proyecto_id',
                            array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-5',
                                ),
                                'widgetOptions' => array(
                                    'data' => CHtml::listData(Proyecto::model()->findAll(),'id', 'nombre'),
                                    'htmlOptions'=>array('prompt'=>'Seleccione Proyecto')
                                )
                            )
                        );  ?>
                    </div> -->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="IdentificacionUsuario_proyecto_id">Proyecto</label>
                            <?php echo CHtml::textField('departamento',$model->localidad->proyecto->nombre,array(
                                'disabled'=>'disabled', 'class' => 'form-control'));?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($usuario, 'email',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($usuario, 'telefono',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="IdentificacionUsuario_proyecto_id">Departamento</label>
                            <?php echo CHtml::textField('departamento',(isset($model->localidad->proyecto->departamento->nombre))?$model->localidad->proyecto->departamento->nombre:'',array(
                                'disabled'=>'disabled', 'class' => 'form-control'));?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="IdentificacionUsuario_proyecto_id">Region</label>
                            <?php echo CHtml::textField('region',$model->localidad->region->nombre,array(
                                'disabled'=>'disabled', 'class' => 'form-control'));?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="IdentificacionUsuario_proyecto_id">Comuna</label>
                            <?php echo CHtml::textField('comuna',$model->localidad->comuna->nombre,array(
                                'disabled'=>'disabled', 'class' => 'form-control'));?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="IdentificacionUsuario_proyecto_id">Direccion</label>
                            <?php echo CHtml::textField('direccion',$model->localidad->direccion,array(
                                'disabled'=>'disabled', 'class' => 'form-control'));?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- FIN INFORMACION USUARIO-->


        <!-- INFORMACION EQUIPO-->

        <div class="panel panel-default">

            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                        Informacion Equipo
                    </a>
                </h4>
            </div>

            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($informacionEquipo, 'ram',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($informacionEquipo, 'disco',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo  $form->dropDownListGroup(
                            $informacionEquipo,
                            'cpu_id',
                            array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-5',
                                ),
                                'widgetOptions' => array(
                                    'data' => CHtml::listData(Cpu::model()->findAll(),'id','procesador','marca'),
                                    'htmlOptions'=>array('prompt'=>'Seleccione Proyecto')
                                )
                            )
                        );  ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo  $form->dropDownListGroup(
                            $informacionEquipo,
                            'monitor_id',
                            array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-5',
                                ),
                                'widgetOptions' => array(
                                    'data' => CHtml::listData(Monitor::model()->findAll(),'id','modelo','marca'),
                                    'htmlOptions'=>array('prompt'=>'Seleccione Proyecto')
                                )
                            )
                        );  ?>
                    </div>


                </div>
            </div>
        </div>
        <!-- FIN INFORMACION EQUIPO-->


        <!-- IMPRESORAS-->

        <div class="panel panel-default">

            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                        Impresora
                    </a>
                </h4>
            </div>

            <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body">

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($impresora, 'puerto',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($impresora, 'pdfcmon',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($impresora, 'usb001',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($impresora, 'ip',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>


                </div>
            </div>
        </div>
        <!-- FIN IMPRESORAS-->

        <!-- IMPRESORAS-->

        <div class="panel panel-default">

            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                        Sistema Operativo
                    </a>
                </h4>
            </div>

            <div id="collapse5" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="col-md-6">
                        <?php echo  $form->dropDownListGroup(
                            $model,
                            'sistema_operativo_id',
                            array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-5',
                                ),
                                'widgetOptions' => array(
                                    'data' => CHtml::listData(SistemaOperativo::model()->findAll(),'id','version'),
                                    'htmlOptions'=>array('prompt'=>'Seleccione Sistema Opertivo')
                                )
                            )
                        );  ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN IMPRESORAS-->

        <!-- FOTO-->
        <?php if($model->localidad->proyecto->configuracions[0]->foto == 1):?>
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                        Fotos
                    </a>
                </h4>
            </div>

            <div id="collapse6" class="panel-collapse collapse">
                <div class="panel-body">

                    <div class="row col-sm-6 col-md-4">
                        <div class="page-header">
                            <h1>Antes</h1>
                        </div>

                        <p>suba las fotos del equipo antes de ser intervenido</p>
                    </div>
                    <div class="row col-sm-6 col-md-8" >
                        <div class="col-sm-6 col-md-4">
                            <div id='thumb-1' class="thumbnail">
                                <?php if($foto->antes_1 != null || $foto->antes_1 != ''){ ?>
                                    <img id="img-antes-1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->antes_1; ?>" />
                                <?php }else{ ?>
                                    <img id="img-antes-1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                                <?php } ?>

                                <div class="caption">
                                    <?php  $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                            array(
                                                'id'=>'antes_1',
                                                'config'=>array(
                                                    'action'=>Yii::app()->createUrl('checklist/uploadFoto',array('id'=>$model->id,'filename'=>'antes_1')),
                                                    'allowedExtensions'=>array("jpg","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                    'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                                    'onComplete'=>"js:function(id, fileName, data ){
                                                  //  $('#img-antes-1').remove();
                                                  //  $('#thumb-1').prepend('<img id=\"img-antes-1\" src=\"".Yii::app()->request->baseUrl."/images/checklist/images/checklist_".$model->id."/'+data.filename+'\" />');
                                                   $('#img-antes-1').replaceWith('<img id=\"img-antes-1\" src=\"".Yii::app()->request->baseUrl."/images/checklist/images/checklist_".$model->id."/'+data.filename+'\" />');

                                                    }",
                                                )
                                            )); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <?php if($foto->antes_2 != null || $foto->antes_2 != ''){ ?>
                                    <img id="img-antes-2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->antes_2; ?>" />
                                <?php }else{ ?>
                                    <img id="img-antes-2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                                <?php } ?>
                                <div class="caption">
                                    <?php  $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                            'id'=>'antes_2',
                                            'config'=>array(
                                                'action'=>Yii::app()->createUrl('checklist/uploadFoto',array('id'=>$model->id,'filename'=>'antes_2')),
                                                'allowedExtensions'=>array("jpg","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                                'onComplete'=>"js:function(id, fileName, data ){
                                                        $('#img-antes-2').replaceWith('<img id=\"img-antes-2\" src=\"".Yii::app()->request->baseUrl."/images/checklist/images/checklist_".$model->id."/'+data.filename+'\" />');

                                                    }",
                                            )
                                        )); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <?php if($foto->antes_3 != null || $foto->antes_3 != ''){ ?>
                                    <img id="img-antes-3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->antes_3; ?>" />
                                <?php }else{ ?>
                                    <img id="img-antes-3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                                <?php } ?>
                                <div class="caption">
                                    <?php  $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                            'id'=>'antes_3',
                                            'config'=>array(
                                                'action'=>Yii::app()->createUrl('checklist/uploadFoto',array('id'=>$model->id,'filename'=>'antes_3')),
                                                'allowedExtensions'=>array("jpg","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                                'onComplete'=>"js:function(id, fileName, data ){
                                                        $('#img-antes-3').replaceWith('<img id=\"img-antes-3\" src=\"".Yii::app()->request->baseUrl."/images/checklist/images/checklist_".$model->id."/'+data.filename+'\" />');

                                                    }",
                                            )
                                        )); ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row col-sm-6 col-md-4">
                        <div class="page-header">
                            <h1>Despues</h1>
                        </div>

                        <p>suba las fotos del equipo despues de ser intervenido</p>
                    </div>
                    <div class="row col-sm-6 col-md-8" >
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <?php if($foto->despues_1 != null || $foto->despues_1 != ''){ ?>
                                    <img id="img-despues-1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->despues_1; ?>" />
                                <?php }else{ ?>
                                    <img id="img-despues-1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                                <?php } ?>
                                <div class="caption">
                                    <?php  $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                            'id'=>'despues_1',
                                            'config'=>array(
                                                'action'=>Yii::app()->createUrl('checklist/uploadFoto',array('id'=>$model->id,'filename'=>'despues_1')),
                                                'allowedExtensions'=>array("jpg","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                                'onComplete'=>"js:function(id, fileName, data ){
                                                        $('#img-despues-1').replaceWith('<img id=\"img-despues-1\" src=\"".Yii::app()->request->baseUrl."/images/checklist/images/checklist_".$model->id."/'+data.filename+'\" />');

                                                    }",
                                            )
                                        )); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <?php if($foto->despues_2 != null || $foto->despues_2 != ''){ ?>
                                    <img id="img-despues-2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->despues_2; ?>" />
                                <?php }else{ ?>
                                    <img id="img-despues-2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                                <?php } ?>
                                <div class="caption">
                                    <?php  $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                            'id'=>'despues_2',
                                            'config'=>array(
                                                'action'=>Yii::app()->createUrl('checklist/uploadFoto',array('id'=>$model->id,'filename'=>'despues_2')),
                                                'allowedExtensions'=>array("jpg","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                                'onComplete'=>"js:function(id, fileName, data ){
                                                        $('#img-despues-2').replaceWith('<img id=\"img-despues-2\" src=\"".Yii::app()->request->baseUrl."/images/checklist/images/checklist_".$model->id."/'+data.filename+'\" />');

                                                    }",
                                            )
                                        )); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <?php if($foto->despues_3 != null || $foto->despues_3 != ''){ ?>
                                    <img id="img-despues-3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->despues_3; ?>" />
                                <?php }else{ ?>
                                    <img id="img-despues-3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                                <?php } ?>
                                <div class="caption">
                                    <?php  $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                        array(
                                            'id'=>'despues_3',
                                            'config'=>array(
                                                'action'=>Yii::app()->createUrl('checklist/uploadFoto',array('id'=>$model->id,'filename'=>'despues_3')),
                                                'allowedExtensions'=>array("jpg","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                                'onComplete'=>"js:function(id, fileName, data ){
                                                        $('#img-despues-3').replaceWith('<img id=\"img-despues-3\" src=\"".Yii::app()->request->baseUrl."/images/checklist/images/checklist_".$model->id."/'+data.filename+'\" />');

                                                    }",
                                            )
                                        )); ?>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- FIN FOTO-->

        <!-- CONFIGURACION RED-->
        <?php if($model->localidad->proyecto->configuracions[0]->configuracion_red == 1):?>
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                        Configuracion Red
                    </a>
                </h4>
            </div>

            <div id="collapse7" class="panel-collapse collapse">
                <div class="panel-body">

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($configuracionRed, 'usuario',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($configuracionRed, 'dominio',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($configuracionRed, 'nombre_maquina',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($configuracionRed, 'red',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($configuracionRed, 'tipo',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($configuracionRed, 'mascara',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($configuracionRed, 'puerto_enlace',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($configuracionRed, 'dns_preferencial',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($configuracionRed, 'dns_alternativo',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>


                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- FIN CONFIGURACION RED-->

        <!-- MIGRACION-->
        <?php if($model->localidad->proyecto->configuracions[0]->migracion == 1):?>
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                        Migracion
                    </a>
                </h4>
            </div>

            <div id="collapse8" class="panel-collapse collapse">
                <div class="panel-body">

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($migracion, 'ram_antes',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($migracion, 'disco_antes',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>


                    <div class="col-md-6">
                        <?php echo  $form->dropDownListGroup(
                            $migracion,
                            'cpu_id_antes',
                            array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-5',
                                ),
                                'widgetOptions' => array(
                                    'data' => CHtml::listData(Cpu::model()->findAll(),'id','procesador','marca'),
                                    'htmlOptions'=>array('prompt'=>'Seleccione Cpu')
                                )
                            )
                        );  ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo  $form->dropDownListGroup(
                            $migracion,
                            'monitor_id_antes',
                            array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-5',
                                ),
                                'widgetOptions' => array(
                                    'data' => CHtml::listData(Monitor::model()->findAll(),'id','modelo','marca'),
                                    'htmlOptions'=>array('prompt'=>'Seleccione Monitor')
                                )
                            )
                        );  ?>
                    </div>





                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($migracion, 'ram_despues',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo $form->textFieldGroup($migracion, 'disco_despues',
                            array(
                                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                            )
                        ); ?>
                    </div>


                    <div class="col-md-6">
                        <?php echo  $form->dropDownListGroup(
                            $migracion,
                            'cpu_id_despues',
                            array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-5',
                                ),
                                'widgetOptions' => array(
                                    'data' => CHtml::listData(Cpu::model()->findAll(),'id','procesador','marca'),
                                    'htmlOptions'=>array('prompt'=>'Seleccione Cpu')
                                )
                            )
                        );  ?>
                    </div>

                    <div class="col-md-6">
                        <?php echo  $form->dropDownListGroup(
                            $migracion,
                            'monitor_id_despues',
                            array(
                                'wrapperHtmlOptions' => array(
                                    'class' => 'col-sm-5',
                                ),
                                'widgetOptions' => array(
                                    'data' => CHtml::listData(Monitor::model()->findAll(),'id','modelo','marca'),
                                    'htmlOptions'=>array('prompt'=>'Seleccione Monitor')
                                )
                            )
                        );  ?>
                    </div>


                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- FIN MIGRACION-->

    <?php } ?>

    <!-- TAREAS-->

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                    Tareas
                </a>
            </h4>
        </div>

        <div id="collapse9" class="panel-collapse collapse">
            <div class="panel-body">

                <?php foreach($tareas as $ta){?>
                <div class="col-md-12">

                    <div class="col-md-4">
                        <div class="form-group btn-primary" style="padding-left: 10px">
                            <label class="control-label" style="width: 100%">Tarea:</label>
                            <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $ta->tarea->nombre; ?></label>
                        </div>
                    </div>

                    <div class="col-md-4">
                    <?php echo  $form->dropDownListGroup(
                        $ta,
                        '['.$ta->tarea_id.']estado_id',
                        array(
                            'wrapperHtmlOptions' => array(
                                'class' => 'col-sm-5',
                            ),
                            'widgetOptions' => array(
                                'data' => CHtml::listData(Estado::model()->findAll(),'id','nombre'),
                                'htmlOptions'=>array('prompt'=>'Seleccione Estado')
                            )
                        )
                    );  ?>
                    </div>

                    <?php

                    $this->widget(
                        'booster.widgets.TbButton',
                        array(
                            'label' => '?',
                            //'context' => 'warning',
                            'htmlOptions' => array(
                                'data-title' => 'Descripción',
                                'data-placement' => 'right',
                                'data-content' => $ta->tarea->descripcion,
                                'data-toggle' => 'popover',
                                'data-html'=>true
                            ),
                        )
                    );

                    ?>

                </div>
               <?php }?>

            </div>
        </div>
    </div>
    <!-- FIN TAREAS-->


    <!-- OBSERVACION -->

    <div class="panel panel-default">

        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                    Observacion
                </a>
            </h4>
        </div>

        <div id="collapse10" class="panel-collapse collapse">
            <div class="panel-body">
                    <?php echo $form->textAreaGroup(
                        $model,
                        'observacion',
                        array(
                            'wrapperHtmlOptions' => array(
                                'class' => 'col-sm-5',
                            ),
                            'widgetOptions' => array(
                                'htmlOptions' => array('rows' => 5),
                            )
                        )
                    ); ?>
            </div>
        </div>
    </div>

    <!-- FIN OBSERVACION -->

    </div>

<?php $this->endWidget(); ?>


<div class="form-actions col-md-12" >
    <?php $this->widget(
        'booster.widgets.TbButton',
        array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => 'Guardar'
        )
    ); ?>
    <?php echo CHtml::link('Cancelar',array('checklist/admin','id'=>$model->localidad_id),array('class'=>'btn btn-danger')); ?>
</div>


<?php
    $this->endWidget();
    unset($form);
?>


