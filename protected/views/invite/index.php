<h1><?php echo $title?></h1>


<?php 
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$model,
		'itemView' => '_view',
	'summaryText' => "",
	'pagerCssClass'=>'custom-pager',
	)); 
?>