

<div class="jefeProyecto col-md-12">


    <input type="hidden" class="val<?php echo $tipo?>" value="<?php echo $i?>">

    <div class="col-md-3">
        <?php echo $form->textFieldGroup($jefeProyecto, 'nombre',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                'widgetOptions' => array(
                    'htmlOptions'=>array('name'=> $tipo.'[JefeProyecto]['.$i.'][nombre]')
                )

            )
        ); ?>
    </div>


    <div class="col-md-3">
        <?php echo $form->textFieldGroup($jefeProyecto, 'email',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                'widgetOptions' => array(
                    'htmlOptions'=>array('name'=>$tipo.'[JefeProyecto]['.$i.'][email]')
                )

            )
        ); ?>
    </div>


    <div class="col-md-3">
        <?php echo $form->textFieldGroup($jefeProyecto, 'telefono',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                'widgetOptions' => array(
                    'htmlOptions'=>array('name'=>$tipo.'[JefeProyecto]['.$i.'][telefono]','placeholder'=>'Ej: +569 587 99 122')
                )

            )
        ); ?>
    </div>

    <?php echo $form->hiddenField($jefeProyecto, 'id',array('name'=>$tipo.'[JefeProyecto]['.$i.'][id]')); ?>

    <?php if($i > 0){?>
        <div class="col-md-3">
            <?php echo CHtml::link('eliminar','',array('style'=>'margin-top:25px;','class'=>'btn btn-danger','onclick'=>'$(this).parents(".jefeProyecto").remove()')); ?>
        </div>
    <?php }?>

</div>