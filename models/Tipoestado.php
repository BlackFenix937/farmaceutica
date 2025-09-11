<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoestado".
 *
 * @property int $test_id
 * @property string $test_nombre
 *
 * @property Compra[] $compras
 * @property Devolucion[] $devolucions
 * @property Entidadmedicamento[] $entidadmedicamentos
 * @property Factura[] $facturas
 * @property Pago[] $pagos
 */
class Tipoestado extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TEST_NOMBRE_COMPRADO = 'Comprado';
    const TEST_NOMBRE_DEVUELTO = 'Devuelto';
    const TEST_NOMBRE_EN_PROCESO_DE_COMPRA = 'En proceso de compra';
    const TEST_NOMBRE_ENTREGADO = 'Entregado';
    const TEST_NOMBRE_EN_CAMINO = 'En camino';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoestado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_nombre'], 'required'],
            [['test_nombre'], 'string'],
            ['test_nombre', 'in', 'range' => array_keys(self::optsTestNombre())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'test_id' => 'Test ID',
            'test_nombre' => 'Test Nombre',
        ];
    }

    /**
     * Gets query for [[Compras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::class, ['comp_fkestado_id' => 'test_id']);
    }

    /**
     * Gets query for [[Devolucions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevolucions()
    {
        return $this->hasMany(Devolucion::class, ['dev_fkestado_id' => 'test_id']);
    }

    /**
     * Gets query for [[Entidadmedicamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntidadmedicamentos()
    {
        return $this->hasMany(Entidadmedicamento::class, ['entmed_fkestado_id' => 'test_id']);
    }

    /**
     * Gets query for [[Facturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::class, ['fac_fkestado_id' => 'test_id']);
    }

    /**
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::class, ['pag_fkestado_id' => 'test_id']);
    }


    /**
     * column test_nombre ENUM value labels
     * @return string[]
     */
    public static function optsTestNombre()
    {
        return [
            self::TEST_NOMBRE_COMPRADO => 'Comprado',
            self::TEST_NOMBRE_DEVUELTO => 'Devuelto',
            self::TEST_NOMBRE_EN_PROCESO_DE_COMPRA => 'En proceso de compra',
            self::TEST_NOMBRE_ENTREGADO => 'Entregado',
            self::TEST_NOMBRE_EN_CAMINO => 'En camino',
        ];
    }

    /**
     * @return string
     */
    public function displayTestNombre()
    {
        return self::optsTestNombre()[$this->test_nombre];
    }

    /**
     * @return bool
     */
    public function isTestNombreComprado()
    {
        return $this->test_nombre === self::TEST_NOMBRE_COMPRADO;
    }

    public function setTestNombreToComprado()
    {
        $this->test_nombre = self::TEST_NOMBRE_COMPRADO;
    }

    /**
     * @return bool
     */
    public function isTestNombreDevuelto()
    {
        return $this->test_nombre === self::TEST_NOMBRE_DEVUELTO;
    }

    public function setTestNombreToDevuelto()
    {
        $this->test_nombre = self::TEST_NOMBRE_DEVUELTO;
    }

    /**
     * @return bool
     */
    public function isTestNombreEnProcesoDeCompra()
    {
        return $this->test_nombre === self::TEST_NOMBRE_EN_PROCESO_DE_COMPRA;
    }

    public function setTestNombreToEnProcesoDeCompra()
    {
        $this->test_nombre = self::TEST_NOMBRE_EN_PROCESO_DE_COMPRA;
    }

    /**
     * @return bool
     */
    public function isTestNombreEntregado()
    {
        return $this->test_nombre === self::TEST_NOMBRE_ENTREGADO;
    }

    public function setTestNombreToEntregado()
    {
        $this->test_nombre = self::TEST_NOMBRE_ENTREGADO;
    }

    /**
     * @return bool
     */
    public function isTestNombreEnCamino()
    {
        return $this->test_nombre === self::TEST_NOMBRE_EN_CAMINO;
    }

    public function setTestNombreToEnCamino()
    {
        $this->test_nombre = self::TEST_NOMBRE_EN_CAMINO;
    }
}
