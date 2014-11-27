

<div class="post message <?php if ($data->state == 1) echo "newMess"; ?>"  data-id="<?php echo $data->id ?>" id="mess<?php echo $data->id ?>" >
    <div class="delMess" data-title="Удалить" data-message=<?php echo $data->id; ?> data-url1="<?php echo Yii::app()->createUrl("message/del"); ?> " data-user="<?php echo Yii::app()->user->getId(); ?>"></div>

    <div class="message" onclick="location.href = '<?php echo Yii::app()->createUrl("message/view", array('id' => $data->id)); ?>'">


        <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true) . '/images/avatars/' . $data->userTo->photo ?>">

        Сообщение для <?php echo "<a href=" . Yii::app()->createUrl("user/view", array('id' => $data->userTo->id)) . "> " . $data->userTo->login . "</a>"; ?>
        <p class="time">
            <?php $time = strtotime($data->datetime);
            echo date("d.m.Y в H:i", $time);
            ?>
        </p>
        <div class="text-comm">
            <?php
            if (strlen($data->text) <= 26) {
                $text = CHtml::encode($data->text);
                echo Smiles::codeToImg($text);
            } else {
                $text = CHtml::encode($data->text);
                echo mb_substr($text, 0, 26) . " ...";
            }
            ?>   
        </div>     <br> 


    </div>

</div>