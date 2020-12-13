<?php

namespace backend\modules\price_settings;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * price_settings module definition class
 */
class PriceSettings extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\price_settings\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Настройки прайса';
    }

    public function getModel()
    {
        return \common\models\PriceSettings::className();
    }
}
