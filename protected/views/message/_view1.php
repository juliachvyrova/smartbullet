<?php
/* @var $this MessageController */
/* @var $data Message */
?>

<div class="post message <?php if ($data->state==1) echo "newMess";?>"  data-id="<?php echo $data->id?>" id="mess<?php echo $data->id?>" data-url1="<?php echo Yii::app()->createUrl("message/readNew");?>" >
	<div class="delMess" data-title="Удалить" data-message=<?php echo $data->id; ?> data-url1="<?php echo Yii::app()->createUrl("message/del");?> " data-user="<?php echo Yii::app()->user->getId(); ?>"></div>

<div class="message" onclick="location.href='<?php echo Yii::app()->createUrl("message/view",array('id'=>$data->id));?>'">

	        <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.$data->userFrom->photo?>">
    <?php echo "<a href=".Yii::app()->createUrl("user/view",array('id'=>$data->userFrom->id))."> ".$data->userFrom->login."</a>";?>
    <p class="time">
    <?php $time=strtotime($data->datetime); echo date("d.m.Y в H:i",$time);?>
    </p>
    <div class="text-comm">
        <?php if (strlen($data->text)<=25) echo $data->text; else echo mb_substr($data->text,0,26)." ...";?>   
    </div>     <br> 
</div>


</div>