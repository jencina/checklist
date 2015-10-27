
<?php

$box = $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Proyectos',
        'id'=>'db-empresas',
        'context' => 'primary',
        'headerIcon' => 'th-list',
        'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table')
    )
);

foreach($localidades as $localidad){ ?>

    <div class="col-md-12 localidad" style="float: none">
        <div class="checkbox">
            <label>
                <input type="checkbox" value="<?php echo $localidad->id?>">
            <?php echo $localidad->region->nombre?></div>
        </label>
    </div>

<?php } $this->endWidget(); ?>

