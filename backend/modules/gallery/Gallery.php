<?php

namespace backend\modules\gallery;
use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * gallery module definition class
 */
class Gallery extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\gallery\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Галерея';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Gallery::className();
    }
}
