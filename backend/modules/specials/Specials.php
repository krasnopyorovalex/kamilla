<?php

namespace backend\modules\specials;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * specials module definition class
 */
class Specials extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\specials\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Спецпредложения';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Specials::className();
    }
}
