
<div class="col-md-3">

    <div class="col-md-12">
        <span> Migracion:</span>
    </div>

    <div class="col-md-12">
   <?php
    $this->widget(
        'booster.widgets.TbSwitch',
        array(
            'name' => 'Configuracion[migracion]',
            'value'=> $configuracion->migracion,
            'htmlOptions'=>array('class'=>'col-md-12'),
        )
    );
    ?>
        </div>
</div>

    <div class="col-md-3">
        <div class="col-md-12">
            <span> Foto:</span>
        </div>

        <div class="col-md-12">
        <?php     $this->widget(
            'booster.widgets.TbSwitch',
            array(
                'name' => 'Configuracion[foto]',
                'value'=> $configuracion->foto,
                'htmlOptions'=>array(),
            )
        );
        ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="col-md-12">
           <span> Unidades de Red:</span>
        </div>

        <div class="col-md-12">
        <?php     $this->widget(
            'booster.widgets.TbSwitch',
            array(
                'name' => 'Configuracion[unidades_red]',
                'value'=> $configuracion->unidades_red,
                'htmlOptions'=>array()
            )
        );
        ?>
            </div>
    </div>

    <div class="col-md-3">
        <div class="col-md-12">
            <span>Configuracion de Red:</span>
        </div>

        <div class="col-md-12">
        <?php     $this->widget(
            'booster.widgets.TbSwitch',
            array(
                'name' => 'Configuracion[configuracion_red]',
                'value'=> $configuracion->configuracion_red,
                'htmlOptions'=>array()
            )
        );
        ?>
        </div>
    </div>



