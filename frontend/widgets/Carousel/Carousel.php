<?php

namespace frontend\widgets\Carousel;

use yii\base\Widget;

class Carousel extends Widget
{

    public $model;
    
    private $template = 'carousel.twig';

    /**
     * @return string
     */
    public function run()
    {
        if (\Yii::$app->mobileDetect->isMobile()) {
            $this->template = 'carousel_mobile.twig';
        }
        
        return $this->render($this->template, [
            'model' => $this->model
        ]);
    }
}
