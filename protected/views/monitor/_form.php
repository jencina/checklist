<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'cpu-form',
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well')
    )
); ?>

<fieldset>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'marca',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'modelo',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'serie',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'etiqueta',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
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
        <?php echo CHtml::link('Cancelar',array('monitor/admin'),array('class'=>'btn btn-danger')); ?>
    </div>

</fieldset>

<?php $this->endWidget();
unset($form);
?>