<?php

namespace frontend\components;

use yii\helpers\Html;

class Canonical
{

    private $aliasesIsCanonicalDefault = [
        'articles',
        'news',
        'specials',
        'guestbook',
        'reviews',
    ];

    /**
     * @param $model
     * @param $controller
     * @throws \yii\base\InvalidConfigException
     */
    public function checkCanonical($model, $controller)
    {
        $page = explode('/',\Yii::$app->request->getUrl());
        if(isset($page[3]) && is_numeric($page[3])){
            $model['title'] = $model['title'] . ' - Страница ' . $page[3];
            $model['description'] = ($model['description'] ? $model['description'] . ' - Страница ' . $page[3] : '');
            $controller->is_canonical = true;

            preg_match_all("/{[a-z]*}/",  $model['text'], $matches);
            foreach ($matches[0] as $item){
                $model['text'] = Html::tag('p', $item);
            }
        }
        if(in_array($model['alias'], $this->aliasesIsCanonicalDefault)){
            $controller->is_canonical = true;
        }
    }

}