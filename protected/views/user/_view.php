<?php
/* @var $this UserController */
/* @var $data User */
?>

<div  class="person">
	<div class="person-photo"></div>

		<?php /*echo Relationship::newFolow($data->id, Yii::app()->user->getId());*/if (Relationship::newFolow($data->id, Yii::app()->user->getId())):?>
 			<div class="seeFolow" data-userid="<?php echo $data->id;?>" data-title="Отменить" data-url1="<?php echo Yii::app()->createUrl("relationship/seeFolow");?> "></div>
	<?php endif;?>


			<?php echo "<a href=/smartbullet/index.php?r=user/view&id=".$data->id.">".$data->login."</a>";?>



			<?php if($data->first_name!=null || $data->last_name!=null):?>
				<div class="time"><?php echo $data->first_name." ".$data->last_name;?></div>				
			<?php endif;?>
			<div class="time"><?php echo "Рейтинг: ".$data->rating;?></div>
			<div id="btn<?php echo $data->id;?>">
			<!--input type="button" class="delFriend" data-friend="yes" data-userid="<?php echo $data->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/del");?>" value="Удалить из друзей"></input-->
		


<div id="btn<?php echo $data->id;?>">    

            <?php if ($data->id!=Yii::app()->user->getId()): ?>
                    <!--input type="button" class="newMessage" data-userid="<?php echo $data->id;?>" value="Написать сообщение"--></input>

                <?php if(Relationship::folow($data->id, Yii::app()->user->getId())==true):?>
                    <!--input type="button" class="stopFolow" data-userid="<?php echo $data->id;?>" value="Отписаться"></input-->
                    <input type="button" class="stopFolow" data-friend="no" data-userid="<?php echo $data->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/stopFolow");?>" value="Отписаться"></input>
                <?php elseif(Relationship::friends($data->id, Yii::app()->user->getId())==true):?>

					<input type="button" class="delFriend" data-friend="yes" data-userid="<?php echo $data->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/del");?>" value="Удалить из друзей"></input>
				
                    <!--input type="button" class="delFriend" data-userid="<?php echo $data->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/del");?>" value="Удалить из друзей"></input-->
                <?php elseif(Relationship::noRelation($data->id, Yii::app()->user->getId())==true):?>
                 	<input type="button" class="addFriend"  data-friend="no" data-userid="<?php echo $data->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/add");?>"  value="Добавить в друзья"></input>
                <?php else: ?>
                    <input type="button" class="addFriend"  data-friend="yes" data-userid="<?php echo $data->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/add");?>"  value="Добавить в друзья"></input>
                   
                <?php endif;?>

            <?php endif; ?> 
        </div> 






		</div>
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	*/ ?>

</div>