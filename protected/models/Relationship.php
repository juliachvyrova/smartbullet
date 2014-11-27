<?php

/**
 * This is the model class for table "relationship".
 *
 * The followings are the available columns in table 'relationship':
 * @property integer $id
 * @property integer $user1
 * @property integer $user2
 * @property integer $type
 * @property integer $state
 *
 * The followings are the available model relations:
 * @property User $user20
 * @property User $user10
 */
class Relationship extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'relationship';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, user1, user2, type, state', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user1, user2, type, state', 'safe', 'on'=>'search'),
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
			'user20' => array(self::BELONGS_TO, 'User', 'user2'),
			'user10' => array(self::BELONGS_TO, 'User', 'user1'),
			'count'=>array(self::STAT, 'User', 'user1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user1' => 'User1',
			'user2' => 'User2',
			'type' => 'Type',
			'state' => 'State',
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
		$criteria->compare('user1',$this->user1);
		$criteria->compare('user2',$this->user2);
		$criteria->compare('type',$this->type);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Relationship the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


        
        
        public static function friends($u1,$u2){
            
            $crit=new CDbCriteria;
                $crit->condition='user1=:u AND user2=:f AND type=0';
                $crit->params=array(
                    ':u'=>$u1,
                    ':f'=>$u2,
                );
                
                $count= Relationship::model()->count($crit);//return false;
                //echo ($count);
                if ($count!=0) return true;
                else 
               	return false;
            
        } 

        public static function folow($u1,$u2){
            
            $crit=new CDbCriteria;
                $crit->condition='user1=:u AND user2=:f AND type=2';
                $crit->params=array(
                    ':u'=>$u1,
                    ':f'=>$u2,
                );
                
                $count= Relationship::model()->count($crit);//return false;
                //echo ($count);
                if ($count!=0) return true;
                else 
               	return false;
            
        } 


        public static function newFolow($u1,$u2){
            
            $crit=new CDbCriteria;
                $crit->condition='user1=:u AND user2=:f AND type=1 AND state=1';
                $crit->params=array(
                    ':u'=>$u1,
                    ':f'=>$u2,
                );
                
                $count= Relationship::model()->count($crit);
                if ($count==0) return false;
                else 
               	return true;
               	//return $count;
            
        } 


   		public static function noRelation($u1,$u2){
            
            $crit=new CDbCriteria;
                $crit->condition='user1=:u AND user2=:f';
                $crit->params=array(
                    ':u'=>$u1,
                    ':f'=>$u2,
                );
                
                $count= Relationship::model()->count($crit);//return false;
                //echo ($count);
                if ($count==0) return true;
                else 
               	return false;
            
        } 


        public static function countFriends($id){
            
            $crit=new CDbCriteria;
                $crit->condition='user1=:u AND type=0';
                $crit->params=array(
                    ':u'=>$id,
                );
                
                $count= Relationship::model()->count($crit);//return false;
                //echo ($count);
                return $count;
            
        } 

		public static function countRequests($id){
            
            $crit=new CDbCriteria;
                $crit->condition='user1=:u AND type=2';
                $crit->params=array(
                    ':u'=>$id,
                );
                
                $count= Relationship::model()->count($crit);//return false;
                //echo ($count);
                return $count;
            
        } 

        public static function newRequests($id){
            
            $crit=new CDbCriteria;
                $crit->condition='user1=:u AND type=2 AND state=1';
                $crit->params=array(
                    ':u'=>$id,
                );
                
                $count= Relationship::model()->count($crit);//return false;
                //echo ($count);
                return $count;
            
        }


        public static function countMyRequests($id){
            
            $crit=new CDbCriteria;
                $crit->condition='user1=:u AND type=1';
                $crit->params=array(
                    ':u'=>$id,
                );
                
                $count= Relationship::model()->count($crit);//return false;
                //echo ($count);
                return $count;
            
        }


        
}
