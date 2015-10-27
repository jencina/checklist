


<div class="page-header">
    <h1>Graficos <small> <?php echo 'Prueba' ?></small></h1>
</div>


<?php foreach($proyectos as $index=>$proyecto){

$barra = $barras[$index];?>

    <div class="col-md-12 btn-primary grafic-title"><?php echo $proyectos[$index];?></div>

    <div class="col-md-6">

        <div class="col-md-12 grafic-content">
            <?php
            $this->widget(
                'booster.widgets.TbHighCharts',
                array(
                    'id'=>'column'.$index,
                    'options' => array(
                        'title'=>array(
                            'text'=>'Estado Checklist por Localidad'

                        ),

                        'chart'=>array(
                            'type'=>'column'
                        ),
                        'xAxis'=> array(
                            'categories'=> $barra['localidad']['nombre']
                        ),
                        'plotOptions'=> array(
                            'column'=> array(
                                'stacking'=> 'normal',
                                'dataLabels'=> array(
                                    'enabled'=> true,
                                    //'color'  => (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                                    'style'  => array(
                                        'textShadow'=> '0 0 3px black'
                                    )
                                )
                            )
                        ),
                        'series' => array(
                            array(
                                'name'=>'pendiente',
                                'data' => $barra['localidad']['pendiente']
                            ),
                            array(
                                'name'=>'iniciado',
                                'data' => $barra['localidad']['iniciado']
                            ),
                            array(
                                'name'=>'Terminado',
                                'data' => $barra['localidad']['terminado']
                            )

                        )
                    )
                )
            ); ?>
        </div>
    </div>


    <?php $barra2 = $barras2[$index];?>

    <div class="col-md-6">

        <div class="col-md-12 grafic-content">
            <?php
            $this->widget(
                'booster.widgets.TbHighCharts',
                array(
                    'id'=>'column2'.$index,
                    'options' => array(
                        'title'=>array(
                            'text'=>'Precio Checklist por Localidad'

                        ),

                        'chart'=>array(
                            'type'=>'bar'
                        ),
                        'xAxis'=> array(
                            'categories'=> $barra['localidad']['nombre']
                        ),
                        'plotOptions'=> array(
                            'bar'=> array(
                                'dataLabels'=> array(
                                    'enabled'=> true
                                )
                           )
                        ),
                        'series' => array(
                            array(
                                'name'=>'Precio',
                                'data' => $barra2['precio']
                            ),
                            array(
                                'name'=>'Costo',
                                'data' => $barra2['costo']
                            ),
                            array(
                                'name'=>'Ganancia',
                                'data' => $barra2['ganancia']
                            )

                        )
                    )
                )
            ); ?>
        </div>
    </div>



    <?php $torta = $tortas[$index]?>

    <?php foreach($torta as $index2=>$tor){
        $serie = array();

        foreach($tor['checklist'] as $tot){
            $serie[] = array('name'=>$tot['nombre'],'y'=>$tot['cant']);
        }

        ?>
        <div class="col-md-6">
            <div style="background: #ddd none repeat scroll 0 0;border-radius: 8px;margin: 5px;padding: 15px;">

                <?php $this->widget(
                    'booster.widgets.TbHighCharts',
                    array(
                        'id'=>'pie'.$index.'_'.$index2,
                        'options' => array(
                            'title'=>array(
                                'text'=>'Usuarios Asigandos a Checklist - '.$tor['localidad']

                            ),

                            'chart'=>array(
                                'plotBackgroundColor'=> null,
                                'plotBorderWidth'=> null,
                                'plotShadow'=> false,
                                'type'=>'pie'
                            ),

                            'plotOptions'=> array(
                                'pie'=> array(
                                    'allowPointSelect'=> true,
                                    'cursor'=> 'pointer',
                                    'dataLabels'=> array(
                                        'enabled'=> false
                                    ),
                                    'showInLegend'=> true
                                )
                            ),
                            'series' => array(

                                array(
                                    'name'=>array('usuario'),
                                    'data' => $serie
                                ),
                            )
                        )
                    )
                ); ?>
            </div>
        </div>


    <?php } ?>



<?php }?>






<?php foreach ($tortas as $index=>$torta) { ?>






<?php } ?>
