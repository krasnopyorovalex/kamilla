<?php

namespace backend\modules\carousel;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * carousel module definition class
 */
class Carousel extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\carousel\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Карусель/Слайдшоу';

        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Carousel::className();
    }
}
