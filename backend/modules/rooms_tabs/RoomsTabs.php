<?php

namespace backend\modules\rooms_tabs;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * rooms_tabs module definition class
 */
class RoomsTabs extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\rooms_tabs\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Вкладки';
    }

    public function getModel()
    {
        return \common\models\RoomsTabs::className();
    }
}
