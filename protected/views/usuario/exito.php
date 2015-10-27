


<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => CHtml::link(Yii::t('zii', 'Usuarios'), array('usuario/admin')),
        'links' => array('Tecnicos'),
    )
);

?>

<div class="page-header">
    <h1>Usuarios<small> Tecnicos con Termino de Contrato</h1>
</div>


<?php

if(isset($vacio)){

    echo 'no hay tecnicos';

}else if(isset($error)){

    echo 'no hay tecnicos';

}else{

    foreach($tecnicos as $te){

        $model = Usuario::model()->findByPk($te->usuario_id);

        $this->widget(
            'booster.widgets.TbDetailView',
            array(
                'data' => $model,
                'htmlOptions'=>array('style'=>'margin-bottom:40px;float:left'),
                'attributes'=>array(
                    'id',
                    'nombre',
                    'apellido',
                    'empresa_id',
                    //'usuario',
                    'password',
                    'email',
                    //'tipo_contrato_id',
                    //'fecha_inicio',
                    //'fecha_termino',
                ),
            )
        );

    }
}

?>