<?php
/* @var $this InviteController */
/* @var $model Invite */

$this->breadcrumbs=array(
	'Invites'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Invite', 'url'=>array('index')),
	array('label'=>'Create Invite', 'url'=>array('create')),
	array('label'=>'Update Invite', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Invite', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Invite', 'url'=>array('admin')),
);
?>

<h1>View Invite #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user1',
		'user2',
		'game',
	),
)); ?>
