<?php

namespace backend\modules\statistic;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * statistic module definition class
 */
class Statistic extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\statistic\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Статистика';
    }

    public function getModel()
    {
        return \common\models\Statistic::className();
    }
}
