<?php
namespace app\models;

use yii\base\Model;

class RegistroForm extends Model
{
    public $username;
    public $password;
    public $cli_nombre;
    public $cli_apellido_paterno;
    public $cli_apellido_materno;
    public $cli_fecha_nacimiento;
    public $cli_direccion;
    public $cli_telefono;
    public $cli_correo;
    public $cli_rfc;
    public $cli_fecha_registro;
    public $cli_fkciu_id;

    public function rules() 
    {
        return [
            ['username', 'unique'],
            [['username', 'password'], 'trim'],
            [['cli_apellido_materno', 'cli_fecha_nacimiento', 'cli_direccion', 'cli_telefono', 'cli_rfc'], 'default', 'value' => null],
            [['username', 'password','cli_nombre', 'cli_apellido_paterno', 'cli_correo', 'cli_fkciu_id'], 'required'],
            [['cli_fecha_nacimiento'], 'safe'],
            [['cli_direccion'], 'string'],
            [['cli_fkciu_id'], 'integer'],
            [['cli_nombre', 'cli_apellido_paterno', 'cli_apellido_materno'], 'string', 'max' => 100],
            [['cli_telefono'], 'string', 'max' => 10],
            [['cli_correo'], 'string', 'max' => 150],
            [['cli_rfc'], 'string', 'max' => 13],
        ];

    }
}