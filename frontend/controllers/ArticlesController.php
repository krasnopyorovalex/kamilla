<?php
namespace frontend\controllers;

use common\models\Articles;
use yii\web\NotFoundHttpException;

/**
 * Articles controller
 */
class ArticlesController extends SiteController
{
    /**
     * @param string $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPage($alias = null)
    {
        if(!$model = Articles::find()->where(['alias' => $alias])->publish()->one()){
            throw new NotFoundHttpException();
        }
        
        try {
            $model->text = $this->parse($model);
        } catch (\Exception $e) {
            $model->text = $e->getMessage();
        }
        
        return $this->render('article.twig',[
            'model' => $model
        ]);
    }
}
