<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/myscript.js');
?>
<input type="hidden"value="<?php echo $baseUrl ?>" id="baseUrl">
<div id="myhead">

</div>
<br><br><br>
<div class="game_win">
    <img src="../images/aim.png" id="aim"><img src="../images/miss.png" id="miss">
    <img src="../images/star.png" id="win">
    <div id="field"></div>
    <div id="choise">
         <div id="my_timer">60</div>
        <input type="submit" value="Attack" class="solut" id="attak">
        <input type="submit" value="Dodge" class="solut" id="dodge">
        <input type="submit" value="Heal" class="solut" id="heal">
        <select id="direction">
            <option>Top</option>
            <option>Center</option>
            <option>Bottom</option>
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
        $str .= htmlspecialchars($chat->text).'<br>';
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
    /*echo CHtml::ajaxSubmitButton('Отправить', 'index.php?r=game/polling&id=' . $model->id, array(
    'type' => 'POST',
    'update' => '#output',
),
array(
   'type' => 'submit'
));*/
    echo "<input type='button' value='send' id='send'>";
    echo CHtml::endForm();
 ?>
<style>
    .user_name{
        color: salmon;
        font-style: italic ;
    }
    
    .chat_win{
        margin-top: 10px;
        border: 2px solid silver;
        border-radius: 5px; 
        height: 100px;
        overflow-y: scroll;
    }
    
    .game_win{
        height: 400px;
        background: url("../images/metal2.jpg");
        background-size: contain;
        //background-color: black;
        padding: 5px;
    }
    
    #field{
        height: 100%;
        width: 69%;
        float: left;
        //background-color: silver;
    }
    
    #choise{
        height: 100%;
        width: 30%;
        float: right;
    }
    
    input[type='text']{
        width: auto;
    }
    
    
    @font-face {
        font-family: timer;
        src: url(../fonts/timer.ttf);
    }
    #myhead{
    }
    #my_timer{
        color: white;
        display: block;
        float: right;
        font-family: timer;
        font-size: 40px;
    }
    
    #smart{
        color: white;
        display: block;
        width: 50%;
        float: left;
    }
    
    #left-team{
        width: 50%;
        //background-color: rgba(0,0,255,0.5);
        height: 100%;
        float: left;
    }
    
    
    #right-team{
        width: 50%;
        //background-color: rgba(255,0,0,0.5);
        height: 100%;
        float: right;
    }
    
    .warior{
        height: 33%;
    }
    
    .war-img{
        margin: 0 auto;
        height: 80%;
        width: 100%;
        background: url("../images/warior.png") no-repeat center;
        background-size: contain;
    }
    
    .hp-bar{
      border: 1px solid black;
      border-radius: 0px 5px;
      background-color: black; 
      width: 90%;
      height: 15px;
      margin-left: 5%;
    }
    .hp{
      border-radius: 0px 5px;
      background-color: red;  
      width: 100%;
      height: 100%;
    }
    .hp2{
      border-radius: 0px 5px;
      background-color:  #ff6666;  
      width: 100%;
      height: 100%;
    }
    
    .user-login{
        color: scrollbar;
    }
    
    #aim{
        width: 50px;
        position: absolute;
        left: 100px;
        top: 100px;
    }
    
    #miss{
        width: 100px;
        position: absolute;
        left: 100px;
        top: 100px;
    }
    
    #win{
        width: 300px;
        position: absolute;
        left: 100px;
        top: 100px;
    }
    #attak{
        font-size:0;
        width: 150px;
        height: 120px;
        background: url("../images/gun.png") no-repeat center;
        border: none;
        background-size: contain;
    }
    #heal{
        font-size:0;
        width: 150px;
        height: 120px;
        background: url("../images/heal.png") no-repeat center;
        border: none;
        background-size: contain;
    }
    #dodge{
        font-size:0;
        width: 150px;
        height: 120px;
        background: url("../images/dodge.png") no-repeat center;
        border: none;
        background-size: contain;
    }
    .solut{
        margin-top: 5px;
    }
</style>