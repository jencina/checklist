
<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'cliente-form',
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well')
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
        <?php echo $form->textFieldGroup(
            $model,
            'precio',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'prepend' => '$'
            )
        ); ?>
    </div>
        </div>
    <div class="col-md-12">
    <div class="col-md-6">
        <?php echo $form->textFieldGroup(
            $model,
            'costo',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'prepend' => '$'
            )
        ); ?>
    </div>

    <div class="col-md-6">
        <?php echo $form->textFieldGroup(
            $model,
            'utop',
            array(
                'wrapperHtmlOptions' => array(
                    'class'    => 'col-sm-5'
                ),
                'widgetOptions' => array(
                    'htmlOptions' => array('readonly' => true)
                ),
                'prepend' => '%'
            )
        ); ?>
    </div>
        </div>

    <div class="col-md-12">
    <div class="col-md-6">
        <?php echo $form->textFieldGroup($model, 'tiempo',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
            )
        ); ?>
    </div>
        </div>

    <div class="col-md-12">
    <?php echo $form->html5EditorGroup(
        $model,
        'descripcion',
        array(
            'widgetOptions' => array(
                'editorOptions' => array(
                    'class' => 'span4',
                    'rows' => 5,
                    'height' => '200',
                    'options' => array('color' => true)
                ),
            ),
            'wrapperHtmlOptions' => array(
            'class'    => 'col-md-12'
        ),
        )
    ); ?>
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
        <?php echo CHtml::link('Cancelar',array('tarea/admin'),array('class'=>'btn btn-danger')); ?>
    </div>

</fieldset>

<?php $this->endWidget();
unset($form);
?>

<script>

    function calcular(){
        var precio = $('#Tarea_precio').val();
        var costo  = $('#Tarea_costo').val();

        var itop   =   precio-costo;
        $('#Tarea_utop').val(itop);
    }

    $(document).ready(function(){

        $('#Tarea_precio').keyup(function(){
            calcular();
        });

        $('#Tarea_costo').keyup(function(){
            calcular();
        });

    });

    </script>