<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'hillter_template',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','frontend\bootstrap\SetUp'],
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'ru',
    'homeUrl' => '/',
    'timeZone'=>'Europe/Moscow',
    'on beforeRequest' => function () {
        (new \frontend\components\Redirector())->parse();
        $model =  \yii\helpers\ArrayHelper::map(\common\models\Settings::find()->asArray()->all(), 'sys_name', 'value');
        if ($model['site_status'] == null) {
            Yii::$app->catchAll = ['site/offline', 'message' => $model['text_off']];
        }
    },
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'request' => [
            'baseUrl' => ''
        ],
        'mobileDetect' => [
            'class' => '\skeeks\yii2\mobiledetect\MobileDetect'
        ],
        'canonical' => [
            'class' => '\frontend\components\Canonical'
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '/' => 'site',
                'sitemap.xml' => 'sitemap/xml',
                'robots.txt' => 'robots/show',
                'load-form-guestbook' => 'reviews/form',
                '<action:(get-calculation-form|send-calculation-form)>' => 'calculate/<action>',
                '<action:(get-price-popup)>/<priceId>/<priceDateId>' => 'price/<action>',
                '<action:(get-popup)>/<id>' => 'popup/<action>',
                'form-handler/<action:(order|contact)>' => 'form/<action>',
                'reviews/<action:(new-review)>' => 'reviews/add',
                '<alias>/page/<page:\d+>' => 'site/page',
                '<alias>' => 'site/page',
                '<controller:(news|articles|specials)>/<alias:[\wd-]+>' => '<controller>/page'
            ],
        ],
        'view' => [
            'class' => 'yii\web\View',
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => '@runtime/Twig/cache',
                    // Array of twig options:
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => [
                        'html' => '\yii\helpers\Html',
                        'url' => '\yii\helpers\Url',
                        'appHelper' => '\frontend\components\AppHelper',
                        'stringHelper' => '\yii\helpers\StringHelper'
                    ],
                    'uses' => ['yii\bootstrap'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
