<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "componente".
 *
 * @property int $comp_id
 * @property string $comp_nombre
 *
 * @property Medicamentocomponente[] $medicamentocomponentes
 */
class Componente extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'componente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comp_nombre'], 'required'],
            [['comp_nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comp_id' => 'Comp ID',
            'comp_nombre' => 'Comp Nombre',
        ];
    }

    /**
     * Gets query for [[Medicamentocomponentes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamentocomponentes()
    {
        return $this->hasMany(Medicamentocomponente::class, ['comp_id' => 'comp_id']);
    }

}
