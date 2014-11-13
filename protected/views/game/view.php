<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/myscript.js');
?>
<h1>SmartBullet</h1>
<div class="game_win">
    <div id="field">sdfsd</div>
    <div id="choise">
        <input type="submit" value="Attack" class="solut">
        <input type="submit" value="Dodge" class="solut">
        <input type="submit" value="Special" class="solut">
        <select id="direction">
            <option>Left</option>
            <option>Right</option>
            <option>Back</option>
        </select>
    </div>
</div>
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
    echo CHtml::hiddenField('user_id' , Yii::app()->user->getId());
    echo CHtml::hiddenField('game_id' , $model->id);
    echo CHtml::textField('msg'); 
    echo CHtml::ajaxSubmitButton('Отправить', 'index.php?r=game/polling&id=' . $model->id, array(
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
        padding: 5px;
    }
    
    #field{
        height: 100%;
        width: 69%;
        float: left;
        background-color: silver;
    }
    
    #choise{
        height: 100%;
        width: 30%;
        float: right;
        background-color: yellow;
    }
    
    input[type='text']{
        width: auto;
    }
</style>