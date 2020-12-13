<?php

namespace frontend\widgets\ActionsAndNews;

use common\models\News;
use common\models\Specials;
use yii\base\Widget;

class ActionsAndNews extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('actions_and_news.twig', [
            'actions' => Specials::find()->publish()->orderBy('date DESC')->limit(1)->all(),
            'news' => News::find()->publish()->orderBy('date DESC')->limit(2)->all()
        ]);
    }
}