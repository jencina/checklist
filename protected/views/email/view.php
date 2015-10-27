<?php

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Email',
        'links' => array(''),
    )
);

?>



<?php

if(isset($model)){
    $this->widget(
        'booster.widgets.TbDetailView',
        array(
            'data'=> $model,
            'attributes'=>array(
                //'id',
                'email',
                'password',
                'dias',
                'smtp',
                'puerto',
                'from',
                'subject',
                'address'
            ),
        ));
}else{
    echo 'debe crear email';
    echo CHtml::link('agregar email',array('email/create'));

}

 ?>
