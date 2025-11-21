<?php

namespace app\controllers;

use yii\filters\Cors;
use app\models\Devolucion;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

class DevolucionController extends ActiveController
{
    public $modelClass = 'app\models\Devolucion';
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
        $total = Devolucion::find();
        if ($text != '') {
            $total = $total->where(['like', new \yii\db\Expression("CONCAT(comp_id, ' ')"), $text]);
        }
        $total = $total->count();
        return $total;
    }

    public function actionBuscar($text = '')
    {
        $consulta = Devolucion::find()
            ->joinWith(['det.med' => function ($query) use ($text) {
                $query->andWhere(['like', 'medicamento.med_nombre', $text]);
            }])
            ->distinct(); // Evita duplicados si un medicamento produce múltiples relaciones

        $devoluciones = new \yii\data\ActiveDataProvider([
            'query' => $consulta,
            'pagination' => [
                'pageSize' => 20
            ],
        ]);

        return $devoluciones->getModels();
    }
}
