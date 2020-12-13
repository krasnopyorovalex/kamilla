<?php

namespace backend\modules\reviews;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * reviews module definition class
 */
class Reviews extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\reviews\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Отзывы';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Reviews::className();
    }

}
