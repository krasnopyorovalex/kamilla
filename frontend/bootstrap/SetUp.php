<?php

namespace frontend\bootstrap;

use common\models\Settings;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $catalogAlias = Settings::findOne(['sys_name' => 'catalog_alias']);
        $app->params['catalogAlias'] = $catalogAlias->value;

        $app->getUrlManager()->addRules([
            $catalogAlias->value . '/<alias:[\wd-]+>' => 'catalog/index',
        ], false);
    }
}