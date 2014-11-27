
<form method="post" action="<?php echo Yii::app()->createUrl("user/find"); ?>" id="search">
    <input name="login" value="" placeholder="поиск пользователей" id="searchStr" style=""> 
</form>

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
