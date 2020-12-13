<?php

namespace backend\modules\services_menu_categories_items;
use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * services_menu_categories_items module definition class
 */
class ServicesMenuCategoriesItems extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\services_menu_categories_items\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Пункты';
    }

    public function getModel()
    {
        return \common\models\ServicesMenuCategoriesItems::className();
    }
}
