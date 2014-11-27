<?php

class CommentController extends Controller
{
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('add','del'),
				'users'=>array('@'),
			),
                        array('deny', // allow authenticated user to perform 'create' and 'update' actions

                                'users'=>array('*'),
			),
		);
	}

	
	public function loadModel($id)
	{
		$model=Comment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAdd()
    {
        if (isset($_POST["wall"]) && isset($_POST["text1"]))
        {       
            $author=Yii::app()->user->getId();
            $text=$_POST["text1"];
            $post=$_POST["wall"];
            $time=date("y-m-d H:i:s");
            $model=new Comment;
            $model->author_id=$author;
            $model->text=$text;
            $model->post_id=$post;
            $model->datetime=$time;
	        if($model->validate()) {
                $model->save();
            }
            Yii::app()->end();
        }
    }

    public function actionDel()
    {
    	if (isset($_POST["comment"]))
        {   
            $num=$_POST["comment"];
            $crit=new CDbCriteria;
            $crit->condition='id=:comment';                
            $crit->params=array(
                'comment'=>$num,
            );
            $model=  Comment::model()->find($crit);
            $model->delete();              
            Yii::app()->end();
        }
    }
}
