<?php

/**
 * This is the model class for table "game_map".
 *
 * The followings are the available columns in table 'game_map':
 * @property integer $id
 * @property integer $game_id
 * @property integer $user_count
 * @property integer $user1
 * @property integer $user2
 * @property integer $user3
 * @property integer $user4
 * @property integer $user5
 * @property integer $user6
 */
class GameMap extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'game_map';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('game_id, user_count, user1, user2, user3, user4, user5, user6, time', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, game_id, user_count, user1, user2, user3, user4, user5, user6, time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'game' => array(self::BELONGS_TO, 'Game', 'game_id'),
                    'userM1' => array(self::BELONGS_TO, 'User', 'user1'),
                    'userM2' => array(self::BELONGS_TO, 'User', 'user2'),
                    'userM3' => array(self::BELONGS_TO, 'User', 'user3'),
                    'userM4' => array(self::BELONGS_TO, 'User', 'user4'),
                    'userM5' => array(self::BELONGS_TO, 'User', 'user5'),
                    'userM6' => array(self::BELONGS_TO, 'User', 'user6'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'game_id' => 'Game',
			'user_count' => 'User Count',
			'user1' => 'User1',
			'user2' => 'User2',
			'user3' => 'User3',
			'user4' => 'User4',
			'user5' => 'User5',
			'user6' => 'User6',
                        'time' => 'Time'
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
		$criteria->compare('game_id',$this->game_id);
		$criteria->compare('user_count',$this->user_count);
		$criteria->compare('user1',$this->user1);
		$criteria->compare('user2',$this->user2);
		$criteria->compare('user3',$this->user3);
		$criteria->compare('user4',$this->user4);
		$criteria->compare('user5',$this->user5);
		$criteria->compare('user6',$this->user6);
                $criteria->compare('time',$this->time);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GameMap the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
