<div  id="user-main" >
    <div style="display:none" id="invisible"><?php echo Yii::app()->createUrl("relationship/add"/*,array("id"=>$model->id)*/);?></div>
    <div style="display:none" id="invisible2"><?php echo Yii::app()->createUrl("user/view",array("id"=>$model->id));?></div>
    <div  id="user-photo">
        <!--div id="photo"></div-->
        <img id="photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.$model->photo?>">
        <div class="sheep">     
            <?php if ($model->id!=Yii::app()->user->getId()): ?>
                    <!--input type="button" class="newMessage" data-userid="<?php echo $model->id;?>" value="Написать сообщение"></input-->

                <?php if(Relationship::folow($model->id, Yii::app()->user->getId())==true):?>
                    <input type="button" class="stopFolow" data-userid="<?php echo $model->id;?>" value="Отписаться"></input>
                <?php elseif(Relationship::friends($model->id, Yii::app()->user->getId())==true):?>
                    <input type="button" class="delFriend" data-userid="<?php echo $model->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/del");?>" value="Удалить из друзей"></input>
                <?php else:?>
                    <input type="button" class="addFriend" data-userid="<?php echo $model->id;?>"  value="Добавить в друзья"></input>
                <?php endif;?>
                    <!--br><a href="<?php echo Yii::app()->createUrl("message/newMessage",array("user"=>$model->id));?>" class="button">Написать сообщение</a-->
                    <br><input type="button" onclick="location.href='<?php echo Yii::app()->createUrl("message/newMessage",array("user"=>$model->id));?>'" value="Написать сообщение">
            <?php endif; ?> 
        </div> 

        <div id="login">
            <?php
                echo $model->login;
            ?>
        </div>
    </div>

    <div class="inf">
        <!--input type="button" src="./css/arr1.jpg" id="openInf" class="Open"></input-->
        <div id="openInf" class="Open"></div>
        Информация 
    </div>

    <div id="user-info">
        <table>
            
                <?php if($model->first_name!=null) {echo "<tr> <td><strong>".CHtml::encode($model->getAttributeLabel('first_name')).":</strong></td>"; ?>
                <?php echo "<td>".CHtml::encode($model->first_name)."</td></tr>"; } ?>
            
            
            
                <?php if($model->last_name!=null){ echo "<tr> <td><strong>".CHtml::encode($model->getAttributeLabel('last_name')).":</strong></td>"; ?>
    	        <?php echo "<td>".CHtml::encode($model->last_name)."</td></tr>"; }?>
    	   
            
            
                <?php if($model->brth!=null){ echo "<tr><td><strong>".CHtml::encode($model->getAttributeLabel('brth')).":</strong></td>"; ?>
    	       <?php echo "<td>".CHtml::encode($model->brth)."</td></tr>"; }?>
    	   
            
            
                <?php if($model->city!=null) {echo "<tr><td><strong>".CHtml::encode($model->getAttributeLabel('city')).":</strong></td>"; ?>
    	        <?php echo "<td>".CHtml::encode($model->city)."</td></tr>"; }?>
    	   
            
            
                <?php if($model->email!=null) {echo "<tr><td><strong>".CHtml::encode($model->getAttributeLabel('email')).":</strong></td>"; ?>
    	        <?php echo "<td>".CHtml::encode($model->email)."</td></tr>"; }?>
    	   
            
            
                <?php if($model->rating!=null) {echo "<tr><td><strong>".CHtml::encode($model->getAttributeLabel('rating')).":</strong></td>"; ?>
    	        <?php echo "<td>".CHtml::encode($model->rating)."</td></tr>";} ?>
    	    
        </table>
    </div>
    
    <div class="inf">
        <!--input type="button" src="./css/arr1.jpg" id="openWall" class="Open"></input-->
        <div id="openWall" class="Open"> </div> 
        Стена 
    </div>

    <div id="user-wall">
       <strong>Добавить запись</strong><br>
       <textarea rows="10" cols="45" class="new-post" id="n-post"></textarea>
       <input type="button" id="add-post" value="Добавить" data-wall=<?php echo $model->id; ?> data-AddUrl="<?php echo Yii::app()->createUrl("post/add");?>"/>
       <div id='wall'>
        <?php
            foreach ($model->posts as $p):
        ?>

            <div class="post" id="post<?php echo $p->id; ?>"><div id="AllComm<?php echo $p->id; ?>">
                <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.$p->user->photo?>">
                <?php if (($p->user->id==Yii::app()->user->getId()) || ($model->id==Yii::app()->user->getId())):?>
                    <div class="delPost" value="Удалить" data-title="Удалить" data-post=<?php echo $p->id; ?> data-DelUrl="<?php echo Yii::app()->createUrl("post/del");?> " data-wall="<?php echo $model->id; ?>"></div>
                <?php endif;?>

                <?php echo "<a href=/smartbullet/index.php?r=user/view&id=".$p->user->id.">".$p->user->login."</a>";?>
                <p class="time">
                <?php $time=strtotime($p->datetime); echo date("d.m.Y в H:i",$time);?>
                </p>
                <div class="text-comm">
                    <?php echo $p->text;?><br>
                </div>

                <?php
                     if ($p->count>=1) {
                        echo " <br><hr><strong>Комментарии: </strong><br>";
                    }
                ?>

                <?php foreach ($p->comments as $coment):?>     
                    <div class="comment" >            
                        <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.$coment->user->photo?>">

                        <?php if ($coment->author_id==Yii::app()->user->getId()):?>
                            <div class="delComm" data-title="Удалить" data-post=<?php echo $coment->post_id; ?> data-DelUrl="<?php echo Yii::app()->createUrl("comment/del");?> " data-wall="<?php echo $model->id; ?>" data-com="<?php echo $coment->id; ?>"></div>
                        <?php endif;?>


                        <?php echo "<a href=/smartbullet/index.php?r=user/view&id=".$coment->user->id.">".$coment->user->login."</a>";?>
                        <p class="time">
                        <?php $time=strtotime($coment->datetime); echo date("d.m.Y в H:i",$time);?>
                        </p>
                        <div class="text-comm">
                            <?php echo $coment->text;?><br>    
                        </div>              
                    </div>
                <?php endforeach; ?>  
            
                   <br>
                   <strong>Добавить коментарий</strong><br>
                   <div id="add-comment">
                        <textarea rows="10" cols="45" id="comm<?php echo $p->id; ?>" class="new-post"></textarea>
                        <input type="button" id="add-com" value="Добавить" data-post=<?php echo $p->id; ?> data-AddUrl="<?php echo Yii::app()->createUrl("comment/add");?> " data-wall="<?php echo $model->id; ?>"/>
                   </div>
            </div></div>
                <?php endforeach; ?> 
                </div>
    </div>
</div>



