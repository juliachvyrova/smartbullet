
<div  class="person">
    <img class="person-photo" src="<?php echo Yii::app()->getBaseUrl(true) . '/images/avatars/' . $data->photo ?>">
    <?php if (Relationship::newFolow($data->id, Yii::app()->user->getId())): ?>
        <div class="seeFolow" id="Folow<?php echo $data->id; ?>" data-userid="<?php echo $data->id; ?>" data-title="Отменить" data-url1="<?php echo Yii::app()->createUrl("relationship/seeFolow"); ?> "></div>
    <?php endif; ?>


    <?php echo "<a href=" . Yii::app()->createUrl("user/view", array('id' => $data->id)) . ">" . $data->login . "</a>"; ?>



    <?php if ($data->first_name != null || $data->last_name != null): ?>
        <div class="time"><?php echo CHtml::encode($data->first_name ). " " .CHtml::encode( $data->last_name); ?></div>				
    <?php endif; ?>
    <div class="time"><?php echo "Рейтинг: " . $data->rating; ?></div>



    <?php if ($data->id != Yii::app()->user->getId()): ?>
        <div id="btn<?php echo $data->id; ?>">
            <?php if (Relationship::folow($data->id, Yii::app()->user->getId()) == true): ?>
                <input type="button" class="stopFolow" id="stopFolow<?php echo $data->id; ?>" data-friend="no" data-userid="<?php echo $data->id; ?>" data-url1="<?php echo Yii::app()->createUrl("relationship/stopFolow"); ?>" value="Отписаться"></input>
            <?php elseif (Relationship::friends($data->id, Yii::app()->user->getId()) == true): ?>

                <input type="button" class="delFriend" id="delFriend<?php echo $data->id; ?>" data-friend="yes" data-userid="<?php echo $data->id; ?>" data-url1="<?php echo Yii::app()->createUrl("relationship/del"); ?>" value="Удалить из друзей"></input>

       
            <?php elseif (Relationship::noRelation($data->id, Yii::app()->user->getId()) == true): ?>
                <input type="button" class="addFriend" id="addFriend<?php echo $data->id; ?>"  data-friend="no" data-userid="<?php echo $data->id; ?>" data-url1="<?php echo Yii::app()->createUrl("relationship/add"); ?>"  value="Добавить в друзья"></input>
            <?php else: ?>
                <input type="button" class="addFriend" id="addFriend<?php echo $data->id; ?>"  data-friend="yes" data-userid="<?php echo $data->id; ?>" data-url1="<?php echo Yii::app()->createUrl("relationship/add"); ?>"  value="Добавить в друзья"></input>

            <?php endif; ?>


        </div> 
        <input type="button" onclick="location.href = '<?php echo Yii::app()->createUrl("message/newMessage", array("user" => $data->id)); ?>'" value="Написать сообщение">
        <input type="button" id="inviteGame" data-url1="<?php echo Yii::app()->createUrl("invite/newGame"); ?>" data-url2="<?php echo Yii::app()->createUrl("game"); ?>" data-id1="<?php echo $data->id; ?>" value="Пригласить в игру">
    <?php endif; ?> 


</div>