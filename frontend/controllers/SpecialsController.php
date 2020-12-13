<?php

namespace frontend\controllers;

use common\models\Specials;
use yii\web\NotFoundHttpException;

/**
 * Specials controller
 */
class SpecialsController extends SiteController
{
    /**
     * @param string $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPage($alias = null)
    {
        if(!$model = Specials::find()->where(['alias' => $alias])->publish()->limit(1)->one()){
            throw new NotFoundHttpException();
        }
        return $this->render('special.twig',[
            'model' => $model
        ]);
    }
}
