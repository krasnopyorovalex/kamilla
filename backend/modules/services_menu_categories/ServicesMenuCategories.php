<?php

namespace backend\modules\services_menu_categories;

use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * services_menu_categories module definition class
 */
class ServicesMenuCategories extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\services_menu_categories\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Меню услуг - категории';
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\ServicesMenuCategories::className();
    }
}
