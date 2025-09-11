<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "factura".
 *
 * @property int $fac_id
 * @property int|null $pag_id
 * @property string $fac_folio
 * @property string $fac_fecha_emision
 * @property float $fac_subtotal
 * @property float $fac_impuestos
 * @property float $fac_total
 * @property int $fac_fkestado_id
 *
 * @property Tipoestado $facFkestado
 * @property Pago $pag
 */
class Factura extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pag_id'], 'default', 'value' => null],
            [['pag_id', 'fac_fkestado_id'], 'integer'],
            [['fac_folio', 'fac_subtotal', 'fac_impuestos', 'fac_total', 'fac_fkestado_id'], 'required'],
            [['fac_fecha_emision'], 'safe'],
            [['fac_subtotal', 'fac_impuestos', 'fac_total'], 'number'],
            [['fac_folio'], 'string', 'max' => 50],
            [['fac_fkestado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoestado::class, 'targetAttribute' => ['fac_fkestado_id' => 'test_id']],
            [['pag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pago::class, 'targetAttribute' => ['pag_id' => 'pag_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fac_id' => 'Fac ID',
            'pag_id' => 'Pag ID',
            'fac_folio' => 'Fac Folio',
            'fac_fecha_emision' => 'Fac Fecha Emision',
            'fac_subtotal' => 'Fac Subtotal',
            'fac_impuestos' => 'Fac Impuestos',
            'fac_total' => 'Fac Total',
            'fac_fkestado_id' => 'Fac Fkestado ID',
        ];
    }

    /**
     * Gets query for [[FacFkestado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacFkestado()
    {
        return $this->hasOne(Tipoestado::class, ['test_id' => 'fac_fkestado_id']);
    }

    /**
     * Gets query for [[Pag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPag()
    {
        return $this->hasOne(Pago::class, ['pag_id' => 'pag_id']);
    }

}
