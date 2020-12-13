<?php

namespace frontend\controllers;

use yii\web\Response;

/**
 * Robots Controller
 */
class RobotsController extends SiteController
{

    /**
     * @throws \yii\base\ExitException
     */
    public function actionShow()
    {
        $this->layout = false;

        $response = \Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->getHeaders()->set('Content-Type', 'text/plain; charset=UTF-8');
        $response->content =  $this->render('robots.twig');
        return \Yii::$app->end();
    }

}