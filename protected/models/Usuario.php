<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $usuario
 * @property string $password
 * @property string $email
 * @property integer $tipo_usuario_id
 * @property integer $activo
 * @property integer $empresa_id
 * @property integer $empresa_id_cliente
 *
 * The followings are the available model relations:
 * @property Checklist[] $checklists
 * @property Documento[] $documentos
 * @property TipoUsuario $tipoUsuario
 * @property Empresa $empresa
 * @property UsuarioTecnico[] $usuarioTecnicos
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, apellido, email', 'required'),
            array('usuario,password','validUser'),
			array('tipo_usuario_id, activo, empresa_id, empresa_id_cliente', 'numerical', 'integerOnly'=>true),
			array('nombre, apellido, usuario, password, email', 'length', 'max'=>45),
            array('email','email'),
            array('usuario','unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, apellido, usuario, password, email, tipo_usuario_id, activo, empresa_id,empresa_id_cliente', 'safe', 'on'=>'search'),
		);
	}


    public function validUser($attribute, $params){

        $tipoUsuario = $this->tipoUsuario->nombre;


        if( $tipoUsuario == 'admin'  || $tipoUsuario == 'super_admin'|| $tipoUsuario == 'tecnico'|| $tipoUsuario == 'cliente'){
            if(empty($this->$attribute)){
                $this->addError($attribute, $attribute.' no puede ser nulo');
            }

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
			'checklists' => array(self::HAS_MANY, 'Checklist', 'usuario_id'),
			'documentos' => array(self::HAS_MANY, 'Documento', 'usuario_id'),
			'tipoUsuario' => array(self::BELONGS_TO, 'TipoUsuario', 'tipo_usuario_id'),
			'empresa' => array(self::BELONGS_TO, 'Empresa', 'empresa_id'),
            'empresaCliente' => array(self::BELONGS_TO, 'Empresa', 'empresa_id_cliente'),
			'usuarioTecnicos' => array(self::HAS_MANY, 'UsuarioTecnico', 'usuario_id'),
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
			'apellido' => 'Apellido',
			'usuario' => 'Usuario',
			'password' => 'Password',
			'email' => 'Email',
			'tipo_usuario_id' => 'Tipo Usuario',
			'activo' => 'Activo',
			'empresa_id' => 'Empresa',
            'empresa_id_cliente' => 'Empresa Cliente',
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
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tipo_usuario_id',$this->tipo_usuario_id);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('empresa_id',$this->empresa_id);
        $criteria->compare('empresa_id_cliente',$this->empresa_id_cliente);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
