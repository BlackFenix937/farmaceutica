<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ciudad".
 *
 * @property int $ciu_id
 * @property string $ciu_nombre
 * @property int $ciu_fkmun_id
 *
 * @property Municipio $ciuFkmun
 * @property Cliente[] $clientes
 * @property Entidadcomercial[] $entidadcomercials
 */
class Ciudad extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ciu_nombre', 'ciu_fkmun_id'], 'required'],
            [['ciu_fkmun_id'], 'integer'],
            [['ciu_nombre'], 'string', 'max' => 100],
            [['ciu_fkmun_id'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['ciu_fkmun_id' => 'mun_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ciu_id' => 'Ciu ID',
            'ciu_nombre' => 'Ciu Nombre',
            'ciu_fkmun_id' => 'Ciu Fkmun ID',
        ];
    }

    /**
     * Gets query for [[CiuFkmun]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiuFkmun()
    {
        return $this->hasOne(Municipio::class, ['mun_id' => 'ciu_fkmun_id']);
    }

    /**
     * Gets query for [[Clientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::class, ['cli_fkciu_id' => 'ciu_id']);
    }

    /**
     * Gets query for [[Entidadcomercials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntidadcomercials()
    {
        return $this->hasMany(Entidadcomercial::class, ['ent_fkciu_id' => 'ciu_id']);
    }

}
