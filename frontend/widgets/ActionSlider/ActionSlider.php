<?php

namespace frontend\widgets\ActionSlider;

use common\models\Specials;
use yii\base\Widget;

/**
 * Class ActionSlider
 * @package frontend\widgets\ActionSlider
 */
class ActionSlider extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        $actions = Specials::find()->publish()->andwhere(['is_finished' => 0])->orderBy('date DESC')->all();

        return $this->render('slider.twig', [
            'actions' => $actions
        ]);
    }
}