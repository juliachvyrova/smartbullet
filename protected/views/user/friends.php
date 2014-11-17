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
