<?php
/* @var $this RelationshipController */
/* @var $model Relationship */

$this->breadcrumbs=array(
	'Relationships'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Relationship', 'url'=>array('index')),
	array('label'=>'Create Relationship', 'url'=>array('create')),
	array('label'=>'View Relationship', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Relationship', 'url'=>array('admin')),
);
?>

<h1>Update Relationship <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>