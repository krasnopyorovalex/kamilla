<?php

namespace backend\modules\catalog\controllers;

use backend\controllers\ModuleController;
use common\models\Category;

/**
 * Default controller for the `catalog` module
 */
class DefaultController extends ModuleController
{

    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => Category::find()->where(['parent_id' => null])->with(['categories'])->asArray()->all()
        ]);
    }

}
