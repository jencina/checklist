<?php

/**
 * This is the model class for table "localidad".
 *
 * The followings are the available columns in table 'localidad':
 * @property integer $id
 * @property string $direccion
 * @property integer $comuna_id
 * @property integer $region_id
 * @property integer $proyecto_id
 *
 * The followings are the available model relations:
 * @property Proyecto $proyecto
 * @property Comuna $comuna
 * @property Region $region
 */
class Localidad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'localidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('direccion, comuna_id, region_id', 'required'),
			array('comuna_id, region_id, proyecto_id', 'numerical', 'integerOnly'=>true),
			array('direccion', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, direccion, comuna_id, region_id, proyecto_id', 'safe', 'on'=>'search'),
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
			'proyecto' => array(self::BELONGS_TO, 'Proyecto', 'proyecto_id'),
			'comuna' => array(self::BELONGS_TO, 'Comuna', 'comuna_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
            'checklists' => array(self::HAS_MANY, 'Checklist', 'localidad_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'direccion' => 'Direccion',
			'comuna_id' => 'Comuna',
			'region_id' => 'Region',
			'proyecto_id' => 'Proyecto',
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
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('comuna_id',$this->comuna_id);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('proyecto_id',$this->proyecto_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Localidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
