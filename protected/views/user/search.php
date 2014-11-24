<!--nav>
	<a href="/smartbullet/index.php?r=user"> Все пользователи </a>
	<a href="/smartbullet/index.php?r=user/requests"> Поиск по логину <?php $c=Relationship::newRequests(Yii::app()->user->GetId()); if($c>0) echo " +".$c;?></a>
	<a href="/smartbullet/index.php?r=user/myrequests"> Поиск по имени фамилии </a>	
</nav-->

<form method="post" action="/smartbullet/index.php?r=user/find" id="search">
<input name="login" value="" placeholder="поиск пользователей" id="searchStr" style=""> 

<!--input type=submit value="искать">
<input src="http://3.bp.blogspot.com/-4w14hQHr5yQ/Tgm6u7KwUkI/AAAAAAAACAI/Hu2poBOPx3g/s1600/search.png" type="image" style="vertical-align: bottom; padding: 0;"/-->


</form>
	<h1><?php echo $title?></h1>


<?php $this->widget('zii.widgets.CListView', array(
'dataProvider'=>$model,
'itemView' => '/user/_view',
'sortableAttributes'=>array(
'login',
'rating',
),
'sorterHeader' => 'Сортировать по:',
'summaryText' => "",//'Зарегистрировано: <strong>{count}</strong> | Показано с <strong>{start}</strong> по <strong>{end}</strong>',
)); ?>


<?php
	/*foreach ($model->user1 as $friend):
?>

	<?php if ($friend->type==0):?>
		<!--div class="person">
			<div class="person-photo"></div>

			<?php echo "<a href=/smartbullet/index.php?r=user/view&id=".$friend->user20->id.">".$friend->user20->login."</a>";?>
			<?php if($friend->user20->first_name!=null || $friend->user20->last_name!=null):?>
				<div class="time"><?php echo $friend->user20->first_name." ".$friend->user20->last_name;?></div>				
			<?php endif;?>
			<div class="time"><?php echo "Рейтинг: ".$friend->user20->rating;?></div>
			
				<div id="btn<?php echo $friend->user20->id;?>">
					<input type="button" class="delFriend" data-friend="yes" data-userid="<?php echo $friend->user20->id;?>" data-url1="<?php echo Yii::app()->createUrl("relationship/del");?>" value="Удалить из друзей"></input>
				
			</div>
		</div-->

	<?php endif;?>

<?php endforeach;*/?>
