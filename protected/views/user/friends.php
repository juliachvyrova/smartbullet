<nav>
    <a href="<?php echo Yii::app()->createUrl("user/friends"); ?>"> Друзья </a>
    <a href="<?php echo Yii::app()->createUrl("user/requests"); ?>"> Заявки в друзья <?php $c = Relationship::newRequests(Yii::app()->user->GetId());
if ($c > 0) echo " +" . $c; ?></a>
    <a href="<?php echo Yii::app()->createUrl("user/myrequests"); ?>"> Мои заявки </a>	
</nav>

<h1><?php echo $title ?></h1>



<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $model,
    'itemView' => '/user/_view',
    'sortableAttributes' => array(
        'login',
        'rating',
    ),
    'sorterHeader' => 'Сортировать по:',
    'summaryText' => "",
    'pagerCssClass' => 'custom-pager',
));
?>
