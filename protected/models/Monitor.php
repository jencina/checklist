<?php

/**
 * This is the model class for table "monitor".
 *
 * The followings are the available columns in table 'monitor':
 * @property integer $id
 * @property string $marca
 * @property string $modelo
 * @property string $serie
 * @property string $etiqueta
 * @property integer $empresa_id
 *
 * The followings are the available model relations:
 * @property InformacionEquipo[] $informacionEquipos
 * @property Migracion[] $migracions
 * @property Migracion[] $migracions1
 * @property Empresa $empresa
 */
class Monitor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'monitor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('empresa_id', 'required'),
			array('empresa_id', 'numerical', 'integerOnly'=>true),
			array('marca, modelo, serie, etiqueta', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, marca, modelo, serie, etiqueta, empresa_id', 'safe', 'on'=>'search'),
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
			'informacionEquipos' => array(self::HAS_MANY, 'InformacionEquipo', 'monitor_id'),
			'migracions' => array(self::HAS_MANY, 'Migracion', 'monitor_id_antes'),
			'migracions1' => array(self::HAS_MANY, 'Migracion', 'monitor_id_despues'),
			'empresa' => array(self::BELONGS_TO, 'Empresa', 'empresa_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'marca' => 'Marca',
			'modelo' => 'Modelo',
			'serie' => 'Serie',
			'etiqueta' => 'Etiqueta',
			'empresa_id' => 'Empresa',
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
		$criteria->compare('marca',$this->marca,true);
		$criteria->compare('modelo',$this->modelo,true);
		$criteria->compare('serie',$this->serie,true);
		$criteria->compare('etiqueta',$this->etiqueta,true);
		$criteria->compare('empresa_id',$this->empresa_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Monitor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
