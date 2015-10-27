<?php $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'addTarea-form',
        'type' => 'horizontal',
        'htmlOptions' => array('class' => 'well')
    )
); ?>

    <fieldset>

        <div class="col-md-6">
            <?php echo $form->dropDownListGroup(
                $tarea,
                'tarea_id',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-5',
                    ),
                    'widgetOptions' => array(
                        'data' => CHtml::listData(Tarea::model()->findAll(),'id', 'nombre'),
                        'htmlOptions'=>array('prompt'=>'Seleccione Tarea')
                    )
                )
            ); ?>
        </div>

        <div class="form-actions col-md-6" >
            <?php $this->widget(
                'booster.widgets.TbButton',
                array(
                    'buttonType' => 'submit',
                    'context' => 'primary',
                    'label' => 'Guardar'
                )
            ); ?>
        </div>

    </fieldset>
    <script>
        $(document).ready(function(){

            $('#addTarea-form').submit(function(){

                $.ajax({
                    url  : "<?php echo Yii::app()->createURL('configuracion/addTarea',array('id'=>$id));?>",
                    type : 'post',
                    cache: false ,
                    data : $(this).serialize(),
                    success: function(data){
                        if(data.status == 'success'){

                            $('#addTarea-form').replaceWith(data.div);
                            $.fn.yiiGridView.update('grid-add');

                        }else{

                            $('#addTarea-form').replaceWith(data.div);
                        }

                    }
                });

                return false;

            });

        });
    </script>


<?php $this->endWidget();
unset($form);
?>