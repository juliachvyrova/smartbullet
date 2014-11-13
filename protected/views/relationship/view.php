<?php
/* @var $this RelationshipController */
/* @var $model Relationship */

$this->breadcrumbs=array(
	'Relationships'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Relationship', 'url'=>array('index')),
	array('label'=>'Create Relationship', 'url'=>array('create')),
	array('label'=>'Update Relationship', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Relationship', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Relationship', 'url'=>array('admin')),
);
?>

<h1>View Relationship #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user1',
		'user2',
		'type',
	),
)); ?>
