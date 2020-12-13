<?php

namespace backend\modules\price;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * price module definition class
 */
class Price extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\price\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Прайс';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Price::className();
    }
}
