

<div class="localidad col-md-12">


    <input type="hidden" class="val" value="<?php echo $i?>">

    <div class="col-md-3">
        <?php echo  $form->dropDownListGroup(
            $localidad,
            'region_id',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'widgetOptions' => array(
                    'data' => CHtml::listData(Region::model()->findAll(),'id', 'nombre'),
                    'htmlOptions'=>array('class'=>'region','name'=>'Localidad['.$i.'][region_id]','prompt'=>'Seleccione Region')
                )
            )
        );  ?>
    </div>


    <div class="col-md-3">
        <?php echo $form->dropDownListGroup(
            $localidad,
            'comuna_id',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-5',
                ),
                'widgetOptions' => array(
                    'data' => CHtml::listData(Comuna::model()->findAllByAttributes(array('region_id'=>$localidad->region_id),array("select"=>"nombre,id")),'id', 'nombre'),
                    'htmlOptions'=>array('class'=>'comuna','name'=>'Localidad['.$i.'][comuna_id]','prompt'=>'Seleccione Comuna')
                )
            )
        ); ?>
    </div>


    <div class="col-md-3">
        <?php echo $form->textFieldGroup($localidad, 'direccion',
            array(
                'wrapperHtmlOptions' => array('class' => 'col-sm-5'),
                'widgetOptions' => array(
                    'htmlOptions'=>array('name'=>'Localidad['.$i.'][direccion]')
                )

            )
        ); ?>
    </div>

    <?php echo $form->hiddenField($localidad, 'id',array('name'=>'Localidad['.$i.'][id]')); ?>

    <?php if($i > 0){?>
    <div class="col-md-3">
        <?php echo CHtml::link('eliminar','',array('style'=>'margin-top:25px;','class'=>'btn btn-danger','onclick'=>'$(this).parents(".localidad").remove()')); ?>
    </div>
    <?php }?>

</div>

<script>
  $(document).ready(function(){

      $('#<?php echo "Localidad_".$i."_region_id"; ?>').change(function(){

          $.ajax({
              url  : "<?php echo Yii::app()->createURL('proyecto/setComuna');?>",
              type : 'post',
              cache: false ,
              data : { id: $(this).val() },
              success: function(data){
                 $('#<?php echo "Localidad_".$i."_comuna_id"; ?>').html(data.comuna);
              }
          });

          return false;
      });

  });
    </script>