<?php
/* @var $this UserController */
/* @var $data User */
?>

<div  class="person">
	<div class="person-photo"></div>
			<?php echo "<a href=/smartbullet/index.php?r=user/view&id=".$data->id.">".$data->login."</a>";?>
			<?php if($data->first_name!=null || $data->last_name!=null):?>
				<div class="time"><?php echo $data->first_name." ".$data->last_name;?></div>				
			<?php endif;?>
			<div class="time"><?php echo "Рейтинг: ".$data->rating;?></div>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	*/ ?>

</div>