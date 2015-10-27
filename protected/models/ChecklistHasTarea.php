<?php

/**
 * This is the model class for table "checklist_has_tarea".
 *
 * The followings are the available columns in table 'checklist_has_tarea':
 * @property integer $checklist_id
 * @property integer $tarea_id
 * @property integer $estado_id
 */
class ChecklistHasTarea extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'checklist_has_tarea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('checklist_id, tarea_id, estado_id', 'required'),
			array('checklist_id, tarea_id, estado_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('checklist_id, tarea_id, estado_id', 'safe', 'on'=>'search'),
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
            'tarea'     => array(self::BELONGS_TO, 'Tarea', 'tarea_id'),
            'localidad' => array(self::BELONGS_TO, 'Localidad', 'localidad_id'),
            'estado'    => array(self::BELONGS_TO, 'Estado', 'estado_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'checklist_id' => 'Checklist',
			'tarea_id' => 'Tarea',
			'estado_id' => 'Estado',
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

		$criteria->compare('checklist_id',$this->checklist_id);
		$criteria->compare('tarea_id',$this->tarea_id);
		$criteria->compare('estado_id',$this->estado_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ChecklistHasTarea the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
