<?php

/**
 * This is the model class for table "configuracion_red".
 *
 * The followings are the available columns in table 'configuracion_red':
 * @property integer $id
 * @property string $usuario
 * @property string $dominio
 * @property string $nombre_maquina
 * @property string $red
 * @property string $tipo
 * @property string $ip
 * @property string $mascara
 * @property string $puerto_enlace
 * @property string $dns_preferencial
 * @property string $dns_alternativo
 * @property integer $checklist_id
 *
 * The followings are the available model relations:
 * @property Checklist $checklist
 */
class ConfiguracionRed extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'configuracion_red';
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
			array('usuario, dominio, nombre_maquina, red, tipo, ip, mascara, puerto_enlace, dns_preferencial, dns_alternativo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usuario, dominio, nombre_maquina, red, tipo, ip, mascara, puerto_enlace, dns_preferencial, dns_alternativo, checklist_id', 'safe', 'on'=>'search'),
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
			'usuario' => 'Usuario',
			'dominio' => 'Dominio',
			'nombre_maquina' => 'Nombre Maquina',
			'red' => 'Red',
			'tipo' => 'Tipo',
			'ip' => 'Ip',
			'mascara' => 'Mascara',
			'puerto_enlace' => 'Puerto Enlace',
			'dns_preferencial' => 'Dns Preferencial',
			'dns_alternativo' => 'Dns Alternativo',
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
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('dominio',$this->dominio,true);
		$criteria->compare('nombre_maquina',$this->nombre_maquina,true);
		$criteria->compare('red',$this->red,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('mascara',$this->mascara,true);
		$criteria->compare('puerto_enlace',$this->puerto_enlace,true);
		$criteria->compare('dns_preferencial',$this->dns_preferencial,true);
		$criteria->compare('dns_alternativo',$this->dns_alternativo,true);
		$criteria->compare('checklist_id',$this->checklist_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConfiguracionRed the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
