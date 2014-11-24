<?php /* @var $this Controller */ 
        /* @var $this UserController */
/* @var $model User */
?>


<?php $this->beginContent('//layouts/main'); ?>
<style>
    

</style>
<div class="span-5" id="left-menu">
	<div>

        <?php echo "<a href=/smartbullet/index.php?r=user/view&id=".Yii::app()->user->GetId().">моя страница</a>" ;?>

            <ul>
            <li><div class="mini-photo"></div><br>
            <?php echo "<a href=/smartbullet/index.php?r=user/view&id=".Yii::app()->user->GetId().">Профиль</a>";?><br></li>
            <li  style="clear: both"> <a href="">Игра</a></li>
            <li><a href="">Сообщения</a></li>
            <li><a href="">Приглашения в игру</a></li>
            <li><a href="/smartbullet/index.php?r=user/friends">Друзья</a></li>
            <li><a href="/smartbullet/index.php?r=user/requests">Заявки <?php //$c=Relationship::newRequests(Yii::app()->user->GetId()); if($c>0) echo "<span class='newNews'>+".$c."</span>";?>
            	</li></a> 
            <li><a href="/smartbullet/index.php?r=user/myrequests">Мои заявки</a></li>
            <li><a href="">Редактировать профиль</a></li>
            <li><a href="/smartbullet/index.php?r=user">Поиск</a></li>
            <li><a href="/smartbullet/index.php?r=site/logout">Выход</a></li>
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
<div class="span-18">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>