<?php
/* @var $this InviteController */
/* @var $model Invite */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user1'); ?>
		<?php echo $form->textField($model,'user1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user2'); ?>
		<?php echo $form->textField($model,'user2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'game'); ?>
		<?php echo $form->textField($model,'game'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->