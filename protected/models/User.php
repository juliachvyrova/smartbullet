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
			array('id, rating', 'numerical', 'integerOnly'=>true),
			array('login, password, city, email, first_name, last_name', 'length', 'max'=>32),
			array('photo', 'length', 'max'=>50),
			array('brth, data', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, password, brth, city, email, rating, photo, data, first_name, last_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'author_id'),
			'posts' => array(self::HAS_MANY, 'Post', 'wall_id'),
                    	'postsUser' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'password' => 'Password',
			'brth' => 'День рождения',
			'city' => 'Место жительства',
			'email' => 'Email',
			'rating' => 'Рейтинг',
			'photo' => 'Фото',
			'data' => 'Дата регистрации',
                        'first_name' => 'Имя',
                        'last_name' => 'Фамилия',
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
}
