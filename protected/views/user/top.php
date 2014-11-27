
<h1>Топ 10</h1>

<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'user-grid',
		'dataProvider'=>$model,
		'columns'=>array(
			array(
				'header' => 'Место',
				'value' => '$row+1',
			),					
			//'login',
			array(
                    'name' => 'login',
                    'type'=>'html',
                    'value' => 'CHtml::link(CHtml::encode($data->login),
                         array("user/view","id" => $data->id))',
                ),
	        'rating',			
		),
		
		'summaryText' => "",
        'pagerCssClass'=>'custom-pager',
	)); 
?>


