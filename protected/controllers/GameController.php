<?php

class GameController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','chatPolling','fight','tern','gamePolling','giveMap','giveStats','endGame'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
 
	public function actionView($id)
	{
            
            $exists = GameMap::model()->find('game_id = :game_id', array(":game_id"=>$id));
            
            if($exists == NULL){// if map for this game are not exist, make it
                $mod = new GameMap;
                $mod->game_id = $id;
                $mod->time = NULL;
                $mod->user_count = 1;
                $mod->user1 = Yii::app()->user->getId();
                $mod->save();
                $this->render('view',array( 
                    'model'=>$this->loadModel($id),
                ));
                Yii::app()->end();
            }else{
                if($exists->user_count  < 6 )
                {
                    $flag = true;//flag of presence in game
                    for($i = 1; $i < 6 ; $i++)
                    {
                       if( $exists['user'.$i] == Yii::app()->user->getId() )
                               $flag = false;
                    }
                    if ($flag == true)//if we are not in game already
                    {
                        $exists['user'.(++$exists->user_count)] = Yii::app()->user->getId();//add as in game
                        if($exists->user_count == 6)
                        {
                            $exists->time = time();
                        }
                        $exists->save();
                    }
                }else{//game is full
                    
                    if($exists->user_count == 6)
                    {
                        for($i = 1; $i < 6 ; $i++)
                        {
                            if($exists['user'.$i] = Yii::app()->user->getId())
                            $this->render('view',array( 
                                    'model'=>$this->loadModel($id),
                            ));
                            Yii::app()->end();
                        }
                    $this->render('deny',array( 
                      'model'=>$this->loadModel($id),
                       ));
                    Yii::app()->end();
                }
            }
            $this->render('view',array( 
                    'model'=>$this->loadModel($id),
            ));
	}
    }
	public function actionChatPolling($id){
            
               $textMsg = $_POST['msg'];
               if($textMsg != ''){ //add messege
                   $msg = new Chatmsg();
                   $msg->author_id = Yii::app()->user->getId();
                   $msg->text = $textMsg;
                   $msg->game_id = $id;
                   $msg->save();
               }
               $chatMsgs = array();
               $model = $this->loadModel($id);
               foreach ($model->chatmsg as $chat){ //send all chat messeges
                       if($chat->author <> NULL){
                           $chatMsgs[$chat->id]= array('user'=>$chat->author->login,
                               'text' => $chat->text);
                      }
               } 
               echo json_encode($chatMsgs);   
               Yii::app()->end();
        }


        public function actionIndex()
	{
            $dataProvider=new CActiveDataProvider('Game');
                $this->render('index',array(
                        'dataProvider'=>$dataProvider,
                ));
            
	}


	public function loadModel($id)
	{
		$model=Game::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='game-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionFight($id){
            //save game_log
            $model = new LogGame();
            $model->game_id = $id;
            $model->user_id = Yii::app()->user->getId();
            $model->action = $_POST['value'];
            $model->direction = $_POST['select'];
            $logs = LogGame::model()->findAllByAttributes(array('game_id' => $id,
                   'user_id' => (Yii::app()->user->getId()),
            ));
            $tern = count($logs) +1;
            $model->tern = $tern;
            $model->save();
            
            //if all users end this tern
            $logs = LogGame::model()->findAllByAttributes(array('game_id' => $id,
                'tern' => $tern));            
            if ( count($logs) == 6)
            {
                $this->makeResult($id,$tern);
            }
            //$this->makeResult($id,$tern);
            // return all log in json
            $model = $this->loadModel($id);
            $result = array();
            foreach ($model->loggame as $log){
                if($log->tern == $tern)
                $result[$log->id] = array('user' => $log->user_id,
                                          'tern' => $log->tern,
                                          'action' => $log->action,
                                          'direction' => $log->direction,
                                          'result' => $log->result
                );
            }
            echo json_encode($result);
            Yii::app()->end();
        }
        
        protected function makeResult($id,$tern)
        {
            $logs = LogGame::model()->findAllByAttributes(array('game_id' => $id,
                'tern' => $tern));
            foreach ($logs as  $log)
            {
                if($log->result == NULL){
                    switch($log->action)
                    {
                        case 0: 
                            $log->result = 0;                        
                            break;
                        case 1: 
                            $map = GameMap::model()->findByAttributes(array('game_id' => $id));
                            for($i=1; $i <= 6; $i++)
                            {
                                if($map['user'.$i] == $log->user_id)
                                        if($i < 4)
                                            $team = 1;
                                        else 
                                            $team = 0;
                            }
                            $aim_id = $map['user'.(3*$team + $log->direction)];
                            $dodje = 0;
                            $aim = LogGame::model()->findByAttributes(array('game_id' => $id,
                                'user_id' => $aim_id,
                                'tern' => $tern));
                            if($aim != NULL)
                            {
                                if($aim->action == 2) $dodje = 60;
                                if(mt_rand(0, 99)  > 40 + $dodje) $log->result = 1;
                                else $log->result = 0;
                                if ($aim->action == 0) $log->result = 1;
                            }
                            else $log->result = 1;

                            break;
                        case 2:
                            $log->result = 1;
                            break;
                        case 3:
                            $log->result = 1;
                            break;
                    }
                    $log->save();
                }   
            }            
        }
        
        public function actionTern($id){
            $logs = LogGame::model()->findAllByAttributes(array('game_id' => $id,
                   'user_id' => (Yii::app()->user->getId()),
                ));
            $mylog = array();
            foreach ($logs as $log)
            {
                $mylog[$log->id]=array(
                    'user' => $log->user_id,
                    'tern' => $log->tern,
                    'action' => $log->action,
                    'direction' => $log->direction  
                );
            }
            echo json_encode($mylog);
            Yii::app()->end();
        }
        
         public function actionGamePolling($id){
             $logs = LogGame::model()->findAllByAttributes(array('game_id' => $id,
                   'user_id' => (Yii::app()->user->getId()),
              ));
             $tern = count($logs);
             $logs = LogGame::model()->findAllByAttributes(array('game_id' => $id,
                   'tern' => $tern,
              ));
             $timer = GameMap::model()->findByAttributes(array('game_id' => $id));
             if(count($logs) == 6){
                 $mylog = array();
                foreach ($logs as $log)
                {
                    $mylog[$log->id]=array(
                        'user' => $log->user_id,
                        'tern' => $log->tern,
                        'action' => $log->action,
                        'direction' => $log->direction,
                        'result' => $log->result
                    );
                }
                echo json_encode($mylog);
                $timer->time = time();
                $timer->save();
             }else{
                 if($timer->time + 80 < time())
                 {
                    $this->makeResult($id,$tern);
                    for($i = 1; $i < 7; $i++)
                    {
                        $exist = LogGame::model()->findByAttributes(array(
                            'game_id' => $id,
                            'tern' => $tern,
                            'user_id' => $timer['user'.$i]
                            ));
                        if($exist == NULL)
                        {
                            $exist = new LogGame();
                            $exist->action = 0;
                            $exist->game_id = $id;
                            $exist->user_id = $timer['user'.$i];
                            $exist->tern = $tern;
                            $exist->save();
                        }
                    }
                    
                     $logs = LogGame::model()->findAllByAttributes(array('game_id' => $id,
                            'tern' => $tern,
                      ));
                    $mylog = array();
                      foreach ($logs as $log)
                      {
                          $mylog[$log->id]=array(
                              'user' => $log->user_id,
                              'tern' => $log->tern . ' loolll',
                              'action' => $log->action,
                              'direction' => $log->direction,
                              'result' => $log->result
                          );
                      }
                      $timer->time = time();
                      $timer->save();
                      echo json_encode($mylog);
                      Yii::app()->end();
                 }
                echo json_encode(array('result' => $tern)); 
             }
             Yii::app()->end();
         }

         public function actionGiveMap($id){
             $model = GameMap::model()->findByAttributes(array('game_id' => $id));
             if ($model->user_count == 6)
             echo json_encode(array(
                 '1' => $model->user1,
                 'l1' => $model->userM1->login,
                 '2' => $model->user2,
                 'l2' => $model->userM2->login,
                 '3' => $model->user3,
                 'l3' => $model->userM3->login,
                 '4' => $model->user4,
                 'l4' => $model->userM4->login,
                 '5' => $model->user5,
                 'l5' => $model->userM5->login,
                 '6' => $model->user6,
                 'l6' => $model->userM6->login,
             ));
             else echo json_encode(array('count' => $model->user_count));
         }
         
        public function actionGamerExit($id)
        {
            $log = new LogGame();
            $log->user_id = Yii::app()->user->getId();
            $log->action = 0;
            for($i = 1; $i < 30; $i++)
            {
                $log->tern = $i;
                $log->save();
            }
        }
        
        public function actionGiveStats($id)
        {
            $wariors = array();
            for($i = 0; $i < 6; $i++)
                $wariors[$i] = 100;
            $logs = LogGame::model()->findAllByAttributes(array('game_id' => $id)); 
            $terns = count($logs) / 6;
            for($i = 1; $i <= $terns; $i++)
            {
                $logs = LogGame::model()->findAllByAttributes(array('game_id' => $id,
                    'tern' => $i));
                foreach ($logs as $log)
                {
                    $map = GameMap::model()->findByAttributes(array('game_id' => $id));
                    for($j=1; $j <= 6; $j++)
                        {
                            if($map['user'.$j] == $log->user_id)
                                    if($j < 4)
                                        $team = 1;
                                    else 
                                        $team = 0;
                        }
                        
                    if($log->action == 1 && $log->result == 1)
                    {
                        $place = $team * 3 + $log->direction - 1;
                        if($wariors[$place] > 20) $wariors[$place] -= 20;
                        else $wariors[$place] = 0;
                    }
                    if($log->action == 3)
                    {
                        $place = $team * 3 + $log->direction -1;
                        if($wariors[$place] < 75)$wariors[$place] += 15;
                        else $wariors[$place] = 100;
                    }
                }
            }
            $result = array(
                1 => $wariors[0],
                2 => $wariors[1],
                3 => $wariors[2],
                4 => $wariors[3],
                5 => $wariors[4],
                6 => $wariors[5],
            );
            echo json_encode($result);
        }  
        
        public function actionEndGame($id)
        {
            $result = $this->actionGiveStats($id);
            $map = GameMap::model()->findByAttributes(array('game_id' => $id));
            if($result[1] == 0 && $result[2] == 0 && $result[3] == 0)
            {
                for($i = 1; $i < 4; $i++){
                    $user = User::model()->findByPk($map['user'.$i]);
                    $user->raiting += 20;
                    $user->save();
                }
                for($i = 4; $i < 7; $i++){
                    $user = User::model()->findByPk($map['user'.$i]);
                    $user->raiting -= 20;
                    $user->save();
                }
                $game = Game::model()->findByPk($id);
                $game->game_status = 2;
                $game->save();
            }
            if($result[4] == 0 && $result[5] == 0 && $result[6] == 0)
            {
                for($i = 4; $i < 7; $i++){
                    $user = User::model()->findByPk($map['user'.$i]);
                    $user->rating += 20;
                    $user->save();
                }
                for($i = 1; $i < 4; $i++){
                    $user = User::model()->findByPk($map['user'.$i]);
                    $user->rating -= 20;
                    $user->save();
                }
                $game = Game::model()->findByPk($id);
                $game->game_status = 2;
                $game->save();
            }
        }
}
