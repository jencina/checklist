<?php
$usuario = Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre;

$form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'usuario-form',
        'action'=>$action,
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data')
    )
); ?>

<fieldset>

    <div class="col-md-12">

        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'nombre',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>

        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'apellido',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>

    </div>

    <div class="col-md-12">

        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'usuario',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>

        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'password',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>

    </div>


    <div class="col-md-12">

        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'email',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>

        <div class="col-md-6">
            <?php echo $form->dropDownListGroup(
                $model,
                'tipo_usuario_id',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                    'widgetOptions' => array(
                        'data' => CHtml::listData(($usuario == 'super_admin')?TipoUsuario::model()->findAll(array('condition'=>'nombre IN("admin","super_admin")')):TipoUsuario::model()->findAll(array('condition'=>'nombre <> "super_admin"')),'id', 'nombre'),
                        'htmlOptions'=>array('prompt'=>'Seleccione Tipo')
                    )
                )
            );  ?>
        </div>

    </div>

    <?php
    if(isset($model->tipoUsuario->nombre)){
    if($model->tipoUsuario->nombre != 'super_admin' && Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre == 'super_admin'){ ?>
    <div class="col-md-6">
        <?php echo $form->dropDownListGroup(
            $model,
            'empresa_id',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'widgetOptions' => array(
                    'data' => CHtml::listData(Empresa::model()->findAll(),'id', 'nombre'),
                    'htmlOptions'=>array('prompt'=>'Seleccione Empresa')
                )
            )
        );  ?>
    </div>
    <?php }elseif($model->tipoUsuario->nombre == 'cliente'){ ?>
        <div class="col-md-6">
            <?php echo $form->dropDownListGroup(
                $model,
                'empresa_id_cliente',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                    'widgetOptions' => array(
                        'data' => CHtml::listData(Empresa::model()->findAllByAttributes(array('empresa_id'=>Yii::app()->user->empresa)),'id', 'nombre'),
                        'htmlOptions'=>array('prompt'=>'Seleccione Empresa')
                    )
                )
            );  ?>
        </div>
    <?php
       }
    }
    ?>

    <div id="user-tecnico">
        <?php if($model->tipo_usuario_id == 3){ ?>

        <div class="col-md-12">

            <div class="col-md-6">
                <?php echo $form->textFieldGroup($tecnico, 'rut',
                    array(
                        'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                    )
                ); ?>
            </div>

            <div class="col-md-6">
                <?php  echo $form->datePickerGroup(
                    $tecnico,
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
                ); ?>
            </div>
        </div>

        <div class="col-md-12">

            <div class="col-md-6">
                <?php  echo $form->datePickerGroup(
                    $tecnico,
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
                <?php echo $form->textFieldGroup($tecnico, 'telefono_fijo',
                    array(
                        'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                    )
                ); ?>
            </div>
        </div>

        <div class="col-md-12">

            <div class="col-md-6">
                <?php echo $form->textFieldGroup($tecnico, 'telefono_celular',
                    array(
                        'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                    )
                ); ?>
            </div>

            <div class="col-md-6">
                <?php echo $form->textFieldGroup($tecnico, 'direccion',
                    array(
                        'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                    )
                ); ?>
            </div>

        </div>

        <div class="col-md-12">

            <div class="col-md-6">
                <?php echo $form->fileFieldGroup($tecnico, 'contrato_adjunto',
                    array(
                        'wrapperHtmlOptions' => array(
                            'class' => 'col-sm-5',
                        ),
                    )
                ); ?>
            </div>

            <div class="col-md-6">
                <?php echo  $form->dropDownListGroup(
                    $tecnico,
                    'tipo_contrato_id',
                    array(
                        'wrapperHtmlOptions' => array(
                            'class' => 'col-sm-5',
                        ),
                        'widgetOptions' => array(
                            'data' => CHtml::listData(TipoContrato::model()->findAll(),'id', 'nombre'),
                            'htmlOptions'=>array('prompt'=>'Seleccione Contrato')
                        )
                    )
                );  ?>
            </div>

         </div>

         <?php if(isset($tecnico->contrato_adjunto)){?>
         <div class="col-md-12">
             <div class="col-md-6">
               <?php echo $tecnico->contrato_adjunto.CHtml::link('Descargar',Yii::app()->request->baseUrl.'/images/'.$tecnico->contrato_adjunto,array('target'=>'_blanc','class'=>'btn btn-primary','style'=>'width: 48%;'));; ?>
             </div>
         </div>
        <?php } }?>

    </div>


    <div class="form-actions col-md-12" >
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'context' => 'primary',
                'label' => 'Guardar'
            )
        ); ?>
        <?php echo CHtml::link('Cancelar',array('usuario/admin'),array('class'=>'btn btn-danger')); ?>
    </div>

</fieldset>

<?php
$this->endWidget();
unset($form);
?>

<script>

    $('#Usuario_tipo_usuario_id').change(function(){

      //  if($(this).val() == 3 || $(this).val() == 2){

            var data=$("#usuario-form").serialize();

            $.ajax({
                url  : "<?php echo Yii::app()->createURL('usuario/setTecnico');?>",
                type : 'post',
                cache: false ,
                data : data,
                success: function(data){
                    $('#usuario-form').replaceWith(data.div);
                }
            });

            return false;

        /*  }else{
            $('#user-tecnico').html('');
        }*/

    });


</script>

