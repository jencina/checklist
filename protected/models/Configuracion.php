<?php

/**
 * This is the model class for table "configuracion".
 *
 * The followings are the available columns in table 'configuracion':
 * @property integer $id
 * @property integer $migracion
 * @property integer $foto
 * @property integer $configuracion_red
 * @property integer $unidades_red
 * @property integer $proyecto_id
 *
 * The followings are the available model relations:
 * @property Proyecto $proyecto
 * @property Tarea[] $tareas
 */
class Configuracion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'configuracion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('proyecto_id', 'required'),
			array('migracion, foto, configuracion_red, unidades_red, proyecto_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, migracion, foto, configuracion_red, unidades_red, proyecto_id', 'safe', 'on'=>'search'),
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
			'tareas' => array(self::MANY_MANY, 'Tarea', 'configuracion_has_tarea(configuracion_id, tarea_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'migracion' => 'Migracion',
			'foto' => 'Foto',
			'configuracion_red' => 'Configuracion Red',
			'unidades_red' => 'Unidades Red',
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
		$criteria->compare('migracion',$this->migracion);
		$criteria->compare('foto',$this->foto);
		$criteria->compare('configuracion_red',$this->configuracion_red);
		$criteria->compare('unidades_red',$this->unidades_red);
		$criteria->compare('proyecto_id',$this->proyecto_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Configuracion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
