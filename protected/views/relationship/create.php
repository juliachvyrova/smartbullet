<?php
/* @var $this RelationshipController */
/* @var $model Relationship */

$this->breadcrumbs=array(
	'Relationships'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Relationship', 'url'=>array('index')),
	array('label'=>'Manage Relationship', 'url'=>array('admin')),
);
?>

<h1>Create Relationship</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>