<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medicamento".
 *
 * @property int $med_id
 * @property string $med_nombre
 * @property string|null $med_descripcion
 * @property string|null $med_presentacion
 * @property int|null $med_concentracion
 * @property string $med_fecha_caducidad
 * @property float $med_precio_unitario
 * @property string $med_lote
 * @property int $med_stock
 *
 * @property Categoriamedicamento[] $categoriamedicamentos
 * @property Compradetalle[] $compradetalles
 * @property Entidadmedicamento[] $entidadmedicamentos
 * @property Medicamentocomponente[] $medicamentocomponentes
 */
class Medicamento extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['med_descripcion', 'med_presentacion', 'med_concentracion'], 'default', 'value' => null],
            [['med_nombre', 'med_fecha_caducidad', 'med_precio_unitario', 'med_lote', 'med_stock'], 'required'],
            [['med_descripcion'], 'string'],
            [['med_concentracion', 'med_stock'], 'integer'],
            [['med_fecha_caducidad'], 'safe'],
            [['med_precio_unitario'], 'number'],
            [['med_nombre'], 'string', 'max' => 150],
            [['med_presentacion'], 'string', 'max' => 100],
            [['med_lote'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'med_id' => 'Med ID',
            'med_nombre' => 'Med Nombre',
            'med_descripcion' => 'Med Descripcion',
            'med_presentacion' => 'Med Presentacion',
            'med_concentracion' => 'Med Concentracion',
            'med_fecha_caducidad' => 'Med Fecha Caducidad',
            'med_precio_unitario' => 'Med Precio Unitario',
            'med_lote' => 'Med Lote',
            'med_stock' => 'Med Stock',
        ];
    }

    /**
     * Gets query for [[Categoriamedicamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriamedicamentos()
    {
        return $this->hasMany(Categoriamedicamento::class, ['med_id' => 'med_id']);
    }

    /**
     * Gets query for [[Compradetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompradetalles()
    {
        return $this->hasMany(Compradetalle::class, ['med_id' => 'med_id']);
    }

    /**
     * Gets query for [[Entidadmedicamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntidadmedicamentos()
    {
        return $this->hasMany(Entidadmedicamento::class, ['med_id' => 'med_id']);
    }

    /**
     * Gets query for [[Medicamentocomponentes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamentocomponentes()
    {
        return $this->hasMany(Medicamentocomponente::class, ['med_id' => 'med_id']);
    }

}
