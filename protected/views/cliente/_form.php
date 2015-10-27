
<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'cliente-form',
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well')
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
        <?php echo $form->textFieldGroup($model, 'telefono',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo  $form->dropDownListGroup(
            $model,
            'region_id',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'widgetOptions' => array(
                    'data' => CHtml::listData(Region::model()->findAll(),'id', 'nombre'),
                    'htmlOptions'=>array('prompt'=>'Seleccione Region')
                )
            )
        );  ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->dropDownListGroup(
            $model,
            'comuna_id',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'widgetOptions' => array(
                    'data' => CHtml::listData(Comuna::model()->findAllByAttributes(array('region_id'=>$model->region_id),array("select"=>"nombre,id")),'id', 'nombre'),
                    'htmlOptions'=>array('prompt'=>'Seleccione Comuna')
                )
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'direccion',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
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
        <?php echo CHtml::link('Cancelar',array('cliente/admin'),array('class'=>'btn btn-danger')); ?>
    </div>

</fieldset>

<?php $this->endWidget();
unset($form);
?>


<script>
    $(document).ready(function(){

        $('#Cliente_region_id').change(function(){

            $.ajax({
                url  : "<?php echo Yii::app()->createURL('cliente/setComuna');?>",
                type : 'post',
                cache: false ,
                data : { id: $(this).val() },
                success: function(data){
                    $('#Cliente_comuna_id').html(data.comuna);
                }
            });

            return false;
        });

    });
</script>