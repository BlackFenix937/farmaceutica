<?php

namespace app\controllers;

use Yii;
use yii\filters\Cors;
use app\models\Cliente;
use app\models\RegistroForm;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\forms\LoginForm;

class ClienteController extends ActiveController
{
    public $modelClass = 'app\models\Cliente';
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin'                           => ['http://localhost:8100', 'http://localhost:8101'],
                'Access-Control-Request-Method'    => ['GET', 'POST', 'PUT', 'DELETE'],
                'Access-Control-Request-Headers'   => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 600
            ]
        ];

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBearerAuth::className(),
            ],
            'except' => ['index', 'view', 'total', 'buscar', 'login', 'registrar']
        ];

        return $behaviors;
    }

    public function actionTotal($text="") {
    $total = Cliente::find();
    if($text != '') {
        $total = $total->where(['like', new \yii\db\Expression("CONCAT(cli_nombre, ' ', cli_apellido_paterno, ' ', cli_apellido_materno)"), $text]);
    }
    $total = $total->count();
    return $total;
}

public function actionBuscar($text='')
{
    $consulta = Cliente::find()->where(['like', new \yii\db\Expression("CONCAT(cli_nombre, ' ', cli_apellido_paterno, ' ', cli_apellido_materno)"), $text]);

    $clientes = new ActiveDataProvider([
        'query' => $consulta,
        'pagination' => [
            'pageSize' => 20 // Número de resultados por página
        ],
    ]);

    return $clientes->getModels();
}

public function actionLogin() {
    $token = '';
    $model = new LoginForm();
    $model->load(Yii::$app->getRequest()->getBodyParams(), '');
    if($model->login()) {
        $token = User::findOne(['username' => $model->username])->auth_key;
    }
    return $token;
}

public function actionRegistrar() { 
    $token = '';
    $model = new RegistroForm();
    $model->load(Yii::$app->getRequest()->getBodyParams(), '');
    $user   = new User();
    $cliente = new Cliente();
    $user->username        = $model->username;
    $user->password        = $model->password;
    $user->status          = User::STATUS_ACTIVE;
    $user->email_confirmed = 1;
    if($user->save()) {
        $cliente->cli_nombre    = $model->cli_nombre;
        $cliente->cli_apellido_paterno   = $model->cli_apellido_paterno;
        $cliente->cli_apellido_materno   = $model->cli_apellido_materno;
        $cliente->cli_fecha_nacimiento  = $model->cli_fecha_nacimiento;
        $cliente->cli_direccion      = $model->cli_direccion;
        $cliente->cli_telefono      = $model->cli_telefono;
        $cliente->cli_correo      = $model->cli_correo;
        $cliente->cli_rfc      = $model->cli_rfc;
        $cliente->cli_fkciu_id      = $model->cli_fkciu_id;
        $cliente->cli_id_user = $user->id;
        if($cliente->save()) {
            $token = $user->auth_key;
        } else {
            return $user->errors;
        }
    } else {
        return $user;
    }
    return $token;
}


}
