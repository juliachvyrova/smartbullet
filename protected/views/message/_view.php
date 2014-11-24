<?php
/* @var $this MessageController */
/* @var $data Message */
?>

<div class="post message <?php if ($data->state==1) echo "newMess";?>" onclick="location.href='/smartbullet/index.php?r=message/view&id=<?php echo $data->id?>'">

	
	<img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.$data->photo?>">
	<div class="delMess" data-title="Удалить" data-message=<?php echo $data->id; ?> data-DelUrl="<?php echo Yii::app()->createUrl("message/del");?> " data-user="<?php echo Yii::app()->user->getId(); ?>"></div>
    <?php echo "<a href=/smartbullet/index.php?r=user/view&id=".$data->userFrom->id."> ".$data->userFrom->login."</a>";?>
    <p class="time">
    <?php $time=strtotime($data->datetime); echo date("d.m.Y в H:i",$time);?>
    </p>
    <div class="text-comm">
        <?php echo $data->text;?><br>    
    </div>     



</div>