<?php

namespace backend\modules\price_attributes;

use backend\interfaces\ModelProviderInterface;
use common\models\PriceDates;
use yii\base\Module;

/**
 * price_attributes module definition class
 */
class PriceAttributes extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\price_attributes\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Периоды, даты';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return PriceDates::className();
    }
}
