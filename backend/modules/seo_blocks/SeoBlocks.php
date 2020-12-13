<?php

namespace backend\modules\seo_blocks;

/**
 * seo_blocks module definition class
 */
class SeoBlocks extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\seo_blocks\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->params['name'] = 'SEO-блоки';
        // custom initialization code goes here
    }
}
