
<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'mail-form',
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well')
    )
); ?>

<fieldset>


    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'email',
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

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'dias',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'smtp',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'puerto',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'from',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'subject',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'address',
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
        <?php echo CHtml::link('Cancelar',array('email/index'),array('class'=>'btn btn-danger')); ?>
    </div>

</fieldset>

<?php $this->endWidget();
unset($form);
?>