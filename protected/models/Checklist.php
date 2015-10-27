<?php

/**
 * This is the model class for table "checklist".
 *
 * The followings are the available columns in table 'checklist':
 * @property integer $id
 * @property integer $estado_id
 * @property string $fecha_inicio
 * @property string $fecha_termino
 * @property integer $precio
 * @property integer $sistema_operativo_id
 * @property string $observacion
 * @property string $hora_inicio
 * @property string $hora_termino
 * @property integer $usuario_id
 * @property integer $localidad_id
 *
 * The followings are the available model relations:
 * @property Localidad $localidad
 * @property Estado $estado
 * @property SistemaOperativo $sistemaOperativo
 * @property Usuario $usuario
 * @property Tarea[] $tareas
 * @property ConfiguracionRed[] $configuracionReds
 * @property Foto[] $fotos
 * @property IdentificacionUsuario[] $identificacionUsuarios
 * @property Impresora[] $impresoras
 * @property InformacionEquipo[] $informacionEquipos
 * @property Migracion[] $migracions
 */
class Checklist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'checklist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estado_id, localidad_id', 'required'),
			array('estado_id, precio, sistema_operativo_id, usuario_id, localidad_id', 'numerical', 'integerOnly'=>true),
			array('fecha_inicio, fecha_termino, observacion, hora_inicio, hora_termino', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estado_id, fecha_inicio, fecha_termino, precio, sistema_operativo_id, observacion, hora_inicio, hora_termino, usuario_id, localidad_id', 'safe', 'on'=>'search'),
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
			'localidad' => array(self::BELONGS_TO, 'Localidad', 'localidad_id'),
			'estado' => array(self::BELONGS_TO, 'Estado', 'estado_id'),
			'sistemaOperativo' => array(self::BELONGS_TO, 'SistemaOperativo', 'sistema_operativo_id'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
			'tareas' => array(self::MANY_MANY, 'Tarea', 'checklist_has_tarea(checklist_id, tarea_id)'),
			'configuracionReds' => array(self::HAS_MANY, 'ConfiguracionRed', 'checklist_id'),
			'fotos' => array(self::HAS_MANY, 'Foto', 'checklist_id'),
			'identificacionUsuarios' => array(self::HAS_MANY, 'IdentificacionUsuario', 'checklist_id'),
			'impresoras' => array(self::HAS_MANY, 'Impresora', 'checklist_id'),
			'informacionEquipos' => array(self::HAS_MANY, 'InformacionEquipo', 'checklist_id'),
			'migracions' => array(self::HAS_MANY, 'Migracion', 'checklist_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'estado_id' => 'Estado',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_termino' => 'Fecha Termino',
			'precio' => 'Precio',
			'sistema_operativo_id' => 'Sistema Operativo',
			'observacion' => 'Observacion',
			'hora_inicio' => 'Hora Inicio',
			'hora_termino' => 'Hora Termino',
			'usuario_id' => 'Usuario',
			'localidad_id' => 'Localidad',
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
		$criteria->compare('estado_id',$this->estado_id);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_termino',$this->fecha_termino,true);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('sistema_operativo_id',$this->sistema_operativo_id);
		$criteria->compare('observacion',$this->observacion,true);
		$criteria->compare('hora_inicio',$this->hora_inicio,true);
		$criteria->compare('hora_termino',$this->hora_termino,true);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('localidad_id',$this->localidad_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Checklist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
