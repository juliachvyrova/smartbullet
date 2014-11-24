<?php
/* @var $this MessageController */
/* @var $model Message */

/*$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'Update Message', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Message', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);*/
?>

<h1>Просмотр сообщения</h1>


<div class="post">
	
    <img class="mini-photo" src="<?php echo Yii::app()->getBaseUrl(true).'/images/avatars/'.$user->photo?>">
    <?php echo $title."<a href=/smartbullet/index.php?r=user/view&id=".$user->id."> ".$user->login."</a>";?>
    <p class="time">
    <?php $time=strtotime($model->datetime); echo date("d.m.Y в H:i",$time);?>
    </p>
    <div class="text-comm">
        <?php echo $model->text;?><br>    
    </div>  <br> 
   <div id="add-comment">
        <textarea rows="10" cols="45" id="text" class="new-post"></textarea>
        <input type="button" id="add-message" value="Написать" data-url1="<?php echo Yii::app()->createUrl("message/add");?>" data-id="<?php echo $user->id;?>"/>
   </div>
</div>
