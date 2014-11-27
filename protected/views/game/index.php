<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/gameList.js');
?>
<input id="baseUrl" value="<?php echo $baseUrl; ?>" type="hidden">
<input type="submit" value="Create new game" id="create">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>