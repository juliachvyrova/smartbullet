<?php
/* @var $this UserController */
/* @var $model User */

/*$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);*/

/*$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);<h1>View User #<?php echo $model->id; ?></h1>*/
?>



<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'login',
		'password',
		'brth',
		'city',
		'email',
		'rating',
		'photo',
		'data',
	),
)); */?>

<style>
    
    #user-main{
       // float:right;
        //width: 100%;
        overflow: auto;
       // background: #eeeff2;
        font-family: sans-serif;

    }
    
    #user-photo{
       border-bottom: 1px black solid;    
    }
    
    #photo{
        width:200px;
        height:200px;
        border-radius: 20px;
        background: red;
        margin: auto;   
        margin-top: 20px;
    }
    
    #login{
        font-size: 25px;
        text-align: center;
        margin-top: 15px;
        margin-bottom: 20px;
    }
    
    #user-info{
       // background: #dfd;
       // height: 100px;
       border-bottom: 1px black solid;
       min-height: 100px;
    }
    
    #user-wall{
      //  background: #ddf;
      //  height: 100px;
      min-height: 100px;
    }
    

    .post{
        margin: 0 auto;
        border: 1px solid black;
        width: 95%;
        padding: 10px;
        margin-top: 15px;
        border-radius: 20px;
        overflow: auto;
    }   
    
    .comment{
        width: 95%;
        padding: 10px;
        float:right;
    }
    
    #new-post{
        margin-left: 2%;
        width: 95%;
        height: 50px;
        resize:none;

    }
    
    #add-post{
        margin-left: 2%;
    }

</style>

<div  id="user-main" >
    <div  id="user-photo">
        <div id="photo">
            
        </div>
        <div id="login">
            <?php
                echo $model->login;
            ?>
        </div>
        
        
    </div>
    
    <div id="user-info">
        <!--?php
        if($model->first_name!=null) echo $model->first_name;
        if($model->brth!=null) echo $model->brth;
        if($model->city!=null) echo $model->city;
        if($model->email!=null) echo $model->email;
        if($model->last_name!=null) echo $model->last_name;
        ?>
        <br-->
        <!--?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
                'first_name',
                'last_name',
		'brth',
		'city',
		'email',
		'rating',
	),
));?--><table><tr>
        <?php if($model->first_name!=null) {echo " <td><strong>".CHtml::encode($model->getAttributeLabel('first_name')).":</strong></td>"; ?>
        <?php echo "<td>".CHtml::encode($model->first_name)."</td>"; }?>
        </tr>
        
        <tr>
        <?php if($model->last_name!=null) echo " <td><strong>".CHtml::encode($model->getAttributeLabel('last_name')).":</strong></td>"; ?>
	<?php echo "<td>".CHtml::encode($model->last_name)."</td>"; ?>
	</tr>
        
        <tr>
        <?php if($model->brth!=null) echo "<td><strong>".CHtml::encode($model->getAttributeLabel('brth')).":</strong></td>"; ?>
	<?php echo "<td>".CHtml::encode($model->brth)."</td>"; ?>
	</tr>
        
        <tr>
        <?php if($model->city!=null) echo "<td><strong>".CHtml::encode($model->getAttributeLabel('city')).":</strong></td>"; ?>
	<?php echo "<td>".CHtml::encode($model->city)."</td>"; ?>
	</tr>
        
        <tr>
        <?php if($model->email!=null) echo "<td><strong>".CHtml::encode($model->getAttributeLabel('email')).":</strong></td>"; ?>
	<?php echo "<td>".CHtml::encode($model->email)."</td>"; ?>
	</tr>
        
        <tr>
        <?php if($model->rating!=null) echo "<td><strong>".CHtml::encode($model->getAttributeLabel('rating')).":</strong></td>"; ?>
	<?php echo "<td>".CHtml::encode($model->rating)."</td>"; ?>
	</tr>
        </table>
    </div>
    
    <div id="user-wall">
       <strong>Добавить запись</strong><br>
       <textarea rows="10" cols="45" id="new-post" ></textarea>
       <input type="button" id="add-post" value="Добавить"/>
        <?php
            /*$this->renderPartial('_post',array(
                'user'=>$model,
                'post'=>$model->posts,
            ));*/
        
        
        foreach ($model->posts as $p):
            //var_dump($p->comments[0]); exit;
    ?>

<div class="post">
    <strong>
    <?php echo $p->user->login;?>
    </strong><br>

    <?php echo $p->text;?><br>



 <?php
     if ($p->count>=1) echo " <hr><strong>Комментарии: </strong><br><br>"
        ?>

        <?php
        foreach ($p->comments as $coment):?>
            
       <div class="comment">
        <strong>
            <?php echo $coment->user->login;?>
        </strong><br>

        <?php echo $coment->text;?><br>
        </div>
    
        
                    <?php endforeach; ?>  
        
       <br>
       <strong>Добавить коментарий</strong><br>
       <textarea rows="10" cols="45" id="new-post" ></textarea>
       <input type="button" id="add-post" value="Добавить"/>
       
       </div>
<?php endforeach; ?> 

    </div>
</div>



