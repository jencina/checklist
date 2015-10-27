<?php

/**
 * This is the model class for table "impresora".
 *
 * The followings are the available columns in table 'impresora':
 * @property integer $id
 * @property string $puerto
 * @property string $pdfcmon
 * @property string $usb001
 * @property string $ip
 * @property integer $checklist_id
 *
 * The followings are the available model relations:
 * @property Checklist $checklist
 */
class Impresora extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'impresora';
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
			array('puerto, pdfcmon, usb001, ip', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, puerto, pdfcmon, usb001, ip, checklist_id', 'safe', 'on'=>'search'),
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
			'puerto' => 'Puerto',
			'pdfcmon' => 'Pdfcmon',
			'usb001' => 'Usb001',
			'ip' => 'Ip',
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
		$criteria->compare('puerto',$this->puerto,true);
		$criteria->compare('pdfcmon',$this->pdfcmon,true);
		$criteria->compare('usb001',$this->usb001,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('checklist_id',$this->checklist_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Impresora the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
