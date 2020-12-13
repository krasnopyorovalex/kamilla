<?php

namespace frontend\widgets\News;

use common\models\News as Model;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class News extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('news.twig', [
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