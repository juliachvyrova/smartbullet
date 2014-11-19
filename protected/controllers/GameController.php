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
				'actions'=>array('index','view','chatPolling','fight','tern','gamePolling'),
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
                $mod->user_count = 1;
                $mod->user1 = Yii::app()->user->getId();
                $mod->save();
            }else{
                if($exists->user_count < 6)
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
                        $exists->save();
                    }

                }else{//game is full
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
            $rand = mt_rand(0, 100);
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
            $this->makeResult($id,$tern);
            // return all log in json
            $model = $this->loadModel($id);
            $result = array();
            foreach ($model->loggame as $log){
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
            foreach ($logs as $key => $log)
            {
                if($log->result == NULL){
                    switch($log->action)
                    {
                        case 0: 
                            $log->result = 0;                        
                            break;
                        case 1: 
                            if(mt_rand(0, 99) > 40) $log->result = 1;
                            else $log->result = 0;
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
            //findAllByAttributes
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
           // echo var_dump($logs);
            echo json_encode($mylog);
            Yii::app()->end();
        }
        
         public function actionGamePolling($id){
             
             Yii::app()->end();
         }
}
