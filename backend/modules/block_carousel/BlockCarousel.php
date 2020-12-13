<?php

namespace backend\modules\block_carousel;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * block carousel module definition class
 */
class BlockCarousel extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\block_carousel\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Блок-карусель';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\BlockCarousel::className();
    }
}
