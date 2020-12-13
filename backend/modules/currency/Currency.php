<?php

namespace backend\modules\currency;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;
/**
 * currency module definition class
 */
class Currency extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\currency\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Курс валют';

        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Currency::className();
    }
}
