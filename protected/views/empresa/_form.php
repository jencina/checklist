<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'empresa-form',
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
            <?php echo $form->textFieldGroup($model, 'razon_social',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'rut',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>

        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'direccion_comercial',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'contacto_facturacion',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>

        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'telefono_fijo',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                    'widgetOptions' => array(
                        'htmlOptions'=>array('placeholder'=>'Ej: +562 287 99 122')
                    )
                )
            ); ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'telefono_celular',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                    'widgetOptions' => array(
                        'htmlOptions'=>array('placeholder'=>'Ej: +569 587 99 122')
                    )
                )
            ); ?>
        </div>

        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'email_contacto',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'contacto_administracion',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                )
            ); ?>
        </div>

        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'telefono_administracion',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                    'widgetOptions' => array(
                        'htmlOptions'=>array('placeholder'=>'Ej: +562 287 99 122')
                    )
                )
            ); ?>
        </div>
    </div>


    <div class="col-md-12">
        <div class="col-md-6">
            <?php echo $form->textFieldGroup($model, 'pais_prestacion_servicios',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                    'widgetOptions' => array(
                        'htmlOptions'=>array('placeholder'=>'Ej: Chile')
                    )
                )
            ); ?>
        </div>

    <?php if(Yii::app()->user->tipo_usuario == 'super_admin'){?>
        <div class="col-md-6">
            <?php

            echo $form->dropDownListGroup(
                $model,
                'logo_tipo_id',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                    'widgetOptions' => array(
                        'data' => CHtml::listData(LogoTipo::model()->findAll(),'id', 'tipo'),
                        'htmlOptions'=>array('prompt'=>'Seleccione Tipo Logo')
                    )
                )
            );  ?>
        </div>
    <?php } ?>
    </div>

    <?php if(Yii::app()->user->tipo_usuario == 'super_admin'){?>

        <div id="logo-texto"class="col-md-6" style="display: none">
            <?php echo $form->fileFieldGroup($model, 'logo',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                )
            ); ?>
        </div>

        <div id="logo-imagen" class="col-md-6" style="display: none">
            <?php echo $form->textFieldGroup($model, 'logo',
                array(
                    'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                    'widgetOptions' => array(
                        //'htmlOptions'=>array('placeholder'=>'Ej: Chile')
                    )
                )
            ); ?>
        </div>

        <?php

        if(!empty($model->logo) && $model->logo_tipo_id == 1) {
            echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->logo, 'logo', array('width' => 100, 'height' => 100));
        }
        ?>

     <script>

       if('<?php echo $model->logo_tipo_id;?>' == 1){
             $('#logo-imagen').hide();
             $('#logo-texto').show();

       }else if('<?php echo $model->logo_tipo_id;?>' == 2){
             $('#logo-texto').hide();
             $('#logo-imagen').show();
       }

       $('#Empresa_logo_tipo_id').change(function(){
           if($(this).val() == 1){
             $('#logo-imagen').hide();
             $('#logo-texto').show();
           }else if($(this).val() == 2){
             $('#logo-texto').hide();
             $('#logo-imagen').show();
           }

       });
     </script>

    <?php }?>


    <div class="form-actions col-md-12" >
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Guardar'
            )
        ); ?>
        <?php echo CHtml::link('Cancelar',array('empresa/admin'),array('class'=>'btn btn-danger')); ?>
    </div>

</fieldset>

<?php $this->endWidget();
unset($form);
?>