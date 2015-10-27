<?php

/**
 * This is the model class for table "jefe_proyecto".
 *
 * The followings are the available columns in table 'jefe_proyecto':
 * @property integer $id
 * @property string $nombre
 * @property string $email
 * @property string $telefono
 * @property integer $tipo_jefe_proyecto_id
 * @property integer $proyecto_id
 *
 * The followings are the available model relations:
 * @property Proyecto $proyecto
 * @property TipoJefeProyecto $tipoJefeProyecto
 */
class JefeProyecto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jefe_proyecto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre,email,telefono', 'required'),
			array('tipo_jefe_proyecto_id, proyecto_id', 'numerical', 'integerOnly'=>true),
			array('nombre, email, telefono', 'length', 'max'=>45),
            array('email','email'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, email, telefono, tipo_jefe_proyecto_id, proyecto_id', 'safe', 'on'=>'search'),
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
			'tipoJefeProyecto' => array(self::BELONGS_TO, 'TipoJefeProyecto', 'tipo_jefe_proyecto_id'),
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
			'email' => 'Email',
			'telefono' => 'Telefono',
			'tipo_jefe_proyecto_id' => 'Tipo Jefe Proyecto',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('tipo_jefe_proyecto_id',$this->tipo_jefe_proyecto_id);
		$criteria->compare('proyecto_id',$this->proyecto_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JefeProyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
