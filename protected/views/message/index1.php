<?php
/* @var $this MessageController */
/* @var $dataProvider CActiveDataProvider */

/* $this->breadcrumbs=array(
  'Messages',
  );

  $this->menu=array(
  array('label'=>'Create Message', 'url'=>array('create')),
  array('label'=>'Manage Message', 'url'=>array('admin')),
  ); */
?>
<nav>
    <a href="<?php echo Yii::app()->createUrl("message/To"); ?>"> Входящие <?php $c = Message::countNew(Yii::app()->user->GetId());
if ($c > 0) echo "+" . $c; ?></a>
    <a href="<?php echo Yii::app()->createUrl("message/From"); ?>"> Исходящие</a>
</nav>
<h1><?php echo $title; ?></h1>

<?php
$this->widget('zii.widgets.CListView', array(
'dataProvider' => $model,
 'itemView' => '/message/_view1',
 'sorterHeader' => "",
 'summaryText' => "",
'pagerCssClass' => 'custom-pager',
));
?>
