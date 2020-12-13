<?php

namespace frontend\controllers;

use common\models\Rooms;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * Catalog controller
 */
class CatalogController extends SiteController
{
    /**
     * @param string $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($alias = null)
    {
        if(!$model = Rooms::find()->where(['alias' => $alias])->with(['roomsAttributesVias','attributesRooms'])->limit(1)->one()){
            throw new NotFoundHttpException();
        }

        return $this->render('index.twig',[
            'model' => $model,
            'rooms_attributes' => ArrayHelper::map($model['attributesRooms'],'id','name'),
        ]);
    }
}
