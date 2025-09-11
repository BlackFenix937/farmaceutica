<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compradetalle".
 *
 * @property int $det_id
 * @property int $comp_id
 * @property int $med_id
 * @property int $det_cantidad
 * @property float $det_precio_unitario
 * @property float $det_subtotal
 *
 * @property Compra $comp
 * @property Devolucion[] $devolucions
 * @property Medicamento $med
 */
class Compradetalle extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compradetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comp_id', 'med_id', 'det_cantidad', 'det_precio_unitario', 'det_subtotal'], 'required'],
            [['comp_id', 'med_id', 'det_cantidad'], 'integer'],
            [['det_precio_unitario', 'det_subtotal'], 'number'],
            [['comp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Compra::class, 'targetAttribute' => ['comp_id' => 'comp_id']],
            [['med_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamento::class, 'targetAttribute' => ['med_id' => 'med_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'det_id' => 'Det ID',
            'comp_id' => 'Comp ID',
            'med_id' => 'Med ID',
            'det_cantidad' => 'Det Cantidad',
            'det_precio_unitario' => 'Det Precio Unitario',
            'det_subtotal' => 'Det Subtotal',
        ];
    }

    /**
     * Gets query for [[Comp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComp()
    {
        return $this->hasOne(Compra::class, ['comp_id' => 'comp_id']);
    }

    /**
     * Gets query for [[Devolucions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevolucions()
    {
        return $this->hasMany(Devolucion::class, ['det_id' => 'det_id']);
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

}
