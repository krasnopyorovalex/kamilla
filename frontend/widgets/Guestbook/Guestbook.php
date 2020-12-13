<?php

namespace frontend\widgets\Guestbook;

use common\models\Reviews as Model;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class Guestbook extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('guestbook.twig', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Model::find()->publish()->with(['reviewsImages'])->orderBy('date DESC'),
                'pagination' => new Pagination([
                    'pageSize' => \Yii::$app->params['pageSize'],
                    'forcePageParam' => false,
                    'pageSizeParam' => false
                ])
            ]),
            'guestbook' => new Model()
        ]);
    }
}