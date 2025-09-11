<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compra".
 *
 * @property int $comp_id
 * @property int $cli_id
 * @property string $comp_fecha
 * @property float $comp_total
 * @property int $comp_fkestado_id
 *
 * @property Cliente $cli
 * @property Tipoestado $compFkestado
 * @property Compradetalle[] $compradetalles
 * @property Pago[] $pagos
 */
class Compra extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cli_id', 'comp_total', 'comp_fkestado_id'], 'required'],
            [['cli_id', 'comp_fkestado_id'], 'integer'],
            [['comp_fecha'], 'safe'],
            [['comp_total'], 'number'],
            [['cli_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::class, 'targetAttribute' => ['cli_id' => 'cli_id']],
            [['comp_fkestado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoestado::class, 'targetAttribute' => ['comp_fkestado_id' => 'test_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comp_id' => 'Comp ID',
            'cli_id' => 'Cli ID',
            'comp_fecha' => 'Comp Fecha',
            'comp_total' => 'Comp Total',
            'comp_fkestado_id' => 'Comp Fkestado ID',
        ];
    }

    /**
     * Gets query for [[Cli]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCli()
    {
        return $this->hasOne(Cliente::class, ['cli_id' => 'cli_id']);
    }

    /**
     * Gets query for [[CompFkestado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompFkestado()
    {
        return $this->hasOne(Tipoestado::class, ['test_id' => 'comp_fkestado_id']);
    }

    /**
     * Gets query for [[Compradetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompradetalles()
    {
        return $this->hasMany(Compradetalle::class, ['comp_id' => 'comp_id']);
    }

    /**
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::class, ['comp_id' => 'comp_id']);
    }

}
