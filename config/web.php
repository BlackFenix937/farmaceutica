<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'es-Es',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ujYLzHekVyhysoVJPBmxMqnC5D9l7FNC',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',
            'on afterLogin' => function ($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                ['class' => 'yii\web\UrlRule', 'pattern' => 'ciudads/buscar/<text:.*>', 'route' => 'ciudad/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'ciudads/total/<text:.*>', 'route' => 'ciudad/total'],
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'ciudad',
                    'tokens' => [
                        '{id}'   => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}'  => 'total'
                    ],
                ],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'categoriamedicamento'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'componente'],

                ['class' => 'yii\web\UrlRule', 'pattern' => 'pais/buscar/<text:.*>', 'route' => 'pais/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'pais/total/<text:.*>', 'route' => 'pais/total'],
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'pais',
                    'tokens' => [
                        '{id}'   => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}'  => 'total'
                    ],
                ],

                ['class' => 'yii\web\UrlRule', 'pattern' => 'estados/buscar/<text:.*>', 'route' => 'estado/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'estados/total/<text:.*>', 'route' => 'estado/total'],
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'estado',
                    'tokens' => [
                        '{id}'   => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}'  => 'total'
                    ],
                ],

                ['class' => 'yii\web\UrlRule', 'pattern' => 'clientes/buscar/<text:.*>', 'route' => 'cliente/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'clientes/total/<text:.*>', 'route' => 'cliente/total'],
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'cliente',
                    'tokens' => [
                        '{id}'   => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}'  => 'total',
                        'POST login'     => 'login',
                        'POST registrar' => 'registrar',
                    ],
                ],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'compra'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'compradetalle'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'devolucion'],

                ['class' => 'yii\web\UrlRule', 'pattern' => 'entidadcomercials/buscar/<text:.*>', 'route' => 'entidadcomercial/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'entidadcomercials/total/<text:.*>', 'route' => 'entidadcomercial/total'],
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'entidadcomercial',
                    'tokens' => [
                        '{id}'   => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}'  => 'total'
                    ],
                ],

                ['class' => 'yii\web\UrlRule', 'pattern' => 'entidadmedicamentos/buscar/<text:.*>', 'route' => 'entidadmedicamento/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'entidadmedicamentos/total/<text:.*>', 'route' => 'entidadmedicamento/total'],
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'entidadmedicamento',
                    'tokens' => [
                        '{id}'   => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}'  => 'total'
                    ],
                ],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'factura'],

                ['class' => 'yii\web\UrlRule', 'pattern' => 'medicamentos/buscar/<text:.*>', 'route' => 'medicamento/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'medicamentos/total/<text:.*>', 'route' => 'medicamento/total'],
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'medicamento',
                    'tokens' => [
                        '{id}'   => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}'  => 'total'
                    ],
                ],

                ['class' => 'yii\rest\UrlRule', 'controller' => 'medicamentocomponente'],



                ['class' => 'yii\web\UrlRule', 'pattern' => 'municipios/buscar/<text:.*>', 'route' => 'municipio/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'municipios/total/<text:.*>', 'route' => 'municipio/total'],
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'municipio',
                    'tokens' => [
                        '{id}'   => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}'  => 'total'
                    ],
                ],



                ['class' => 'yii\rest\UrlRule', 'controller' => 'pago'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'tipoestado'],

            ],
        ],

    ],
    'params' => $params,
    'modules' => [
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',

            // 'enableRegistration' => true,

            // Add regexp validation to passwords. Default pattern does not restrict user and can enter any set of characters.
            // The example below allows user to enter :
            // any set of characters
            // (?=\S{8,}): of at least length 8
            // (?=\S*[a-z]): containing at least one lowercase letter
            // (?=\S*[A-Z]): and at least one uppercase letter
            // (?=\S*[\d]): and at least one number
            // $: anchored to the end of the string

            //'passwordRegexp' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',


            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            'on beforeAction' => function (yii\base\ActionEvent $event) {
                if ($event->action->uniqueId == 'user-management/auth/login') {
                    $event->action->controller->layout = 'loginLayout.php';
                };
            },
        ],
    ],

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
