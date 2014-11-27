<?php

class InviteController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'del', 'newGame'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Invite;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Invite'])) {
            $model->attributes = $_POST['Invite'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Invite'])) {
            $model->attributes = $_POST['Invite'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $id = Yii::app()->user->getId();
        $dataProvider = new CActiveDataProvider('Invite', array(
            'pagination' => array('pageSize' => 10),
            'criteria' => array(
                'with' => array(
                    'games' => array('alias' => 'pu')
                ),
                'condition' => ' user2=' . $id . ' AND pu.game_status=0',
                //'distinct'=>true,
                'together' => true,
            ),
                )
        );
        $count = Invite::newInvite($id);

        if ($count == 0)
            $title = "У вас нет приглашений";
        else
            $title = "Приглашения в игру (" . $count . ")";

        $this->render('index', array(
            'model' => $dataProvider,
            'title' => $title,
        ));
    }

    public function actionDel() {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $crit = new CDbCriteria;
            $crit->condition = 'id=:i';
            $crit->params = array(
                ':i' => $id,
            );
            $model = Invite::model()->find($crit);

            $model->delete();

            echo 'Приглашение отменено';
            Yii::app()->end();
        }
    }

    /**
     * Manages all models.
     */
    public function actionNewGame() {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $game = new Game();
            $game->game_status = 0;
            $game->save();
            $invite = new Invite();
            $invite->user1 = Yii::app()->user->getId();
            $invite->user2 = $id;
            $invite->game = $game->id;
            $invite->save();
            echo $game->id;
            Yii::app()->end();
        }
    }

    public function actionAdmin() {
        $model = new Invite('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Invite']))
            $model->attributes = $_GET['Invite'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Invite the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Invite::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Invite $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'invite-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
