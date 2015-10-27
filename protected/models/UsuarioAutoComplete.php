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
 *
 * The followings are the available model relations:
 * @property Checklist[] $checklists
 * @property Documento[] $documentos
 * @property TipoUsuario $tipoUsuario
 * @property Empresa $empresa
 * @property UsuarioTecnico[] $usuarioTecnicos
 */
class UsuarioAutoComplete extends CActiveRecord
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
            array('id , nombre', 'required','message'=>'debe seleccionar un usuario'),
            array('id,nombre','prueba'),
           // array('tipo_usuario_id, activo, empresa_id', 'numerical', 'integerOnly'=>true),
           // array('nombre, apellido, usuario, password, email', 'length', 'max'=>45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nombre, email, tipo_usuario_id', 'safe', 'on'=>'search'),
        );
    }


    public function prueba($attribute, $params){

        $todos = $_POST['Usuario'];

        foreach($todos as $index=>$usuario){
            if($usuario['id'] == $this->id)
            {
                unset($todos[$index]);
                break;
            }
        }

        foreach($todos as $usuario){

                if($usuario['id'] == $this->id)
                {
                    $this->addError($attribute, 'usuario ya existe');
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
            'tipoUsuario' => array(self::BELONGS_TO, 'TipoUsuario', 'tipo_usuario_id')
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
            'tipo_usuario_id' => 'Tipo Usuario',

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
        $criteria->compare('tipo_usuario_id',$this->tipo_usuario_id);

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
