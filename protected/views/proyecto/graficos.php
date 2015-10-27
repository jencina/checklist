


<div class="page-header">
    <h1>Graficos <small> <?php echo $model->nombre?></small></h1>
</div>

<?php



$this->widget(
    'booster.widgets.TbHighCharts',
    array(
        'options' => array(
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
);

?>