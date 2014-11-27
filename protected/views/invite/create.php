<?php
/* @var $this InviteController */
/* @var $model Invite */

$this->breadcrumbs=array(
	'Invites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Invite', 'url'=>array('index')),
	array('label'=>'Manage Invite', 'url'=>array('admin')),
);
?>

<h1>Create Invite</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>