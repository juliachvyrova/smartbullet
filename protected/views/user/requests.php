<?php if ($count != 0): ?>
    <h1>Друзья (<?php echo $count . ")"; ?></h1>
<?php else: ?>
    <h1>У вас пока нет подписчиков</h1>
<?php endif; ?>

<?php
foreach ($model->user1 as $friend):
    ?>

    <?php if ($friend->type == 2): ?>
        <div class="person">
            <div class="person-photo"></div>

            <?php echo "<a href=" . Yii::app()->createUrl('user/view', array("id" => $friend->user20->id)) . ">" . $friend->user20->login . "</a>"; ?>
            <?php if ($friend->user20->first_name != null || $friend->user20->last_name != null): ?>
                <div class="time"><?php echo CHtml::encode($friend->user20->first_name) . " " . CHtml::encode($friend->user20->last_name); ?></div>				
            <?php endif; ?>
            <div class="time"><?php echo "Рейтинг: " . $friend->user20->rating; ?></div>
            <div id="btn<?php echo $friend->user20->id; ?>">

                <input type="button" class="addFriend" data-friend="request" data-userid="<?php echo $friend->user20->id; ?>" data-url1="<?php echo Yii::app()->createUrl("relationship/add"); ?>" value="Добавить в друзья"></input>

            </div>
        </div>

    <?php endif; ?>

<?php endforeach; ?>
