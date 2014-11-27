<?php /* @var $this Controller */ 
        /* @var $this UserController */
/* @var $model User */
?>


<?php $this->beginContent('//layouts/main'); ?>


<div class="span-6" id="left-menu">
	<div>

        <?php /*echo "<a href=/smartbullet/index.php?r=user/view&id=".Yii::app()->user->GetId().">моя страница</a>" ;*/?>

            <ul>
                <li>
                <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.User::getPhoto(Yii::app()->user->GetId())?>">   <br>             	
                <a href="<?php echo Yii::app()->createUrl("/user/view",array("id"=>(Yii::app()->user->GetId())));?>">Профиль</a></li><br><br>

                <li><a href="<?php echo Yii::app()->createUrl("/game");?>">Игра</a></li>
                <li><a href="<?php echo Yii::app()->createUrl("/invite");?>">Приглашения в игру<?php $c=Invite::newInvite(Yii::app()->user->GetId()); if($c>0) echo "<span class='newNews'>+".$c."</span>";?>
                    </a></li>
                <li><a href="<?php echo Yii::app()->createUrl("/user/friends");?>">Друзья <?php $c=Relationship::newRequests(Yii::app()->user->GetId()); if($c>0) echo "<span class='newNews'>+".$c."</span>";?></a></li>
 
                <li><a href="<?php echo Yii::app()->createUrl("/message/to");?>">Сообщения<?php $c=Message::countNew(Yii::app()->user->GetId()); if($c>0) echo "<span class='newNews'>+".$c."</span>";?>
                </a></li>
                
                <li><a href="<?php echo Yii::app()->createUrl("/user/top");?>">Лучшие игроки</a></li>

                <li><a href="<?php echo Yii::app()->createUrl("/user");?>">Поиск</a></li>

                <li><a href="<?php echo Yii::app()->createUrl("/user/update");?>">Редактировать профиль</a></li> 

                <li><a href="<?php echo Yii::app()->createUrl("/site/logout");?>">Выход</a></li>
            </ul>
	<?php
		/*$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();*/
	?>
	</div><!-- sidebar -->
</div>
<div class="span-21">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>