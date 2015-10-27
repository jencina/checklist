<?php

/**
 * This is the model class for table "tarea".
 *
 * The followings are the available columns in table 'tarea':
 * @property integer $id
 * @property string $nombre
 * @property integer $precio
 * @property integer $costo
 * @property integer $utop
 * @property string $tiempo
 * @property integer $empresa_id
 * @property string $descripcion
 *
 * The followings are the available model relations:
 * @property Checklist[] $checklists
 * @property Proyecto[] $proyectos
 * @property Empresa $empresa
 */
class Tarea extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tarea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, precio, costo, utop, tiempo, empresa_id, descripcion', 'required'),
			array('precio, costo, empresa_id', 'numerical', 'integerOnly'=>true),
			array('nombre, tiempo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, precio, costo, utop, tiempo, empresa_id, descripcion', 'safe', 'on'=>'search'),
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
			'checklists' => array(self::MANY_MANY, 'Checklist', 'checklist_has_tarea(tarea_id, checklist_id)'),
			'proyectos' => array(self::MANY_MANY, 'Proyecto', 'proyecto_has_tarea(tarea_id, proyecto_id)'),
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
			'nombre' => 'Nombre',
			'precio' => 'Precio',
			'costo' => 'Costo',
			'utop' => 'Utop',
			'tiempo' => 'Tiempo',
			'empresa_id' => 'Empresa',
			'descripcion' => 'Descripcion',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('costo',$this->costo);
		$criteria->compare('utop',$this->utop);
		$criteria->compare('tiempo',$this->tiempo,true);
		$criteria->compare('empresa_id',$this->empresa_id);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tarea the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
