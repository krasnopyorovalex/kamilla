<?php

namespace frontend\controllers;

use common\models\Articles;
use common\models\News;
use common\models\Pages;
use common\models\Rooms;
use common\models\Specials;
use yii\web\Response;


/**
 * Sitemap Controller
 */
class SitemapController extends SiteController
{
    /**
     * @return string
     */
    public function actionXml()
    {
        $this->layout = false;
        \Yii::$app->response->format = Response::FORMAT_RAW;
        $headers = \Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');
        return $this->render('sitemap.twig',[
            'pages' => Pages::find()->where(['<>','alias','index'])->asArray()->all(),
            'news' => News::find()->publish()->orderBy('date DESC')->asArray()->all(),
            'articles' => Articles::find()->publish()->orderBy('date DESC')->asArray()->all(),
            'specials' => Specials::find()->publish()->orderBy('date DESC')->asArray()->all(),
            'rooms' => Rooms::find()->publish()->orderBy('pos')->asArray()->all(),
        ]);
    }
}