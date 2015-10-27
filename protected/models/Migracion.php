<?php

/**
 * This is the model class for table "migracion".
 *
 * The followings are the available columns in table 'migracion':
 * @property integer $id
 * @property integer $cpu_id_antes
 * @property integer $monitor_id_antes
 * @property string $ram_antes
 * @property string $disco_antes
 * @property integer $cpu_id_despues
 * @property integer $monitor_id_despues
 * @property integer $checklist_id
 * @property string $ram_despues
 * @property string $disco_despues
 *
 * The followings are the available model relations:
 * @property Checklist $checklist
 * @property Cpu $cpuIdAntes
 * @property Cpu $cpuIdDespues
 * @property Monitor $monitorIdAntes
 * @property Monitor $monitorIdDespues
 */
class Migracion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'migracion';
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
			array('cpu_id_antes, monitor_id_antes, cpu_id_despues, monitor_id_despues, checklist_id', 'numerical', 'integerOnly'=>true),
			array('ram_antes, disco_antes, ram_despues, disco_despues', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cpu_id_antes, monitor_id_antes, ram_antes, disco_antes, cpu_id_despues, monitor_id_despues, checklist_id, ram_despues, disco_despues', 'safe', 'on'=>'search'),
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
			'cpuIdAntes' => array(self::BELONGS_TO, 'Cpu', 'cpu_id_antes'),
			'cpuIdDespues' => array(self::BELONGS_TO, 'Cpu', 'cpu_id_despues'),
			'monitorIdAntes' => array(self::BELONGS_TO, 'Monitor', 'monitor_id_antes'),
			'monitorIdDespues' => array(self::BELONGS_TO, 'Monitor', 'monitor_id_despues'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cpu_id_antes' => 'Cpu Id Antes',
			'monitor_id_antes' => 'Monitor Id Antes',
			'ram_antes' => 'Ram Antes',
			'disco_antes' => 'Disco Antes',
			'cpu_id_despues' => 'Cpu Id Despues',
			'monitor_id_despues' => 'Monitor Id Despues',
			'checklist_id' => 'Checklist',
			'ram_despues' => 'Ram Despues',
			'disco_despues' => 'Disco Despues',
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
		$criteria->compare('cpu_id_antes',$this->cpu_id_antes);
		$criteria->compare('monitor_id_antes',$this->monitor_id_antes);
		$criteria->compare('ram_antes',$this->ram_antes,true);
		$criteria->compare('disco_antes',$this->disco_antes,true);
		$criteria->compare('cpu_id_despues',$this->cpu_id_despues);
		$criteria->compare('monitor_id_despues',$this->monitor_id_despues);
		$criteria->compare('checklist_id',$this->checklist_id);
		$criteria->compare('ram_despues',$this->ram_despues,true);
		$criteria->compare('disco_despues',$this->disco_despues,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Migracion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
