<?php

namespace frontend\widgets\Articles;

use common\models\Articles as Model;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class Articles extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('articles.twig', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Model::find()->orderBy('date DESC'),
                'pagination' => new Pagination([
                    'pageSize' => \Yii::$app->params['pageSize'],
                    'forcePageParam' => false,
                    'pageSizeParam' => false
                ])
            ])
        ]);
    }
}