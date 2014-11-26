
<div id="invite<?php echo $data->id?>" class="post"  data-id1="<?php echo $data->id;?>" >

    <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.$data->user10->photo?>">
        <?php echo "<a href=".Yii::app()->createUrl("user/view",array('id'=>$data->user10->id))."> ".$data->user10->login."</a>";?>
        <div class="text-comm">
            Приглашает вас в игру  
        </div>

    
    <input type="button" onclick="location.href='<?php echo Yii::app()->createUrl("game/view",array('id'=>$data->game));?>'" value="Принять приглашение" class="delInvite" data-url1="<?php echo Yii::app()->createUrl("invite/del");?>" data-id1="<?php echo $data->id?>">
    <input type="button" value="Отменить приглашение" class="delInvite" data-url1="<?php echo Yii::app()->createUrl("invite/del");?>" data-id1="<?php echo $data->id?>">

</div>