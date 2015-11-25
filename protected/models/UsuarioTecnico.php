<?php

/**
 * This is the model class for table "usuario_tecnico".
 *
 * The followings are the available columns in table 'usuario_tecnico':
 * @property integer $id
 * @property string $rut
 * @property string $fecha_inicio
 * @property string $fecha_termino
 * @property integer $tipo_contrato_id
 * @property integer $usuario_id
 * @property string $telefono_fijo
 * @property string $telefono_celular
 * @property string $direccion
 * @property string $contrato_adjunto
 *
 * The followings are the available model relations:
 * @property TipoContrato $tipoContrato
 * @property Usuario $usuario
 */
class UsuarioTecnico extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_tecnico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut, fecha_inicio, fecha_termino, tipo_contrato_id, telefono_fijo, telefono_celular, direccion', 'required'),
			array('tipo_contrato_id, usuario_id', 'numerical', 'integerOnly'=>true),
			array('rut, telefono_fijo, telefono_celular, direccion, contrato_adjunto', 'length', 'max'=>45),
            array('fecha_inicio','validFecha'),
            array('rut','rut'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rut, fecha_inicio, fecha_termino, tipo_contrato_id, usuario_id, telefono_fijo, telefono_celular, direccion, contrato_adjunto', 'safe', 'on'=>'search'),
		);
	}

    public function validFecha($attribute, $params){

        if($this->fecha_inicio > $this->fecha_termino){
            $this->addError($attribute, 'fecha de inicio no debe ser mayor a la de termino');
        }
    }

    public function rut($attribute, $params){

        $r  = $this->rut;

        if(!$r = preg_replace('|[^0-9kK]|i', '', $r))
            $this->addError($attribute, 'basura'); /* Era código basura */

        if(!((strlen($r) == 8) or (strlen($r) == 9)))
            $this->addError($attribute, 'caracter');; /* La cantidad de carácteres no es válida. */

        $v = strtoupper(substr($r, -1));
        if(!$r = substr($r, 0, -1))
            $this->addError($attribute, 'error');

        if(!((int)$r > 0))
            $this->addError($attribute, 'nonumerico'); /* No es un valor numérico */

        $x = 2; $s = 0;
        for($i = (strlen($r) - 1); $i >= 0; $i--){
            if($x > 7)
                $x = 2;
            $s += ($r[$i] * $x);
            $x++;
        }
        $dv=11-($s % 11);
        if($dv == 10)
            $dv = 'K';
        if($dv == 11)
            $dv = '0';
        if($dv == $v){
            $this->rut = number_format($r, 0, '', '.').'-'.$v; /* Formatea el RUT */
        }else{
            $this->rut = number_format($r, 0, '', '.').'-'.$v; /* Formatea el RUT */
            $this->addError($attribute, 'error');

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
			'tipoContrato' => array(self::BELONGS_TO, 'TipoContrato', 'tipo_contrato_id'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'rut' => 'Rut',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_termino' => 'Fecha Termino',
			'tipo_contrato_id' => 'Tipo Contrato',
			'usuario_id' => 'Usuario',
			'telefono_fijo' => 'Telefono Fijo',
			'telefono_celular' => 'Telefono Celular',
			'direccion' => 'Direccion',
			'contrato_adjunto' => 'Contrato Adjunto',
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
		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_termino',$this->fecha_termino,true);
		$criteria->compare('tipo_contrato_id',$this->tipo_contrato_id);
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('telefono_fijo',$this->telefono_fijo,true);
		$criteria->compare('telefono_celular',$this->telefono_celular,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('contrato_adjunto',$this->contrato_adjunto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioTecnico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
