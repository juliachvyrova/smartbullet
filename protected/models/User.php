<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $brth
 * @property string $city
 * @property string $email
 * @property integer $rating
 * @property string $photo
 * @property string $data
 * @property string first_name
 * @property string last_name
 */
class User extends CActiveRecord
{       
    public $image;
    public $password2;
    public $password3;
    public $brth2;
    public $delPhoto;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('login, password, password2', 'required', 'on'=>'registration'),//пароль и логин обязательные поля
			array('password3, password2', 'required', 'on'=>'changePass'),//пароль и логин обязательные поля
			array('id, rating', 'numerical', 'integerOnly'=>true),
			array('login, city, email, first_name, last_name', 'length', 'max'=>32),
			array('password, password2, password3', 'length', 'max'=>40),
			array('password, password2, password3', 'length', 'min'=>3),
			array('login', 'length', 'min'=>5),            
            array('login', 'match', 'pattern'=>'/^[A-z][\w]+$/'),// Логин должен соответствовать шаблону          
            array('login', 'unique'),// Логин должен быть уникальным
			//array('photo', 'length', 'max'=>50),
			//array('password2', 'required'),
           // array('password2', 'length', 'min'=>3, 'max'=>32),            // Длина повторного пароля не менее 3 символов
            // Пароль должен совпадать с повторным паролем для сценария регистрации
            array('password', 'compare', 'compareAttribute'=>'password2', 'on'=>'registration'),
			array('brth, brth2, data', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, password, brth, city, email, rating, photo, data, first_name, last_name', 'safe', 'on'=>'search'),
            array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
           // array('image', 'file', 'types'=>'jpg, gif, png'),

                        // Почта проверяется на соответствие типу
            array('email', 'email'/*, 'on'=>self::SCENARIO_SIGNUP*/),
            // Почта должна быть в пределах от 6 до 50 символов
            array('email', 'length', 'min'=>6),
            // Почта должна быть уникальной
            //array('email', 'unique'),
            // Почта должна быть написана в нижнем регистре
            array('email', 'filter', 'filter'=>'mb_strtolower'),
            //array('brth', 'date', 'format'=>'d.M.yyyy'),
            array('brth2', 'date', 'format'=>'d.M.yyyy'),
            array('delPhoto', 'boolean'),
           // array('password2', 'password2'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'author_id'),
			'posts' => array(self::HAS_MANY, 'Post', 'wall_id', 'order'=>'datetime DESC'),
            'postsUser' => array(self::HAS_MANY, 'Post', 'author_id'),
            'user1' => array(self::HAS_MANY, 'Relationship', 'user1'),
            'user2' => array(self::HAS_MANY, 'Relationship', 'user2'),
            'relationship' => array(self::HAS_MANY, 'Relationship', 'user2'),
            'message_to' => array(self::HAS_MANY, 'Message', 'user_to'),
            'message_from' => array(self::HAS_MANY, 'Message', 'user_from'),
            'countPost'=>array(self::STAT, 'Post', 'wall_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Логин',
			'password' => 'Пароль',
			'password2' => 'Пароль',
			'brth' => 'Дата рождения',
						'brth2' => 'Дата рождения',
			'city' => 'Место жительства',
			'email' => 'Email',
			'rating' => 'Рейтинг',
			'photo' => 'Фото',
			'data' => 'Дата регистрации',
                        'first_name' => 'Имя',
                        'last_name' => 'Фамилия',
                        'image'=>'Фотография',
                        'delPhoto'=>'Удалить фотографию',
                                                'password3'=>'Новый пароль',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('brth',$this->brth,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('data',$this->data,true);
                $criteria->compare('first_name',$this->first_name,true);
                $criteria->compare('last_name',$this->last_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function Top()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
                $dataProvider=new CActiveDataProvider('User', array(

                            'criteria'=>array(
                                    'order'=>'rating DESC',
                                'limit'=>'10',
                            ),
                                ));
                return $dataProvider;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        protected function beforeSave(){
        //     print_r($this->brth);
        	//$this->password=CPasswordHelper::hashPassword($this->password);

        	if (Yii::app()->user->isGuest)$this->password=crypt($this->password);     
        	if (!Yii::app()->user->isGuest && $this->password3!="") $this->password=crypt($this->password3);             


            if(!parent::beforeSave())
                return false;


                
            	if ($this->image==null && Yii::app()->user->isGuest){$this->photo = 'nophoto.jpg' ;return true;}
            	else if($this->image ){
            		if ($this->photo!='nophoto.jpg' && (!Yii::app()->user->isGuest)){
            			$oldfile=$this->photo;
				if (file_exists(Yii::app()->basePath.'/../images/avatars/'. $oldfile) && is_file(Yii::app()->basePath.'/../images/avatars/'. $oldfile)){
						unlink(Yii::app()->basePath.'/../images/avatars/'. $oldfile);
            		}}
                $name=Image::newName($this->image->name);
                $this->image->saveAs(Yii::getPathOfAlias('webroot.images.avatars').DIRECTORY_SEPARATOR.$name);
                $this->photo = $name;
            }

        		if ($this->delPhoto==true) {
        			$oldfile=$this->photo;
					if (file_exists(Yii::app()->basePath.'/../images/avatars/'. $oldfile)){
						unlink(Yii::app()->basePath.'/../images/avatars/'. $oldfile);
					}
        			$this->photo = 'nophoto.jpg';}


					                
					//CPasswordHelper::hashPassword($this->password);
               // $this->password = $this->hashPassowrd($this->password, $this->salt);
                //$this->brth=strtotime($this->brth);
                //$b=strtotime($this->brth);
				//$this->brth=date('Y-m-d', $b);
                //$this->brth = date('Y-m-d', strtotime($this->brth));//strtotime($this->date_start);
                //$this->password = $this->hashPassword($this->password);
            //$this->photo=Image::saveImg($this->image);
        
       // if(($this->scenario=='insert' || $this->scenario=='update') &&
        //    ($document=CUploadedFile::getInstance($this,'document'))){
        //    $this->deleteDocument(); // старый документ удалим, потому что загружаем новый
 
        //    $this->document=$document;
         //   $this->document->saveAs(
          //      Yii::getPathOfAlias('webroot.media').DIRECTORY_SEPARATOR.$this->document);
        
            return true;
        }

        protected function afterFind() {
        	if ($this->brth==null) $this->brth2=null;
        	else{
   			$date = date('d.m.Y', strtotime($this->brth));
   			$this->brth2 = $date;}
		}


    public static function getPhoto($id){
            
            $crit=new CDbCriteria;
                $crit->condition='id=:u';
                $crit->params=array(
                    ':u'=>$id,
                );

                $count= User::model()->count($crit);//return false; 
                if($count==1){             
                $user=User::model()->find($crit);
                return $user->photo;}
                //$count= Relationship::model()->count($crit);//return false;
                //echo ($count);
                else 
               	return false;
            
        } 


	public static function countLogin($login){
    
   		$crit=new CDbCriteria;
        $crit->condition="login LIKE :u OR first_name LIKE :u OR last_name LIKE :u";
        $crit->params=array(
            ':u'=>"%".$login."%",//':u'=>"%".$login."%",
        );
        
        $count= User::model()->count($crit);//return false;
        //echo ($count);
        return $count;
    }  

    public function password2(){
    	if (crypt( $this->password2, $this->password)!== $this->password)
    	{$this->addError('password2','Неверный пароль!'); return false;}
    return true;
    }
    
    


}
