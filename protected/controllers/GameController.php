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
				'actions'=>array('index','view','polling','fight'),
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
		$this->render('view',array( //if it's first enter
			'model'=>$this->loadModel($id),
		));
	}

	public function actionPolling($id){
            
               $textmsg = $_POST['msg'];
               if($textmsg != ''){ //add messege
                  // $user_id = $_POST['user_id'];
                   $msg = new Chatmsg();
                   $msg->author_id = Yii::app()->user->getId();
                   $msg->text = $textmsg;
                   $msg->game_id = $id;
                   $msg->save();
               }
               $str = '';
               $model = $this->loadModel($id);
               foreach ($model->chatmsg as $chat){ //view all chat messeges
                       if($chat->author <> NULL){
                            $str.= '<span class="user_name">'.$chat->author->login.'</span>: ';
                            $str.= $chat->text.'<br>';
                      }
               } 
               if (isset($_POST['polling'])){ //if myscript.js calling
                   echo json_encode(array(
                       'result' => $str,
                   ));
               }else   echo $str;   
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
            $model = new LogGame();
            $model->game_id = $id;
            $model->user_id = Yii::app()->user->getId();
            $model->action = $_POST['value'];
            $model->direction = $_POST['select'];
            $model->tern = $_POST['tern'];
            $model->save();
            $model = $this->loadModel($id);
            $str = '';
            foreach ($model->loggame as $log){
                $str .= 'TERN: ' . $log->tern . ' ';
                $str .= 'USER: ' . $log->user_id . ' ';
                $str .= 'ACTION: ' . $log->action . ' ';
                $str .= 'DIRECTION: ' . $log->direction . "<br>";
            }
            echo json_encode(array(
                       'result' => $str,
                   ));
            Yii::app()->end();
        }
}
