<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        if (!Yii::app()->user->isGuest)
            $this->redirect(array('/user/view', 'id' => Yii::app()->user->GetId()));
        else
            $this->redirect(array('login'));;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    
    public function actionLogin() {
        if (Yii::app()->user->isGuest) {
            $model = new LoginForm;

            // if it is ajax validation request
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }

            // collect user input data
            if (isset($_POST['LoginForm'])) {
                $model->attributes = $_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate() && $model->login())
                    $this->redirect(Yii::app()->user->returnUrl);
            }
            // display the login form
            $this->render('login', array('model' => $model));
        } else {
            $this->redirect(array('/user/view', 'id' => Yii::app()->user->GetId()));
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionRegistration() {
        $model = new User;
        $model->setScenario('registration');

        if (isset($_POST['User'])) {
            $model->image = CUploadedFile::getInstance($model, 'image');
            $model->attributes = $_POST['User'];
            $model->data = date("Y-m-d");
            $model->rating = 0;
            if ($model->brth2 == NULL) {
                $model->brth = NULL;
            } else {
                $b = strtotime($model->brth2);
                $b = date('Y-m-d', $b);
                $model->brth = $b;
            }
            if ($model->save()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('registration', array(
            'model' => $model,
        ));
    }

    public function actionRules() {
        $this->render('rules');
    }

}
