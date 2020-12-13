<?php

namespace backend\modules\specials\controllers;

use backend\controllers\ModuleController;
use common\models\Specials as Model;

/**
 * Default controller for the `specials` module
 */
class DefaultController extends ModuleController
{
    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => $this->findData(Model::find()->orderBy('date'))
        ]);
    }
}
