<?php
/* @var $this InviteController */
/* @var $model Invite */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invite-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user1'); ?>
		<?php echo $form->textField($model,'user1'); ?>
		<?php echo $form->error($model,'user1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user2'); ?>
		<?php echo $form->textField($model,'user2'); ?>
		<?php echo $form->error($model,'user2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'game'); ?>
		<?php echo $form->textField($model,'game'); ?>
		<?php echo $form->error($model,'game'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->