
<div class="post" id="post<?php echo $data->id; ?>">
    <div id="AllComm<?php echo $data->id; ?>">
        <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true) . '/images/avatars/' . $data->user->photo ?>">
        <?php if (($data->wall_id == Yii::app()->user->getId()) || ($data->author_id == Yii::app()->user->getId())): ?>
            <div class="delPost" value="Удалить" data-title="Удалить" data-post=<?php echo $data->id; ?> data-url1="<?php echo Yii::app()->createUrl("post/del"); ?> " data-url2="<?php echo Yii::app()->createUrl("user/view", array("id" => $data->wall_id)); ?>"></div>
        <?php endif; ?>

        <?php echo "<a href=".Yii::app()->createUrl("user/view",array("id"=>$data->user->id)) . ">" . $data->user->login . "</a>"; ?>
        <p class="time">
            <?php echo DataHelper::writeAt($data->datetime); ?>
        </p>
        <div class="text-comm">
            <?php $text = CHtml::encode($data->text);
            echo Smiles::codeToImg($text);
            ?><br>
        </div>


        <?php
        if ($data->count >= 1) {
            echo " <br><hr><strong>Комментарии: </strong><br>";
        }
        ?>

        <?php foreach ($data->comments as $coment): ?>     
            <div class="comment" >            
                <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true) . '/images/avatars/' . $coment->user->photo ?>">

                <?php if ($coment->author_id == Yii::app()->user->getId()): ?>
                    <div class="delComm" data-title="Удалить" data-post=<?php echo $coment->post_id; ?> data-url1="<?php echo Yii::app()->createUrl("comment/del"); ?> " data-url2="<?php echo Yii::app()->createUrl("user/view", array("id" => $data->wall_id)); ?>" data-com="<?php echo $coment->id; ?>"></div>
                <?php endif; ?>


                <?php echo "<a href=".Yii::app()->createUrl("user/view",array("id"=>$coment->user->id)) .">" . CHtml::encode($coment->user->login) . "</a>"; ?>
                <p class="time">
                    <?php echo DataHelper::writeAt($data->datetime); ?>
                </p>
                <div class="text-comm">

                    <?php 
                         $text = CHtml::encode($coment->text);
                    echo Smiles::codeToImg($text); ?><br>    
                </div>              
            </div>
        <?php endforeach; ?>  







        <br>
        <strong>Добавить коментарий</strong><br>
        <div id="add-comment">
            <textarea rows="10" cols="45" id="comm<?php echo $data->id; ?>" class="new-post"></textarea>
            <input type="button" id="add-com" value="Добавить" data-post=<?php echo $data->id; ?> data-url1="<?php echo Yii::app()->createUrl("comment/add"); ?> " data-url2="<?php echo Yii::app()->createUrl("user/view", array("id" => $data->wall_id)); ?>" />
            <div class="addSmile" data-id_list="postSmile<?php echo $data->id; ?>" >
                <div class="smileList" id="postSmile<?php echo $data->id; ?>">
                    <?php echo Smiles::show("#comm" . $data->id); ?>
                </div>
            </div>
        </div>


    </div>

</div>