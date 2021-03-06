<?php

class UserController extends Controller {

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('top', 'index', 'create', 'update', 'view', 'friends', 'serch', 'requests', 'myRequests', 'find', 'changePass', 'top'),
                'users' => array('@'),
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
        $dataProvider = new CActiveDataProvider('Post', array(
            'pagination' => array('pageSize' => 5),
            'criteria' => array(
                'order'=>'datetime DESC',
                'with' => array(
                    'user' => array('alias' => 'pu')
                ),
                'condition' => ' wall_id=' . $id,
                'together' => true,
            ),
                )
        );



        $this->render('view', array(
            'model' => $this->loadModel($id),
            'post' => $dataProvider,
        ));
    }

    public function actionFriends() {
        $id = Yii::app()->user->getId();
        $dataProvider = new CActiveDataProvider('User', array(
            'pagination' => array('pageSize' => 10),
            'criteria' => array(
                'with' => array(
                    'relationship' => array('alias' => 'pu')
                ),
                'condition' => ' pu.user1=' . $id . ' AND pu.type=0',
                'together' => true,
            ),
                )
        );
        $count = Relationship::countFriends($id);

        if ($count == 0)
            $title = "У вас пока нет друзей";
        else
            $title = "Друзья (" . $count . ")";

        $this->render('friends', array(
            'model' => $dataProvider,
            'count' => Relationship::countFriends($id),
            'title' => $title,
        ));
    }

    public function actionRequests() {
        $id = Yii::app()->user->getId();
        $dataProvider = new CActiveDataProvider('User', array(
            'pagination' => array('pageSize' => 10),
            'criteria' => array(
                'with' => array(
                    'relationship' => array('alias' => 'pu')
                ),
                'condition' => ' pu.user1=' . $id . ' AND pu.type=2',
                'together' => true,
            ),
                )
        );
        $count = Relationship::countRequests($id);

        if ($count == 0)
            $title = "У вас пока нет заявок";
        else
            $title = "Заявки в друзья (" . $count . ")";

        $this->render('friends', array(
            'model' => $dataProvider,
            'count' => Relationship::countFriends($id),
            'title' => $title,
        ));
    }

    public function actionMyRequests() {
        $id = Yii::app()->user->getId();
        $dataProvider = new CActiveDataProvider('User', array(
            'pagination' => array('pageSize' => 10),
            'criteria' => array(
                'with' => array(
                    'relationship' => array('alias' => 'pu')
                ),
                'condition' => ' pu.user1=' . $id . ' AND pu.type=1',
                'together' => true,
            ),
                )
        );
        $count = Relationship::countMyRequests($id);

        if ($count == 0)
            $title = "Вы пока не подавали заявок";
        else
            $title = "Мои заявки в друзья (" . $count . ")";

        $this->render('friends', array(
            'model' => $dataProvider,
            'count' => Relationship::countFriends($id),
            'title' => $title,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
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
    public function actionUpdate() {
        $id = $id = Yii::app()->user->getId();
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            //echo "string ";
            $model->image = CUploadedFile::getInstance($model, 'image');
            $model->attributes = $_POST['User'];
            if ($model->brth2 == NULL)
                $model->brth = NULL;
            else {
                $b = strtotime($model->brth2);
                $b = date('Y-m-d', $b);
                $model->brth = $b;
                $model->brth2 = NULL;
            }

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }


        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionChangePass() {

        $id = $id = Yii::app()->user->getId();
        $model = $this->loadModel($id);
        $model->setScenario('changePass');

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->password2()) {

                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }


        $this->render('changePass', array(
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
        $dataProvider = new CActiveDataProvider('User', array(
            'pagination' => array('pageSize' => 10),
        ));



        $this->render('search', array(
            'model' => $dataProvider,
            'count' => "0",
            'title' => "Все пользователи",
        ));
    }

    public function actionFind() {
        if (isset($_POST["login"])) {
            $login = $_POST["login"];
            $dataProvider = new CActiveDataProvider('User', array(
                'pagination' => array('pageSize' => 10),
                'criteria' => array(
                    'condition' => "login LIKE '%$login%' OR first_name LIKE '%$login%' OR last_name LIKE '%$login%'",
                    'order' => 'rating DESC',
                ),
            ));


            $count = User::countLogin($login);
            $this->render('search', array(
                'model' => $dataProvider,
                'count' => $count,
                'title' => "Поиск по <i>" . $login . "</i> (" . $count . ")",
            ));
        }
    }

    /**
     * Manages all models.
     */
    public function actionTop() {
        $model = User::Top();
        $this->render('top', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGo() {
        echo "string";
    }

}
