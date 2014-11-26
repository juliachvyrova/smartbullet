<?php
/* @var $this InviteController */
/* @var $model Invite */

$this->breadcrumbs=array(
	'Invites'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Invite', 'url'=>array('index')),
	array('label'=>'Create Invite', 'url'=>array('create')),
	array('label'=>'View Invite', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Invite', 'url'=>array('admin')),
);
?>

<h1>Update Invite <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>