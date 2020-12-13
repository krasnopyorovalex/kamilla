<?php

namespace frontend\widgets\Sitemap;

use common\models\Articles;
use common\models\News;
use common\models\Pages;
use common\models\Rooms;
use common\models\Specials;
use yii\base\Widget;

class Sitemap extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('sitemap.twig', [
            'pages' => Pages::find()->publish()->all(),
            'news' => News::find()->publish()->orderBy('date DESC')->all(),
            'articles' => Articles::find()->publish()->orderBy('date DESC')->all(),
            'specials' => Specials::find()->publish()->orderBy('date DESC')->all(),
            'rooms' => Rooms::find()->publish()->orderBy('pos')->all(),
        ]);
    }
}