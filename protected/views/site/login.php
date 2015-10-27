<?php
$form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
        'id' => 'verticalForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
    )
);

echo $form->textFieldGroup($model, 'username');
echo $form->passwordFieldGroup($model, 'password');
echo $form->checkboxGroup($model, 'rememberMe');
$this->widget(
    'booster.widgets.TbButton',
    array('buttonType' => 'submit', 'label' => 'Login','htmlOptions'=>array('class'=>'btn btn-primary','style'=>'width:100%;'))
);

$this->endWidget();
unset($form);

?>
