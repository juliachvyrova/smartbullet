
<h1>Error <?php echo $code; ?></h1>

<div class="error2">
<?php echo CHtml::encode($message); ?>
<br><br>
<input type="button" onclick="location.href='<?php echo Yii::app()->createUrl("");?>'" value="На главную">
</div>