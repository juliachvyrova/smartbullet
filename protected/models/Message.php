<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $id
 * @property integer $user_from
 * @property integer $user_to
 * @property integer $state
 * @property string $datetime
 * @property integer $del1
 * @property integer $del2
 * @property string $text
 *
 * The followings are the available model relations:
 * @property User $userFrom
 * @property User $userTo
 */
class Message extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_from, user_to, state, del1, del2', 'numerical', 'integerOnly' => true),
            array('datetime, text', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_from, user_to, state, datetime, del1, del2, text', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userFrom' => array(self::BELONGS_TO, 'User', 'user_from'),
            'userTo' => array(self::BELONGS_TO, 'User', 'user_to'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_from' => 'User From',
            'user_to' => 'User To',
            'state' => 'State',
            'datetime' => 'Datetime',
            'del1' => 'Del1',
            'del2' => 'Del2',
            'text' => 'Text',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_from', $this->user_from);
        $criteria->compare('user_to', $this->user_to);
        $criteria->compare('state', $this->state);
        $criteria->compare('datetime', $this->datetime, true);
        $criteria->compare('del1', $this->del1);
        $criteria->compare('del2', $this->del2);
        $criteria->compare('text', $this->text, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Message the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function countMessageTo($id) {

        $crit = new CDbCriteria;
        $crit->condition = 'user_to=:u AND del2=0';
        $crit->params = array(
            ':u' => $id,
        );

        $count = Message::model()->count($crit);
        return $count;
    }

    public static function countMessageFrom($id) {

        $crit = new CDbCriteria;
        $crit->condition = 'user_from=:u AND del1=0';
        $crit->params = array(
            ':u' => $id,
        );

        $count = Message::model()->count($crit); 
        return $count;
    }

    public static function countNew($id) {

        $crit = new CDbCriteria;
        $crit->condition = 'user_to=:u AND state=1 AND del2=0';
        $crit->params = array(
            ':u' => $id,
        );

        $count = Message::model()->count($crit); 
        return $count;
    }

}
