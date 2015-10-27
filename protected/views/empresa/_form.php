<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'empresa-form',
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data')
    )
); ?>


<fieldset>

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
            <?php echo $form->fileFieldGroup($model, 'logo',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                )
            ); ?>
        </div>

        <?php

        if(!empty($model->logo)) {
            echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->logo, 'logo', array('width' => 100, 'height' => 100));
        }
        ?>


    <?php }?>


    <div class="form-actions col-md-12" >
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'context' => 'primary',
                'label' => 'Guardar'
            )
        ); ?>
        <?php echo CHtml::link('Cancelar',array('empresa/admin'),array('class'=>'btn btn-danger')); ?>
    </div>

</fieldset>

<?php $this->endWidget();
unset($form);
?>