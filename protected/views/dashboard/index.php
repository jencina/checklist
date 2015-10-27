<ul class="breadcrumb">
    <li class="active">Checklist</li>
    <li class="active"></li>
</ul>

<?php $baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/protected/extensions/booster/assets/highcharts/highcharts.js');?>

<div class="page-header">
    <h1>Dashboards</h1>
</div>

<div id="empresa" class="col-md-4 db" style="position:relative;">

    <?php

    $box = $this->beginWidget(
        'booster.widgets.TbPanel',
        array(
            'title' => 'Empresas',
            'id'=>'db-empresas',
            'context' => 'info',
            'headerIcon' => 'fa fa-building',
            'padContent' => false,
            'htmlOptions' => array('class' => 'db')
        )
    );

    foreach($empresas as $empresa){ ?>

        <div class="col-md-12 empresa" style="float: none">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="<?php echo $empresa->id?>">
                <?php echo $empresa->nombre?></div>
                </label>
            </div>

    <?php } $this->endWidget(); ?>

    <?php echo CHtml::link('<i class="fa fa-arrow-circle-right"></i>','',array('onclick'=>'calendar();','class'=>'db-right'));?>

</div>

<div id="fecha" class="col-md-4" style="display: none">
    <?php echo CHtml::link('<i class="fa fa-arrow-circle-left"></i>','',array('onclick'=>'empresa();','class'=>'db-left'));?>
    <?php echo CHtml::link('<i class="fa fa-arrow-circle-right"></i>','',array('onclick'=>'proyecto();','class'=>'db-right'));?>
    <?php

    $box = $this->beginWidget(
        'booster.widgets.TbPanel',
        array(
            'title' => 'Rango Fecha',
            'id'=>'db-fechas',
            'context' => 'warning',
            'headerIcon' => 'fa fa-calendar',
            'padContent' => false,
            'htmlOptions' => array('class' => 'bootstrap-widget-table')
        )
    ); ?>

    <div class="col-md-12 empresa" style="float: none;margin: 10px 0">

        <?php

        echo '<p>desde :</p>';

        $this->widget(
            'booster.widgets.TbDatePicker',
            array(
                'name' => 'desde',
                'options' => array(
                    'format'=>'yyyy-mm-dd',
                    'language' => 'es',
                    'autoclose'=> true,
                    'showButtonPanel'=>true,

                ),
                'htmlOptions' => array('class'=>'calendar form-control','style'=>'min-width:100%;'),
            )
        ); ?>

    </div>

    <div class="col-md-12 empresa" style="float: none;margin: 10px 0;">

        <?php echo '<p>hasta :</p>';

        $this->widget(
            'booster.widgets.TbDatePicker',
            array(
                'name' => 'hasta',
                'options' => array(
                    'format'=>'yyyy-mm-dd',
                    'language' => 'es',
                    'autoclose'=> true,
                    'showButtonPanel'=>true,
                    'onClose'=>'js:function(dateText, inst){
                alert("asd");

                }',
                ),

                'htmlOptions' => array('class'=>'calendar form-control','style'=>'min-width:100%;'),
            )
        ); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>

<div id="proyecto" class="col-md-4 db">


</div>



<!--
    <div id="generar" class="col-md-3 db" style="display: none">

    <?php  echo CHtml::link('Generar Grafico','',array('class'=>'btn btn-primary','onclick'=>'')); ?>

    </div>
-->

    <div id="graficos" class="col-md-12">
    </div>


<script>

    function calendar(){

        $('#desde').attr('disabled',false);
        $('#hasta').attr('disabled',false);

        $('#desde').val('');
        $('#hasta').val('');

        $('#fecha').show("slow");
        $('#proyecto').hide("slow");

        $('#empresa .db-right').hide('slow');
        $('#fecha .db-left').show('slow');

    }

    function empresa(){
        $('#proyecto').hide("slow");
        $('#fecha').hide("slow");
        $('#empresa .db-right').show('slow');

    }

    function proyecto(){

        var group = ".empresa input:checked";
        var id = $(group).val();

        var desde = $('#desde').val();
        var hasta = $('#hasta').val();


        if(desde > hasta){
            //bootbox.alert('Fecha "desde" no debe ser mayor a fecha "hasta".');
            $("#hasta").notify('Fecha "desde" no debe ser mayor a fecha "hasta".');
        }else{
            $('#fecha .db-left').hide('slow');
            $('#fecha .db-right').hide('slow');

            $('#desde').attr('disabled',true);
            $('#hasta').attr('disabled',true);

            $.ajax({
                url  : "<?php echo Yii::app()->createURL('dashboard/setProyectos');?>",
                type : 'post',
                cache: false ,
                data : {desde:desde,hasta:hasta,id:id},
                befereSend: function(){
                    $('#proyecto').html('cargando...');
                },
                success: function(data){
                    $('#proyecto').html(data.div);
                    $('#proyecto').show('slow');

                },
                complete: function(){
                    $('#proyecto .db-left').show('slow');

                }
            });
        }
    }

    function generar(){


        var list = [];

        $('.proyecto input').each(function(){
            var val = $(this);

            if(val.is(":checked")){
                list.push(val.val());
            }

        });

        $.ajax({
            url  : "<?php echo Yii::app()->createURL('dashboard/createGrafic');?>",
            type : 'post',
            cache: false ,
            data : {proyectos:list},
            befereSend: function(){
                //$(document).highcharts().destroy();
                $('#graficos').html('cargando...');
            },
            success: function(data){
                $('#graficos').html(data.div);
            }
        });


    }

    $(document).ready(function(){

        $('#db-fechas input.calendar').change(function(){

            var desde = $('#desde').val();
            var hasta = $('#hasta').val();

            if(desde != '' && hasta != ''){

                $('#fecha .db-right').show('slow');
            }
        });

        $('.empresa input').click(function(){

            var id = $(this).val();

            var $box = $(this);
            if ($box.is(":checked")) {

                $('#fecha').hide("slow");
                $('#proyecto').hide("slow");

                var group = ".empresa input:checkbox";

                $(group).prop("checked", false);

                $box.prop("checked", true);

                $('#empresa .db-right').show('slow');

            } else {
                $box.prop("checked", false);

                var activo = false;
                $('.empresa input').each(function(){
                    if($(this).is(":checked")){
                        activo = true;
                    }
                });

                if(activo == false){
                    $('#fecha').hide("slow");
                    $('#proyecto').hide("slow");
                    $('#empresa .db-right').hide('slow');
                }

            }
        });


        /*$('.empresa input').click(function(){

            var id = $(this).val();

            var $box = $(this);
            if ($box.is(":checked")) {

                var group = ".empresa input:checkbox";

                $(group).prop("checked", false);

                $box.prop("checked", true);

                $.ajax({
                    url  : "<?php echo Yii::app()->createURL('dashboard/setProyectos');?>",
                    type : 'post',
                    cache: false ,
                    data : {id:id},
                    befereSend: function(){
                        $('#proyecto').html('cargando...');
                    },
                    success: function(data){
                        $('#proyecto').html(data.div);
                    }
                });

            } else {
                $box.prop("checked", false);
            }
        });
        */


    });

</script>


