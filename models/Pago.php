<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago".
 *
 * @property int $pag_id
 * @property int $comp_id
 * @property float $pag_monto
 * @property string $pag_fecha
 * @property int $pag_factura_solicitada
 * @property int $pag_fkestado_id
 *
 * @property Compra $comp
 * @property Factura[] $facturas
 * @property Tipoestado $pagFkestado
 */
class Pago extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pag_factura_solicitada'], 'default', 'value' => 0],
            [['comp_id', 'pag_monto', 'pag_fkestado_id'], 'required'],
            [['comp_id', 'pag_factura_solicitada', 'pag_fkestado_id'], 'integer'],
            [['pag_monto'], 'number'],
            [['pag_fecha'], 'safe'],
            [['comp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Compra::class, 'targetAttribute' => ['comp_id' => 'comp_id']],
            [['pag_fkestado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoestado::class, 'targetAttribute' => ['pag_fkestado_id' => 'test_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pag_id' => 'Pag ID',
            'comp_id' => 'Comp ID',
            'pag_monto' => 'Pag Monto',
            'pag_fecha' => 'Pag Fecha',
            'pag_factura_solicitada' => 'Pag Factura Solicitada',
            'pag_fkestado_id' => 'Pag Fkestado ID',
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
     * Gets query for [[Facturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::class, ['pag_id' => 'pag_id']);
    }

    /**
     * Gets query for [[PagFkestado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagFkestado()
    {
        return $this->hasOne(Tipoestado::class, ['test_id' => 'pag_fkestado_id']);
    }

    public function extraFields()
    {
        return[
            "pagoEstado"=> function(){
                return $this -> pagFkestado -> test_nombre;
            },
            "facturaSolicitada" => function () {
                return $this-> pag_factura_solicitada == 1 ? "Sí" : "No";
            },

            "medicamentosComprados" => function () {
            if ($this->comp && $this->comp->compradetalles) {
                return array_map(function($detalle) {
                    return $detalle->med ? $detalle->med->med_nombre : null;
                }, $this->comp->compradetalles);
            }
        }

        ];
    }

}
