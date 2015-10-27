<?php

/**
 * This is the model class for table "foto".
 *
 * The followings are the available columns in table 'foto':
 * @property integer $id
 * @property string $antes_1
 * @property string $antes_2
 * @property string $antes_3
 * @property string $antes_4
 * @property string $despues_1
 * @property string $despues_2
 * @property string $despues_3
 * @property string $despues_4
 * @property integer $checklist_id
 *
 * The followings are the available model relations:
 * @property Checklist $checklist
 */
class Foto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'foto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('checklist_id', 'required'),
			array('checklist_id', 'numerical', 'integerOnly'=>true),
			array('antes_1, antes_2, antes_3, antes_4, despues_1, despues_2, despues_3, despues_4', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, antes_1, antes_2, antes_3, antes_4, despues_1, despues_2, despues_3, despues_4, checklist_id', 'safe', 'on'=>'search'),
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
			'checklist' => array(self::BELONGS_TO, 'Checklist', 'checklist_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'antes_1' => 'Antes 1',
			'antes_2' => 'Antes 2',
			'antes_3' => 'Antes 3',
			'antes_4' => 'Antes 4',
			'despues_1' => 'Despues 1',
			'despues_2' => 'Despues 2',
			'despues_3' => 'Despues 3',
			'despues_4' => 'Despues 4',
			'checklist_id' => 'Checklist',
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
		$criteria->compare('antes_1',$this->antes_1,true);
		$criteria->compare('antes_2',$this->antes_2,true);
		$criteria->compare('antes_3',$this->antes_3,true);
		$criteria->compare('antes_4',$this->antes_4,true);
		$criteria->compare('despues_1',$this->despues_1,true);
		$criteria->compare('despues_2',$this->despues_2,true);
		$criteria->compare('despues_3',$this->despues_3,true);
		$criteria->compare('despues_4',$this->despues_4,true);
		$criteria->compare('checklist_id',$this->checklist_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Foto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
