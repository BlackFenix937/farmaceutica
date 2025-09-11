<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entidadcomercial".
 *
 * @property int $ent_id
 * @property string $ent_nombre
 * @property string $ent_tipo
 * @property string|null $ent_telefono
 * @property string|null $ent_correo
 * @property string|null $ent_direccion
 * @property string|null $ent_codigo_postal
 * @property int $ent_fkciu_id
 *
 * @property Ciudad $entFkciu
 * @property Entidadmedicamento[] $entidadmedicamentos
 */
class Entidadcomercial extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ENT_TIPO_PROVEEDOR = 'Proveedor';
    const ENT_TIPO_DISTRIBUIDOR = 'Distribuidor';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entidadcomercial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ent_telefono', 'ent_correo', 'ent_direccion', 'ent_codigo_postal'], 'default', 'value' => null],
            [['ent_nombre', 'ent_tipo', 'ent_fkciu_id'], 'required'],
            [['ent_tipo'], 'string'],
            [['ent_fkciu_id'], 'integer'],
            [['ent_nombre', 'ent_correo'], 'string', 'max' => 150],
            [['ent_telefono'], 'string', 'max' => 20],
            [['ent_direccion'], 'string', 'max' => 255],
            [['ent_codigo_postal'], 'string', 'max' => 5],
            ['ent_tipo', 'in', 'range' => array_keys(self::optsEntTipo())],
            [['ent_fkciu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::class, 'targetAttribute' => ['ent_fkciu_id' => 'ciu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ent_id' => 'Ent ID',
            'ent_nombre' => 'Ent Nombre',
            'ent_tipo' => 'Ent Tipo',
            'ent_telefono' => 'Ent Telefono',
            'ent_correo' => 'Ent Correo',
            'ent_direccion' => 'Ent Direccion',
            'ent_codigo_postal' => 'Ent Codigo Postal',
            'ent_fkciu_id' => 'Ent Fkciu ID',
        ];
    }

    /**
     * Gets query for [[EntFkciu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntFkciu()
    {
        return $this->hasOne(Ciudad::class, ['ciu_id' => 'ent_fkciu_id']);
    }

    /**
     * Gets query for [[Entidadmedicamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntidadmedicamentos()
    {
        return $this->hasMany(Entidadmedicamento::class, ['ent_id' => 'ent_id']);
    }


    /**
     * column ent_tipo ENUM value labels
     * @return string[]
     */
    public static function optsEntTipo()
    {
        return [
            self::ENT_TIPO_PROVEEDOR => 'Proveedor',
            self::ENT_TIPO_DISTRIBUIDOR => 'Distribuidor',
        ];
    }

    /**
     * @return string
     */
    public function displayEntTipo()
    {
        return self::optsEntTipo()[$this->ent_tipo];
    }

    /**
     * @return bool
     */
    public function isEntTipoProveedor()
    {
        return $this->ent_tipo === self::ENT_TIPO_PROVEEDOR;
    }

    public function setEntTipoToProveedor()
    {
        $this->ent_tipo = self::ENT_TIPO_PROVEEDOR;
    }

    /**
     * @return bool
     */
    public function isEntTipoDistribuidor()
    {
        return $this->ent_tipo === self::ENT_TIPO_DISTRIBUIDOR;
    }

    public function setEntTipoToDistribuidor()
    {
        $this->ent_tipo = self::ENT_TIPO_DISTRIBUIDOR;
    }
}
