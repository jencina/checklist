
<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'departamento-form',
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well')
    )
); ?>

<fieldset>

    <?php echo $form->textFieldGroup($model, 'nombre',
        array(
            'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
        )
    ); ?>

    <div class="form-actions col-md-12" >
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Guardar'
            )
        ); ?>
        <?php echo CHtml::link('Cancelar',array('departamento/admin'),array('class'=>'btn btn-danger')); ?>
    </div>

</fieldset>

<?php $this->endWidget();
unset($form);
?>