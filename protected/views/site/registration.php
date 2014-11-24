<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,

        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        )); ?>
<h1>Форма регистрации</h1>
	<p class="note registration" >Поля с <span class="required">*</span> обязательны для заполнения</p>

	<!--?php echo $form->errorSummary($model); ?-->

	<!--div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div-->

	<table class="registration" >
		<tr>
			<td>
				<?php echo $form->labelEx($model,'login'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'login',array('size'=>32,'maxlength'=>32)); ?>
				<?php echo $form->error($model,'login'); ?> 
			</td>
		</tr>

		<tr>
			<td>
				<?php echo $form->labelEx($model,'password'); ?>
			</td>
			<td>
				<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>
				<?php echo $form->error($model,'password'); ?>
			</td>
		</tr>

		<tr>
			<td>
				<?php echo $form->labelEx($model,'password2'); ?>
			</td>
			<td>
				<?php echo $form->passwordField($model,'password2',array('size'=>32,'maxlength'=>32)); ?>
				<?php echo $form->error($model,'password2'); ?>
			</td>
		</tr>

		<tr>
			<td>
				<?php echo $form->labelEx($model,'first_name'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'first_name',array('size'=>32,'maxlength'=>32)); ?>
				<?php echo $form->error($model,'first_name'); ?>
			</td>
		</tr>

		<tr>
			<td>
				<?php echo $form->labelEx($model,'last_name'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'last_name',array('size'=>32,'maxlength'=>32)); ?>
				<?php echo $form->error($model,'last_name'); ?>
			</td>
		</tr>

		<tr>
			<td>
				<?php echo $form->labelEx($model,'brth2'); ?>
			</td>
			<td>
				<?php /*echo $form->textField($model,'brth');*/ ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				   'name' => 'brth2',
				   'model' => $model,
				   //'mask' => '99.99.9999',
				   'attribute' => 'brth2',
				   'language' => 'ru',
				   'options' => array(
				       'showAnim' => 'fold',
				   ),
				   'htmlOptions' => array(
				       'style' => 'height:18px; width:232px;'
				   ),
				));?>
				<?php echo $form->error($model,'brth2'); ?>
			</td>
		</tr>

		<tr>
			<td>
				<?php echo $form->labelEx($model,'city'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'city',array('size'=>32,'maxlength'=>32)); ?>
				<?php echo $form->error($model,'city'); ?>
			</td>
		</tr>

		<tr>
			<td>
				<?php echo $form->labelEx($model,'email'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>32)); ?>
				<?php echo $form->error($model,'email'); ?>
			</td>
		</tr>

		<tr>
			<td>
				<?php echo $form->labelEx($model,'image'); ?>
			</td>
			<td>
		        <?php echo CHtml::activeFileField($model, 'image'); ?>
				<?php echo $form->error($model,'image'); ?>
			</td>
		</tr>

		<tr>
			<td>
			</td>
			<td>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Зарегистрироваться' : 'Save'); ?>
		<input type="button" onclick="location.href='<?php echo Yii::app()->createUrl("site/login");?>'" value="Назад">
	</div>
			</td>
		</tr>
	</table>



<?php $this->endWidget(); ?>

</div><!-- form -->