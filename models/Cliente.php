<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $cli_id
 * @property string $cli_nombre
 * @property string $cli_apellido_paterno
 * @property string|null $cli_apellido_materno
 * @property string|null $cli_fecha_nacimiento
 * @property string|null $cli_direccion
 * @property string|null $cli_telefono
 * @property string $cli_correo
 * @property string|null $cli_rfc
 * @property string $cli_fecha_registro
 * @property int $cli_fkciu_id
 *
 * @property Ciudad $cliFkciu
 * @property Compra[] $compras
 */
class Cliente extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cli_apellido_materno', 'cli_fecha_nacimiento', 'cli_direccion', 'cli_telefono', 'cli_rfc'], 'default', 'value' => null],
            [['cli_nombre', 'cli_apellido_paterno', 'cli_correo', 'cli_fkciu_id'], 'required'],
            [['cli_fecha_nacimiento', 'cli_fecha_registro'], 'safe'],
            [['cli_direccion'], 'string'],
            [['cli_fkciu_id'], 'integer'],
            [['cli_nombre', 'cli_apellido_paterno', 'cli_apellido_materno'], 'string', 'max' => 100],
            [['cli_telefono'], 'string', 'max' => 10],
            [['cli_correo'], 'string', 'max' => 150],
            [['cli_rfc'], 'string', 'max' => 13],
            [['cli_fkciu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::class, 'targetAttribute' => ['cli_fkciu_id' => 'ciu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cli_id' => 'Cli ID',
            'cli_nombre' => 'Cli Nombre',
            'cli_apellido_paterno' => 'Cli Apellido Paterno',
            'cli_apellido_materno' => 'Cli Apellido Materno',
            'cli_fecha_nacimiento' => 'Cli Fecha Nacimiento',
            'cli_direccion' => 'Cli Direccion',
            'cli_telefono' => 'Cli Telefono',
            'cli_correo' => 'Cli Correo',
            'cli_rfc' => 'Cli Rfc',
            'cli_fecha_registro' => 'Cli Fecha Registro',
            'cli_fkciu_id' => 'Cli Fkciu ID',
        ];
    }

    /**
     * Gets query for [[CliFkciu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliFkciu()
    {
        return $this->hasOne(Ciudad::class, ['ciu_id' => 'cli_fkciu_id']);
    }

    /**
     * Gets query for [[Compras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::class, ['cli_id' => 'cli_id']);
    }

}
