<?php
/* @var $this RelationshipController */
/* @var $data Relationship */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user1')); ?>:</b>
	<?php echo CHtml::encode($data->user1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user2')); ?>:</b>
	<?php echo CHtml::encode($data->user2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />


</div>