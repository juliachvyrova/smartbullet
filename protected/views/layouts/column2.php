<?php /* @var $this Controller */ 
        /* @var $this UserController */
/* @var $model User */
?>


<?php $this->beginContent('//layouts/main'); ?>
<style>
    #left-menu{
        padding: 10px;
        font-family: sans-serif;
        font-size: 13px;
        //margin-top: 20px;
        height: 500px;
        background: #44494c;
        color:#fff;
    }
    
    #mini-photo{
        height: 50px;
        width: 50px;
        border-radius: 5px;
        background: red;
        float: left;
        margin-right: 5px;
        margin-bottom: 10px;
    }
    
    li{
        height: 20px; width: 100%;
        list-style-type:none;
        margin-bottom: 10px;
    }
   
</style>
<div class="span-5" id="left-menu">
	<div>
            <ul>
            <li><div id="mini-photo"></div><br> Профиль</li>
            <li  style="clear: both"> Игра</li>
            <li>Сообщения</li>
            <li>Приглашения в игру</li>
            <li>Друзья</li>
            <li>Заявки</li>
            <li>Редактировать</li>
            <li>Выход</li>
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