<ul>
    <div class="post g<?php $map1 = GameMap::model()->findByAttributes(array('game_id' => $data->id)); 
    if ($map1 != NULL){echo $map1->user_count;}
    else echo 0;?>">
	<?php 
            if(!($data->game_status))
                echo CHtml::link(/*CHtml::encode($data->getAttributeLabel('id')). 
                        ': ' */"Игра ". CHtml::encode($data->id), array('view', 'id'=>$data->id));
            else
                echo /*CHtml::encode($data->getAttributeLabel('id')). 
                        ': '*/"Игра " . CHtml::encode($data->id);
        ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('game_status')) ?>:</b>
	<?php 
        if($data->game_status == 0 )
            echo 'Open';
        if($data->game_status == 2 )
            echo 'Close';
        ?>
	<br />
        <?php
            $map = GameMap::model()->findByAttributes(array('game_id' => $data->id));
            if ($map != NULL){
                echo "<b>Gamers count: <b>". $map->user_count . ' ';
                for ($i = 1; $i < 7; $i++)
                {
                    if($map['user'.$i] !== NULL)
                    {
                        $user = User::model()->findByPk($map['user'.$i]);
                        if (isset($user->login)) echo $user->login . ' | ';
                    }
                }
            }else{
                echo "<b>Gamers count: 0<b>";
            }
        ?>
        </div>
</ul>
<br>