<?php

namespace backend\modules\articles\controllers;

use backend\controllers\ModuleController;
use common\models\Articles as Model;

/**
 * Default controller for the `articles` module
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
