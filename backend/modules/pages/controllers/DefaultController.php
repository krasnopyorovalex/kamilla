<?php

namespace backend\modules\pages\controllers;

use backend\controllers\ModuleController;
use common\models\Pages;

/**
 * Default controller for the `pages` module
 */
class DefaultController extends ModuleController
{

    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => Pages::find()->where(['parent_id' => null])->with(['pages'])->asArray()->all()
        ]);
    }

}
