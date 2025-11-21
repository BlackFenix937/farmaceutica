<?php

namespace app\controllers;

use yii\filters\Cors;
use app\models\Factura;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

class FacturaController extends ActiveController
{
    public $modelClass = 'app\models\Factura';
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
            'except' => ['index', 'view', 'buscar', 'total']
        ];

        return $behaviors;
    }

        public function actionTotal($text = "")
    {
        $total = Factura::find();
        if ($text != '') {
            $total = $total->where(['like', new \yii\db\Expression("CONCAT(fac_id, ' ')"), $text]);
        }
        $total = $total->count();
        return $total;
    }

    public function actionBuscar($text = '')
    {
        $consulta = Factura::find()->where(['like', new \yii\db\Expression("CONCAT(fac_id, ' ')"), $text]);

        $facturas = new ActiveDataProvider([
            'query' => $consulta,
            'pagination' => [
                'pageSize' => 20 // Número de resultados por página
            ],
        ]);

        return $facturas->getModels();
    }

}
