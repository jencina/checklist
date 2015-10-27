<?php
/* @var $this ChecklistController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Checklists',
);

?>

<h1>Checklists</h1>

<?php $this->widget('booster.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
