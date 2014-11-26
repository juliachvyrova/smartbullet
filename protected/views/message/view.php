<h1>Просмотр сообщения</h1>


<div class="post">	
    <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.$user->photo?>">
    <?php 
        echo $title."<a href=/smartbullet/index.php?r=user/view&id=".$user->id."> ".$user->login."</a>";
    ?>
    <p class="time">
        <?php 
            $time=strtotime($model->datetime); echo date("d.m.Y в H:i",$time);
        ?>
    </p>
    <div class="text-comm">
        <?php echo Smiles::codeToImg($model->text);?><br>    
    </div>  <br> 
   <div id="add-comment">
        <textarea rows="10" cols="45" id="text" class="new-post"></textarea>
        <input type="button" id="add-message" value="Написать" data-url1="<?php echo Yii::app()->createUrl("message/add");?>" data-id="<?php echo $user->id;?>"/>
        <div class="addSmile" data-id_list="newMessage" >
            <div class="smileList" id="newMessage">
                <?php echo Smiles::show("#text");?>
            </div>
        </div>
   </div>
</div>
