<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/myscript.js');
?>
<h1>SmartBullet</h1>
<div class="game_win"></div>
<div id='rol'>
<div class="chat_win" id='output'>
    
<?php
foreach ($model->chatmsg as $chat){
    $str='';
   if($chat->author <> NULL){
        $str .= '<span class="user_name">'.$chat->author->login.'</span>: ';
        $str .= $chat->text.'<br>';
   }
   echo $str;
}
?>
</div>
</div>

 <?php 
    echo CHtml::beginForm();
    echo CHtml::hiddenField('user_id' , '2');
    echo CHtml::textField('msg'); 
    echo CHtml::ajaxSubmitButton('Отправить', '', array(
    'type' => 'POST',
    'update' => '#output',
),
array(
   'type' => 'submit'
));
    echo CHtml::endForm();
 ?>
<style>
    .user_name{
        color: salmon;
        font-style: italic ;
    }
    
    .chat_win{
        border: 2px solid silver;
        border-radius: 5px; 
        height: 100px;
        overflow-y: scroll;
    }
    
    .game_win{
        height: 400px;
        background-color: black;
    }
    input[type='text']{
        width: 85%;
    }
</style>