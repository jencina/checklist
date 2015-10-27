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
class TareaAutoComplete extends CActiveRecord
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
            array('id,nombre', 'required','message'=>'debe seleccionar una tarea'),
            array('id,nombre','repetido'),
            array('id, nombre, precio, costo, utop,tiempo, descripcion', 'safe', 'on'=>'search'),
        );
    }

    public function repetido($attribute, $params){

        $todos = $_POST['Tarea'];

        foreach($todos as $index=>$tarea){
            if($tarea['id'] == $this->id)
            {
                unset($todos[$index]);
                break;
            }
        }

        foreach($todos as $tarea){

            if($tarea['id'] == $this->id)
            {
                $this->addError($attribute, 'tarea ya existe');
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
