<?php echo CHtml::link('<i class="fa fa-arrow-circle-left"></i>','',array('onclick'=>'calendar();','class'=>'db-left'));?>
<?php echo CHtml::link('<i class="fa fa-arrow-circle-right"></i>','',array('onclick'=>'generar();','class'=>'db-right'));?>

<?php

    $box = $this->beginWidget(
        'booster.widgets.TbPanel',
        array(
            'title' => 'Proyectos',
            'id'=>'db-empresas',
            'context' => 'success',
            'headerIcon' => 'th-list',
            'padContent' => false,
            'htmlOptions' => array('class' => 'db')
        )
    );


    foreach($proyectos as $proyecto){ ?>

        <div class="col-md-12 proyecto" style="float: none">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="<?php echo $proyecto->id?>">
                <?php echo $proyecto->nombre?></div>
            </label>
        </div>

    <?php }

    if(count($proyectos) == 0){
        echo '<p>No se encontraron resultados...</p>';
    }

   $this->endWidget(); ?>


<script>

    $(document).ready(function(){

        $('.proyecto input').click(function(){

            var $box = $(this);

            if ($box.is(":checked")) {

                $('#proyecto .db-right').show('slow');

            } else {

                var activo = false;
                $('.proyecto input').each(function(){
                    if($(this).is(":checked")){
                        activo = true;
                    }
                });

                if(activo == false){
                    $('#proyecto .db-right').hide('slow');
                }

            }

        });

    });


</script>