<div  id="user-main" >
    <div  id="user-photo">
        <img id="photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.$model->photo?>">
        <div class="sheep">     
            <?php if ($model->id!=Yii::app()->user->getId()): ?>

                <?php if(Relationship::folow($model->id, Yii::app()->user->getId())==true):?>
                    <input type="button" class="stopFolow" data-userid="<?php echo $model->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/stopFolow");?>" data-url2=<?php echo Yii::app()->createUrl("user/view",array("id"=>$model->id));?> value="Отписаться"></input>
                <?php elseif(Relationship::friends($model->id, Yii::app()->user->getId())==true):?>
                    <input type="button" class="delFriend" data-userid="<?php echo $model->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/del");?>" data-url2=<?php echo Yii::app()->createUrl("user/view",array("id"=>$model->id));?> value="Удалить из друзей"></input>
                <?php else:?>
                    <input type="button" class="addFriend" data-userid="<?php echo $model->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/add");?>" data-url2=<?php echo Yii::app()->createUrl("user/view",array("id"=>$model->id));?> value="Добавить в друзья"></input>
                <?php endif;?>
                    <br><input type="button" onclick="location.href='<?php echo Yii::app()->createUrl("message/newMessage",array("user"=>$model->id));?>'" value="Написать сообщение">
                    <br><input type="button" id="inviteGame" data-url1="<?php echo Yii::app()->createUrl("invite/newGame");?>" data-url2="<?php echo Yii::app()->createUrl("game");?>" data-id1="<?php echo $model->id;?>" value="Пригласить в игру">
            <?php endif; ?> 
        </div> 
        
    </div>

    <div class="right">
        <div id="login">
            <?php
                echo $model->login;
            ?>
        </div>
    <div class="inf2">
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
	        <?php echo "<td>".CHtml::encode(DataHelper::writeData($model->brth))."</td></tr>"; }?>   	   
                    
            <?php if($model->city!=null) {echo "<tr><td><strong>".CHtml::encode($model->getAttributeLabel('city')).":</strong></td>"; ?>
	        <?php echo "<td>".CHtml::encode($model->city)."</td></tr>"; }?>    	              
        
            <?php if($model->email!=null) {echo "<tr><td><strong>".CHtml::encode($model->getAttributeLabel('email')).":</strong></td>"; ?>
	        <?php echo "<td>".CHtml::encode($model->email)."</td></tr>"; }?>          
        
            <?php if($model->rating!=null) {echo "<tr><td><strong>".CHtml::encode($model->getAttributeLabel('rating')).":</strong></td>"; ?>
	        <?php echo "<td>".CHtml::encode($model->rating)."</td></tr>";} ?>    	    
        </table>
    </div>
</div>
    
    <div class="inf">
        <div id="openWall" class="Open"></div> 
        Стена 
    </div>

    <div id="user-wall">
        <strong>Добавить запись</strong><br>
        <textarea rows="10" cols="45" class="new-post" id="n-post"></textarea>

        <input type="button" id="add-post" value="Добавить" data-wall=<?php echo $model->id; ?> data-url1="<?php echo Yii::app()->createUrl("post/add");?>" data-url2="<?php echo Yii::app()->createUrl("user/view",array("id"=>$model->id));?>" />
          <div class="addSmile" data-id_list="mainPost" >
            <div class="smileList" id="mainPost">
                <?php echo Smiles::show("#n-post");?>
            </div>
          </div>
          <div id='wall'>
            <?php 
                if ($model->countPost>0) {
                    $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=>$post,
                        'itemView' => '/user/_wall',
                        'sorterHeader' => 'Сортировать по:',
                        'summaryText' => "",
                        'pagerCssClass'=>'custom-pager',
                    )); 
                }
            ?>
        </div>
    </div>
</div>