<?php

/**
 * This is the model class for table "log_game".
 *
 * The followings are the available columns in table 'log_game':
 * @property integer $id
 * @property integer $game_id
 * @property integer $user_id
 * @property integer $action
 * @property integer $direction
 * @property integer $result
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Game $game
 */
class LogGame extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log_game';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('game_id, user_id, action, direction, result, tern', 'numerical' ,'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, game_id, user_id, action, direction, result', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'game' => array(self::BELONGS_TO, 'Game', 'game_id'),
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
			'user_id' => 'User',
			'action' => 'Action',
			'direction' => 'Direction',
			'result' => 'Result',
                        'tern' => 'Tern',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('action',$this->action);
		$criteria->compare('direction',$this->direction);
		$criteria->compare('result',$this->result);
                $criteria->compare('tern',$this->tern);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogGame the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
