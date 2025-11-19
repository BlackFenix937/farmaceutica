<?php

namespace app\controllers;

use yii\filters\Cors;
use app\models\Compra;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

class CompraController extends ActiveController
{
    public $modelClass = 'app\models\Compra';
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
            'except' => ['index', 'view', 'total', 'buscar']
        ];

        return $behaviors;
    }

           public function actionTotal($text = "")
    {
        $total = Compra::find();
        if ($text != '') {
            $total = $total->where(['like', new \yii\db\Expression("CONCAT(mun_nombre, ' ')"), $text]);
        }
        $total = $total->count();
        return $total;
    }

public function actionBuscar($text = '')
{
    $consulta = Compra::find()
        ->joinWith(['compradetalles.med' => function($query) use ($text) {
            $query->andWhere(['like', 'medicamento.med_nombre', $text]);
        }])
        ->distinct(); // Para evitar duplicados si hay varias compras con el mismo medicamento

    $compra = new \yii\data\ActiveDataProvider([
        'query' => $consulta,
        'pagination' => [
            'pageSize' => 20
        ],
    ]);

    return $compra->getModels();
}


}
