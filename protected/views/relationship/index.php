<?php
/* @var $this RelationshipController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Relationships',
);

$this->menu=array(
	array('label'=>'Create Relationship', 'url'=>array('create')),
	array('label'=>'Manage Relationship', 'url'=>array('admin')),
);
?>

<h1>Relationships</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
