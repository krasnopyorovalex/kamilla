<?php

namespace backend\modules\settings;

/**
 * Class Settings
 * @package backend\modules\settings
 */
class Settings extends \yii\base\Module
{
    public $model;
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\settings\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Настройки сайта';
    }
}
