<?php

namespace frontend\widgets\Specials;

use common\models\Specials as Model;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class Specials extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('specials.twig', [
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