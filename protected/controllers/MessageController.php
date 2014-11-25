<?php

class MessageController extends Controller
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(/*'index',*/),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(/*'create','update',*/'to','from','readNew','add','del','newMessage','view'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{		
		$model=$this->loadModel($id);
		if ($model->userFrom->id!=Yii::app()->user->getId() && $model->userTo->id!=Yii::app()->user->getId()) {
			throw new CHttpException(404,'The requested page does not exist.');
		}	
		if (Yii::app()->user->getId()==$model->userFrom->id) { 
			$title="Сообщение для "; 
			$u=$model->userTo;
		} else {
			$title="Сообщение от "; 			
			$u=$model->userFrom;
		}
		$this->render('view',array(
			'model'=>$model,
			'title'=>$title,
			'user'=>$u,
		));
	}

	public function actionNewMessage($user)
	{
		$crit=new CDbCriteria;
        $crit->condition='id=:u';
        $crit->params=array(
           ':u'=>$user,
        );
        $count= User::model()->count($crit);
        if($count==1) {             
        	$userTo=User::model()->find($crit);
    	} else {
       		return false;
       	}           
		$this->render('newMessage',array(
			'title'=>"Сообщение для ",
			'user'=>$userTo,
		));
	}





	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	/*public function actionCreate()
	{
		$model=new Message;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	/*public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	/*public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}*/

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Message');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/

	/**
	 * Manages all models.
	 */
	/*public function actionAdmin()
	{
		$model=new Message('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Message']))
			$model->attributes=$_GET['Message'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}*/

	public function actionTo()
	{
		$id=Yii::app()->user->getId();
		$dataProvider=new CActiveDataProvider('Message', array(
			'pagination'=>array('pageSize'=>10),
			'criteria'=>array(
				'condition'=>'user_to='.$id.' AND del2=0',
				'order'=>'datetime DESC',
			),
		));
		$count=  Message::countMessageTo($id);
		if ($count==0) {
			$title="У вас нет входящих сообщений";
		} else { 
			$title="Входящие сообщения (".$count.")";
		}
		$this->render('index1',array(
			'model'=>$dataProvider,
			'count'=>$count,
			'title'=>$title,
		));
	}

	public function actionFrom()
	{
		$id=Yii::app()->user->getId();
		$dataProvider=new CActiveDataProvider('Message', array(
			'pagination'=>array('pageSize'=>10),
			'criteria'=>array(
				'condition'=>'user_from='.$id." AND del1=0",
				'order'=>'datetime DESC',
			),
		));
		$count=  Message::countMessageFrom($id);
		if ($count==0) {
			$title="У вас нет исходящих сообщений";
		} else {
			$title="Исходящие сообщения (".$count.")";
		}

		$this->render('index2',array(
			'model'=>$dataProvider,
			'count'=>$count,
			'title'=>$title,
		));
	}


	public function actionReadNew()
    {
        if (isset($_POST["message"]))
        {   
            $id=$_POST["message"];
            $crit=new CDbCriteria;
            $crit->condition='id=:i';
            $crit->params=array(
                ':i'=>$id,
            );
            $model=  Message::model()->find($crit);
            if ($model->user_to==Yii::app()->user->getId()) {
                $model->state=0;

                if($model->validate()) {
                    $model->save();
                }
                Yii::app()->end();
            }
        }
    }



        public function actionAdd()
        {
            if (isset($_POST["text"]) && isset($_POST["user"]))
            {   
                $from=Yii::app()->user->getId();
                $to=$_POST["user"];
                $text=$_POST["text"];
                $model=new Message;
                $model->user_from=$from;
                $model->user_to=$to;
                $model->state=1;
                $model->del1=0;
                $model->del2=0;
                $model->text=$text;
                $time=date("y-m-d H:i:s");
                $model->datetime=$time;
                if($model->validate()) {
                    $model->save();
                    echo 'Сообщение успешно отправлено!';
                } else {
                	echo "Ошибка при отправке сообщения!";
                }
            	Yii::app()->end();
            }
        }


        public function actionDel()
        {
            if (isset($_POST["message"]))
            {       
                $user=Yii::app()->user->getId();
                $message=$_POST["message"];
                $crit=new CDbCriteria;
                $crit->condition='id=:i';
                $crit->params=array(
                    ':i'=>$message,
                );
                $model=  Message::model()->find($crit);
                if ($model->user_from==$user) {
                	$model->del1=1;
                } else {
                    $model->del2=1;
                }

                if ($model->del1==1 && $model->del2==1) {
                	$model->delete();
                } else {
	                if($model->validate()) {
	                    $model->save();
	                } else {
	                	echo "Ошибка при удалении!";
	                }
	            }
                
                echo 'Сообщение удалено';
                Yii::app()->end();
            }
        }






	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Message the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Message::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Message $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='message-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}



	
}
