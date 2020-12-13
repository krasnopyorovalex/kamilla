<?php

namespace backend\modules\attributes;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;
use common\models\Attribute;

/**
 * attributes module definition class
 */
class Attributes extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\attributes\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Атрибуты';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return Attribute::className();
    }
}
