<?php

namespace frontend\widgets\Statistic;

use common\models\Statistic as Model;
use yii\base\Widget;

class Statistic extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('statistic.twig', [
            'model' => Model::find()->asArray()->all()
        ]);
    }
}