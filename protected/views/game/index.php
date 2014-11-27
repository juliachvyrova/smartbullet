<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/gameList.js');
?>
<input id="baseUrl" value="<?php echo $baseUrl; ?>" type="hidden">
<br>
<input type="submit" value="Создать новую игру" id="create">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'pagerCssClass'=>'custom-pager',
)); ?>