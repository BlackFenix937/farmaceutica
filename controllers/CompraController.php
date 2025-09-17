<?php
namespace app\controllers;

use yii\rest\ActiveController;

class CompraController extends ActiveController
{
    public $modelClass = 'app\models\Compra';
    public function behaviors() {
    $behaviors = parent::behaviors();
    $behaviors['corsFilter'] = [
        'class' => \yii\filters\Cors::className(),
        'cors' => [
            'Origin'                           => ['http://localhost:8100'],
            'Access-Control-Request-Method'    => ['GET'],
            'Access-Control-Request-Headers'   => ['*'],
            'Access-Control-Allow-Credentials' => true,
            'Access-Control-Max-Age'           => 600
        ]
    ];
    return $behaviors;
}
}