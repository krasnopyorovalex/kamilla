<?php

namespace frontend\widgets\Rooms;

use common\models\Rooms as Model;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class Rooms extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('rooms.twig', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Model::find()->with(['roomsAttributesVias', 'imagePreview'])->orderBy('pos'),
                'pagination' => false
            ])
        ]);
    }
}