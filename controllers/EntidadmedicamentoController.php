<?php

namespace app\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Entidadmedicamento;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

class EntidadmedicamentoController extends ActiveController
{
    public $modelClass = 'app\models\Entidadmedicamento';
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
        $total = Entidadmedicamento::find();
        if ($text != '') {
            $total = $total->where(['like', new \yii\db\Expression("CONCAT(medicamentoNombre, ' ')"), $text]);
        }
        $total = $total->count();
        return $total;
    }

    public function actionBuscar($text = '')
{
    $consulta = Entidadmedicamento::find()
        ->joinWith('med') // <-- une con la relación definida en el modelo
        ->andFilterWhere(['like', 'medicamento.med_nombre', $text]); // <-- busca en el nombre del medicamento

    $entidadmedicamento = new ActiveDataProvider([
        'query' => $consulta,
        'pagination' => [
            'pageSize' => 20
        ],
    ]);

    return $entidadmedicamento->getModels();
}
}
