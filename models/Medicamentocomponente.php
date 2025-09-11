<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medicamentocomponente".
 *
 * @property int $medcomp_id
 * @property int $med_id
 * @property int $comp_id
 *
 * @property Componente $comp
 * @property Medicamento $med
 */
class Medicamentocomponente extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicamentocomponente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['med_id', 'comp_id'], 'required'],
            [['med_id', 'comp_id'], 'integer'],
            [['comp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Componente::class, 'targetAttribute' => ['comp_id' => 'comp_id']],
            [['med_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamento::class, 'targetAttribute' => ['med_id' => 'med_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'medcomp_id' => 'Medcomp ID',
            'med_id' => 'Med ID',
            'comp_id' => 'Comp ID',
        ];
    }

    /**
     * Gets query for [[Comp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComp()
    {
        return $this->hasOne(Componente::class, ['comp_id' => 'comp_id']);
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
