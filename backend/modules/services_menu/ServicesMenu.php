<?php

namespace backend\modules\services_menu;
use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * services_menu module definition class
 */
class ServicesMenu extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\services_menu\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Меню услуг';
    }

    public function getModel()
    {
        return \common\models\ServicesMenu::className();
    }
}
