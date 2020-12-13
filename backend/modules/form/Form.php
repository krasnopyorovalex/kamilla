<?php

namespace backend\modules\form;
use backend\interfaces\ModelProviderInterface;
use yii\base\Module;

/**
 * form module definition class
 */
class Form extends Module implements ModelProviderInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\form\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'Формы';
        // custom initialization code goes here
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return \common\models\Form::className();
    }
}
