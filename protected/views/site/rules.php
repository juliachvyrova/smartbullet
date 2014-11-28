<div class="rul">
    <?php if (!Yii::app()->user->isGuest):?>
        <div class="back" data-title="Назад" onclick="history.go(-1); return false;"></div>                    
    <?php endif;?>

    <h1>Правила игры</h1>
    <div>
        В игре принимают участие 2 команды по 3 человека в каждой.<br><br>
        <img src="<?php echo Yii::app()->baseUrl."/images/img1.png"?>"  width="500" heigh="100"/>
        <br><br>
        Когда начинается игра, каждый игрок должен выполнить одно из доступных ему действий: выстрелить, защититься или вылечить одного из команды. Все действия осуществляются с помощью кнопок, размещенных в правом меню<br>
        <br><img src="<?php echo Yii::app()->baseUrl."/images/img2.png"?>"  width="500" heigh="100"/> <br><br>
        После того, как все сделали ход, кто-то оказывается убитым, а кто-то выжившим.
        Те кто остался, продолжают игру, пока не останется одна выжившая команда.<br><br>
        <img src="<?php echo Yii::app()->baseUrl."/images/img3.png"?>"  width="500" heigh="100"/> <br><br>
        После, подводится итог и начисляются баллы.<br><br>
        Удачной игры <?php echo Smiles::codeToImg(';)');?>
    </div>



</div>
