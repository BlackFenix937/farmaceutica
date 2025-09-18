<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entidadmedicamento".
 *
 * @property int $entmed_id
 * @property int $ent_id
 * @property int $med_id
 * @property float $entmed_precio
 * @property string|null $entmed_tiempo_entrega
 * @property string|null $entmed_fecha_recepcion
 * @property int|null $entmed_fkestado_id
 *
 * @property Entidadcomercial $ent
 * @property Tipoestado $entmedFkestado
 * @property Medicamento $med
 */
class Entidadmedicamento extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entidadmedicamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entmed_tiempo_entrega', 'entmed_fecha_recepcion', 'entmed_fkestado_id'], 'default', 'value' => null],
            [['ent_id', 'med_id', 'entmed_precio'], 'required'],
            [['ent_id', 'med_id', 'entmed_fkestado_id'], 'integer'],
            [['entmed_precio'], 'number'],
            [['entmed_fecha_recepcion'], 'safe'],
            [['entmed_tiempo_entrega'], 'string', 'max' => 50],
            [['ent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entidadcomercial::class, 'targetAttribute' => ['ent_id' => 'ent_id']],
            [['entmed_fkestado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoestado::class, 'targetAttribute' => ['entmed_fkestado_id' => 'test_id']],
            [['med_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamento::class, 'targetAttribute' => ['med_id' => 'med_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'entmed_id' => 'Entmed ID',
            'ent_id' => 'Ent ID',
            'med_id' => 'Med ID',
            'entmed_precio' => 'Entmed Precio',
            'entmed_tiempo_entrega' => 'Entmed Tiempo Entrega',
            'entmed_fecha_recepcion' => 'Entmed Fecha Recepcion',
            'entmed_fkestado_id' => 'Entmed Fkestado ID',
        ];
    }

    /**
     * Gets query for [[Ent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnt()
    {
        return $this->hasOne(Entidadcomercial::class, ['ent_id' => 'ent_id']);
    }

    /**
     * Gets query for [[EntmedFkestado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntmedFkestado()
    {
        return $this->hasOne(Tipoestado::class, ['test_id' => 'entmed_fkestado_id']);
    }

    /**
     * Gets query for [[Med]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMed()
    {
        return $this->hasOne(Medicamento::class, ['med_id' => 'med_id']);
    }

    public function extraFields()
    {
        return[
            "nombreEntidad"=> function(){
                return $this -> ent -> ent_nombre;
            },
            "estadoEntrega"=> function(){
                return $this-> entmedFkestado -> test_nombre;
            },
            "medicamentoNombre"=> function(){
                return $this-> med -> med_nombre;
            }
        ];
    }

}
