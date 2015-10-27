<?php

/**
 * This is the model class for table "informacion_equipo".
 *
 * The followings are the available columns in table 'informacion_equipo':
 * @property integer $id
 * @property string $ram
 * @property string $disco
 * @property integer $cpu_id
 * @property integer $monitor_id
 * @property integer $checklist_id
 *
 * The followings are the available model relations:
 * @property Checklist $checklist
 * @property Cpu $cpu
 * @property Monitor $monitor
 */
class InformacionEquipo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'informacion_equipo';
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
			array('cpu_id, monitor_id, checklist_id', 'numerical', 'integerOnly'=>true),
			array('ram, disco', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ram, disco, cpu_id, monitor_id, checklist_id', 'safe', 'on'=>'search'),
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
			'cpu' => array(self::BELONGS_TO, 'Cpu', 'cpu_id'),
			'monitor' => array(self::BELONGS_TO, 'Monitor', 'monitor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ram' => 'Ram',
			'disco' => 'Disco',
			'cpu_id' => 'Cpu',
			'monitor_id' => 'Monitor',
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
		$criteria->compare('ram',$this->ram,true);
		$criteria->compare('disco',$this->disco,true);
		$criteria->compare('cpu_id',$this->cpu_id);
		$criteria->compare('monitor_id',$this->monitor_id);
		$criteria->compare('checklist_id',$this->checklist_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InformacionEquipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
