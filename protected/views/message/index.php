<?php
/* @var $this MessageController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);*/
?>

<h1><?php echo $title;?></h1>

<?php 
 $this->widget('zii.widgets.CListView', array(
'dataProvider'=>$model,
'itemView' => '/message/_view',
/*'sortableAttributes'=>array(
'datetime',
),*/
'sorterHeader' => "",//'Сортировать по:',
'summaryText' => "",//'Зарегистрировано: <strong>{count}</strong> | Показано с <strong>{start}</strong> по <strong>{end}</strong>',
)); 
 ?>
