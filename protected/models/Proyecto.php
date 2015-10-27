<?php

/**
 * This is the model class for table "proyecto".
 *
 * The followings are the available columns in table 'proyecto':
 * @property integer $id
 * @property string $nombre
 * @property string $telefono
 * @property integer $empresa_id
 * @property integer $departamento_id
 * @property string $fecha_inicio
 * @property string $fecha_termino
 * @property integer $tipo_checklist_id
 *
 * The followings are the available model relations:
 * @property Configuracion[] $configuracions
 * @property IdentificacionUsuario[] $identificacionUsuarios
 * @property JefeProyecto[] $jefeProyectos
 * @property Localidad[] $localidads
 * @property TipoChecklist $tipoChecklist
 * @property Departamento $departamento
 * @property Empresa $empresa
 * @property Tarea[] $tareas
 * @property Usuario[] $usuarios
 */
class Proyecto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proyecto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, telefono, empresa_id, fecha_inicio, fecha_termino, tipo_checklist_id', 'required'),
			array('empresa_id, departamento_id, tipo_checklist_id', 'numerical', 'integerOnly'=>true),
			array('nombre, telefono', 'length', 'max'=>45),
            array('fecha_inicio','validFecha'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, telefono, empresa_id, departamento_id, fecha_inicio, fecha_termino, tipo_checklist_id', 'safe', 'on'=>'search'),
		);
	}

    public function validFecha($attribute, $params){

        if($this->fecha_inicio > $this->fecha_termino){
            $this->addError($attribute, 'fecha de inicio no debe ser mayor a la de termino');
        }
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'configuracions' => array(self::HAS_MANY, 'Configuracion', 'proyecto_id'),
			'identificacionUsuarios' => array(self::HAS_MANY, 'IdentificacionUsuario', 'proyecto_id'),
			'jefeProyectos' => array(self::HAS_MANY, 'JefeProyecto', 'proyecto_id'),
			'localidads' => array(self::HAS_MANY, 'Localidad', 'proyecto_id'),
			'tipoChecklist' => array(self::BELONGS_TO, 'TipoChecklist', 'tipo_checklist_id'),
			'departamento' => array(self::BELONGS_TO, 'Departamento', 'departamento_id'),
			'empresa' => array(self::BELONGS_TO, 'Empresa', 'empresa_id'),
			'tareas' => array(self::MANY_MANY, 'Tarea', 'proyecto_has_tarea(proyecto_id, tarea_id)'),
			'usuarios' => array(self::MANY_MANY, 'Usuario', 'proyecto_has_usuario(proyecto_id, usuario_id)'),
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
			'telefono' => 'Telefono',
			'empresa_id' => 'Empresa',
			'departamento_id' => 'Departamento',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_termino' => 'Fecha Termino',
			'tipo_checklist_id' => 'Tipo Checklist',
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
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('empresa_id',$this->empresa_id);
		$criteria->compare('departamento_id',$this->departamento_id);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_termino',$this->fecha_termino,true);
		$criteria->compare('tipo_checklist_id',$this->tipo_checklist_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proyecto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
