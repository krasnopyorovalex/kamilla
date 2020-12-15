<?php
namespace frontend\controllers;

use common\models\News;
use yii\web\NotFoundHttpException;

/**
 * News controller
 */
class NewsController extends SiteController
{
    /**
     * @param string $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPage($alias = null)
    {
        if(!$model = News::find()->where(['alias' => $alias])->publish()->one()){
            throw new NotFoundHttpException();
        }

        try {
            $model->text = $this->parse($model);
        } catch (\Exception $e) {
            $model->text = $e->getMessage();
        }

        return $this->render('new.twig',[
            'model' => $model
        ]);
    }
}
