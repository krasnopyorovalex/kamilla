<?php

namespace backend\modules\catalog;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;
use common\models\Category;

/**
 * catalog module definition class
 */
class Catalog extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\catalog\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Каталог';
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return Category::className();
    }
}
