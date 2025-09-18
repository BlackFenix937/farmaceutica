<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoriamedicamento".
 *
 * @property int $catmed_id
 * @property int $med_id
 * @property string $catmed_nombre
 * @property string|null $catmed_descripcion
 *
 * @property Medicamento $med
 */
class Categoriamedicamento extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoriamedicamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catmed_descripcion'], 'default', 'value' => null],
            [['med_id', 'catmed_nombre'], 'required'],
            [['med_id'], 'integer'],
            [['catmed_nombre'], 'string', 'max' => 100],
            [['catmed_descripcion'], 'string', 'max' => 255],
            [['med_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamento::class, 'targetAttribute' => ['med_id' => 'med_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'catmed_id' => 'Catmed ID',
            'med_id' => 'Med ID',
            'catmed_nombre' => 'Catmed Nombre',
            'catmed_descripcion' => 'Catmed Descripcion',
        ];
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
    public function extraFields()
{
    return [
        "medicamentoNombre" => function () {
            return $this-> med -> med_nombre;
                }];

}}
