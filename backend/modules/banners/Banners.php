<?php

namespace backend\modules\banners;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * banners module definition class
 */
class Banners extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\banners\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Сквозной баннер';
    }

    public function getModel()
    {
        return \common\models\Banners::className();
    }
}
