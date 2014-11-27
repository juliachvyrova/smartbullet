
<h1><?php echo $title;?></h1>

<?php 
 $this->widget('zii.widgets.CListView', array(
'dataProvider'=>$model,
'itemView' => '/message/_view',
'sorterHeader' => "",
'summaryText' => "",
)); 
 ?>
