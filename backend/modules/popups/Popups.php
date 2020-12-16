<?php

namespace backend\modules\popups;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * popups module definition class
 */
class Popups extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\popups\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Модальные окна';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Popups::className();
    }
}
