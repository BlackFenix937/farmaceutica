<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devolucion".
 *
 * @property int $dev_id
 * @property int $det_id
 * @property int $dev_cantidad
 * @property string|null $dev_motivo
 * @property string $dev_fecha
 * @property int $dev_fkestado_id
 *
 * @property Compradetalle $det
 * @property Tipoestado $devFkestado
 */
class Devolucion extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'devolucion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dev_motivo'], 'default', 'value' => null],
            [['det_id', 'dev_cantidad', 'dev_fkestado_id'], 'required'],
            [['det_id', 'dev_cantidad', 'dev_fkestado_id'], 'integer'],
            [['dev_fecha'], 'safe'],
            [['dev_motivo'], 'string', 'max' => 255],
            [['det_id'], 'exist', 'skipOnError' => true, 'targetClass' => Compradetalle::class, 'targetAttribute' => ['det_id' => 'det_id']],
            [['dev_fkestado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoestado::class, 'targetAttribute' => ['dev_fkestado_id' => 'test_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dev_id' => 'Dev ID',
            'det_id' => 'Det ID',
            'dev_cantidad' => 'Dev Cantidad',
            'dev_motivo' => 'Dev Motivo',
            'dev_fecha' => 'Dev Fecha',
            'dev_fkestado_id' => 'Dev Fkestado ID',
        ];
    }

    /**
     * Gets query for [[Det]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDet()
    {
        return $this->hasOne(Compradetalle::class, ['det_id' => 'det_id']);
    }

    /**
     * Gets query for [[DevFkestado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevFkestado()
    {
        return $this->hasOne(Tipoestado::class, ['test_id' => 'dev_fkestado_id']);
    }

    public function extraFields()
    {
        return[
        "cantidadMedicamento"=> function(){
            return $this-> det -> det_cantidad;


        },
        "estadoDevolucion"=> function(){
            return $this-> devFkestado-> test_nombre;
        }
    ];
}

}
