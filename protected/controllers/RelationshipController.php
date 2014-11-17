<?php

class RelationshipController extends Controller
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
				'actions'=>array('index','view','del'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','stopFolow','add','seeFolow'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Relationship;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Relationship']))
		{
			$model->attributes=$_POST['Relationship'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Relationship']))
		{
			$model->attributes=$_POST['Relationship'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$u1=Yii::app()->user->getId();
        $crit=new CDbCriteria;
        $crit->condition='user1=:u AND type=0';
        $crit->params=array(
            ':u'=>$u1,
        );
        
        //$count=  Relationship::model()->count($crit);
        //echo ($count);
            
        $model=  Relationship::model()->find($crit);
		//$dataProvider=new CActiveDataProvider('Relationship');
               
		$this->render('index',array(
			'$model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Relationship('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Relationship']))
			$model->attributes=$_GET['Relationship'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Relationship the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Relationship::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Relationship $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='relationship-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

 	/*public function actionLook()
    {

    }*/

        
        public function actionAdd()
        {
            //echo "Julia!";
            if (isset($_POST["newFriend"]))
            {   
                
                $u1=Yii::app()->user->getId();
                $u2=$_POST["newFriend"];
                $crit=new CDbCriteria;
                $crit->condition='user1=:u AND user2=:f AND type=2';
                $crit->params=array(
                    ':u'=>$u1,
                    ':f'=>$u2,
                );
                
                $count=  Relationship::model()->count($crit);
                //echo ($count);
               if ($count>0)
                {
                    $crit=new CDbCriteria;
                    $crit->condition='user1=:u AND user2=:f';
                    $crit->params=array(
                        ':u'=>$u1,
                        ':f'=>$u2,
                    );
                    
                    $model=  Relationship::model()->find($crit);
                    $model->type=0;
                    $model->state=0;
                    if($model->validate()){
                        $model->save();
                    }
                    
                    $crit=new CDbCriteria;
                    $crit->condition='user1=:f AND user2=:u';
                    $crit->params=array(
                        ':u'=>$u1,
                        ':f'=>$u2,
                    );
                    
                    $model=  Relationship::model()->find($crit);
                    $model->type=0;
                    $model->state=0;
                    if($model->validate()){
                        $model->save();
                    }

                    echo 'New friend!';
                   
                } 
                
                else{
                    $model=new Relationship;
                    $model->user1=$u1;
                    $model->user2=$u2;
                    $model->type=1;
                    $model->state=1;
                    if($model->validate()){
                        $model->save();
                    }
                    
                    $model=new Relationship;
                    $model->user1=$u2;
                    $model->user2=$u1;
                    $model->type=2;
                    $model->state=1;
                    if($model->validate()){
                        $model->save();
                    }
                    
                    echo 'folower';
                }
               // echo "Julia!";
                Yii::app()->end();
            }
        }


        public function actionStopFolow()
        {
        	echo "stop!";
        	if (isset($_POST["friend"]))
            {   
                
                $u1=Yii::app()->user->getId();
                $u2=$_POST["friend"];
                $crit=new CDbCriteria;
                $crit->condition='user1=:u AND user2=:f';
                $crit->params=array(
                    ':u'=>$u1,
                    ':f'=>$u2,
                );
                    
                    $model=  Relationship::model()->find($crit);
                    $model->delete();
                    
                    
                    $crit=new CDbCriteria;
                    $crit->condition='user1=:f AND user2=:u';
                    $crit->params=array(
                        ':u'=>$u1,
                        ':f'=>$u2,
                    );
                    
                    $model=  Relationship::model()->find($crit);
                    $model->delete();

                    echo 'You stop folow!';
                   
                /*} 
                
                else{
                    $model=new Relationship;
                    $model->user1=$u1;
                    $model->user2=$u2;
                    $model->type=1;
                    if($model->validate()){
                        $model->save();
                    }
                    
                    $model=new Relationship;
                    $model->user1=$u2;
                    $model->user2=$u1;
                    $model->type=2;
                    if($model->validate()){
                        $model->save();
                    }
                    
                    echo 'folower';
                }*/
               // echo "Julia!";
                Yii::app()->end();
            }
        }




        public function actionSeeFolow()
        {
            if (isset($_POST["friend"]))
            {   
                
                $u1=Yii::app()->user->getId();
                $u2=$_POST["friend"];
                $crit=new CDbCriteria;
                $crit->condition='user1=:u AND user2=:f';
                $crit->params=array(
                    ':u'=>$u1,
                    ':f'=>$u2,
                );
               
                    $model=  Relationship::model()->find($crit);
                    $model->state=0;
                    if($model->validate()){
                        $model->save();
                    }
                    
                    $crit=new CDbCriteria;
                    $crit->condition='user1=:f AND user2=:u';
                    $crit->params=array(
                        ':u'=>$u1,
                        ':f'=>$u2,
                    );
                    
                    $model=  Relationship::model()->find($crit);
                    $model->state=0;
                    if($model->validate()){
                        $model->save();                    
                    }
                    Yii::app()->end();
            }
        }








        public function actionDel()
        {
        	//echo "Del!";
        	if (isset($_POST["friend"]))
            {   
                            echo "Del2!";
                $u1=Yii::app()->user->getId();
                $u2=$_POST["friend"];
                $crit=new CDbCriteria;
                $crit->condition='user1=:u AND user2=:f AND type=0';
                $crit->params=array(
                    ':u'=>$u1,
                    ':f'=>$u2,
                );
                
               /* $count=  Relationship::model()->count($crit);
                //echo ($count);
               if ($count>0)
                {
                    $crit=new CDbCriteria;
                    $crit->condition='user1=:u AND user2=:f';
                    $crit->params=array(
                        ':u'=>$u1,
                        ':f'=>$u2,
                    );*/
                    
                    $model=  Relationship::model()->find($crit);
                    $model->type=2;
                    if($model->validate()){
                        $model->save();
                    }
                    
                    $crit=new CDbCriteria;
                    $crit->condition='user1=:f AND user2=:u AND type=0';
                    $crit->params=array(
                        ':u'=>$u1,
                        ':f'=>$u2,
                    );
                    
                    $model=  Relationship::model()->find($crit);
                    $model->type=1;
                    if($model->validate()){
                        $model->save();
                    }

                    echo 'You stop folow!';
                   
                Yii::app()->end();
            }
        }
        
}
