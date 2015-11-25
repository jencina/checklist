<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property integer $id
 * @property string $nombre
 * @property string $razon_social
 * @property string $rut
 * @property string $direccion_comercial
 * @property string $contacto_facturacion
 * @property string $telefono_fijo
 * @property string $telefono_celular
 * @property string $email_contacto
 * @property string $contacto_administracion
 * @property string $telefono_administracion
 * @property string $pais_prestacion_servicios
 * @property string $logo
 * @property string $logo_tipo_id
 * @property integer $tipo_empresa_id
 * @property integer $empresa_id
 *
 * The followings are the available model relations:
 * @property Empresa $empresa
 * @property Empresa[] $empresas
 * @property TipoEmpresa $tipoEmpresa
 * @property Proyecto[] $proyectos
 * @property Usuario[] $usuarios
 */
class Empresa extends CActiveRecord
{


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, razon_social, rut, direccion_comercial, contacto_facturacion, telefono_fijo, telefono_celular, email_contacto, contacto_administracion, telefono_administracion, pais_prestacion_servicios, tipo_empresa_id', 'required'),
			array('tipo_empresa_id, empresa_id', 'numerical', 'integerOnly'=>true),
			array('nombre, razon_social, rut, direccion_comercial, contacto_facturacion, telefono_fijo, telefono_celular, email_contacto, contacto_administracion, telefono_administracion, pais_prestacion_servicios, logo', 'length', 'max'=>45),
            array('email_contacto','email'),
            array('nombre','unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, razon_social, rut, direccion_comercial, contacto_facturacion, telefono_fijo, telefono_celular, email_contacto, contacto_administracion, telefono_administracion, pais_prestacion_servicios, logo, tipo_empresa_id, empresa_id, logo_tipo_id', 'safe', 'on'=>'search'),
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
			'empresa' => array(self::BELONGS_TO, 'Empresa', 'empresa_id'),
			'empresas' => array(self::HAS_MANY, 'Empresa', 'empresa_id'),
			'tipoEmpresa' => array(self::BELONGS_TO, 'TipoEmpresa', 'tipo_empresa_id'),
            'tipoLogo' => array(self::BELONGS_TO, 'LogoTipo', 'logo_tipo_id'),
			'proyectos' => array(self::HAS_MANY, 'Proyecto', 'empresa_id'),
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'empresa_id'),
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
			'razon_social' => 'Razon Social',
			'rut' => 'Rut',
			'direccion_comercial' => 'Direccion Comercial',
			'contacto_facturacion' => 'Contacto Facturacion',
			'telefono_fijo' => 'Telefono Fijo',
			'telefono_celular' => 'Telefono Celular',
			'email_contacto' => 'Email Contacto',
			'contacto_administracion' => 'Contacto Administracion',
			'telefono_administracion' => 'Telefono Administracion',
			'pais_prestacion_servicios' => 'Pais Prestacion Servicios',
			'logo' => 'Logo',
            'logo_tipo_id'=>'Tipo Logo',
			'tipo_empresa_id' => 'Tipo Empresa',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('razon_social',$this->razon_social,true);
		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('direccion_comercial',$this->direccion_comercial,true);
		$criteria->compare('contacto_facturacion',$this->contacto_facturacion,true);
		$criteria->compare('telefono_fijo',$this->telefono_fijo,true);
		$criteria->compare('telefono_celular',$this->telefono_celular,true);
		$criteria->compare('email_contacto',$this->email_contacto,true);
		$criteria->compare('contacto_administracion',$this->contacto_administracion,true);
		$criteria->compare('telefono_administracion',$this->telefono_administracion,true);
		$criteria->compare('pais_prestacion_servicios',$this->pais_prestacion_servicios,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('tipo_empresa_id',$this->tipo_empresa_id);
		$criteria->compare('empresa_id',$this->empresa_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empresa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
