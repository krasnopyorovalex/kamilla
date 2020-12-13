<?php

namespace frontend\widgets\RoomsMainForPage;

use common\models\Rooms as Model;
use yii\base\Widget;

class RoomsMainForPage extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('rooms.twig', [
            'model' => Model::find()->orderBy('pos')->andWhere(['show_in_main' => 1])->all()
        ]);
    }
}