<?php

namespace backend\modules\popups\controllers;

use backend\controllers\ModuleController;
use common\models\Popups as Model;

/**
 * Default controller for the `popups` module
 */
class DefaultController extends ModuleController
{

    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => $this->findData(Model::find())
        ]);
    }

}
