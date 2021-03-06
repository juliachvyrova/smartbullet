<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

/*$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);*/
?>

<!--h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p-->



<div class="first">
<h1>Добро пожаловать в игру SmartBullet</h1>
<div class="rul">
Мы рады приветствовать вас на главной странице сайта<br>
Что бы зайти в игру или пообщаться с другими игроками, необходимо войти под своим логином и паролем, или зарегистрироваться
</div>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<!--p class="note">Fields with <span class="required">*</span> are required.</p-->

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<!--p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p-->
	</div>

	<!--div class="row rememberMe">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php// echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</div-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Вход'); ?>
		<!--a href="/smartbullet/index.php?r=site/registration" class="button">Регистраци</a-->
		<input type="button" onclick="location.href='<?php echo Yii::app()->createUrl("site/registration");?>'" value="Регистрация">
	<!--input type="button" value="Регистрация"></input-->
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
