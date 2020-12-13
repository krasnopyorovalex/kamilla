<?php

namespace backend\modules\services_menu_categories_items\controllers;

use backend\controllers\ModuleController;
use common\models\ServicesMenuCategories;
use common\models\ServicesMenuCategoriesItems;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `services_menu_categories_items` module
 */
class DefaultController extends ModuleController
{
    /**
     * @return string
     */
    public function actionAdd()
    {
        $model = new ServicesMenuCategoriesItems();
        $this->loadData($model, Url::previous());

        return $this->render('form',[
            'model' => $model,
            'servicesMenuCategories' => ServicesMenuCategories::findOne((int) \Yii::$app->request->get('services_menu_category_id'))
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = ServicesMenuCategoriesItems::findOne($id);
        $this->loadData($model, Url::previous());

        return $this->render('form',[
            'model' => $model,
            'servicesMenuCategories' => $model->servicesMenuCategory
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if(\Yii::$app->request->isPost && ServicesMenuCategoriesItems::findOne($id)->delete()){
            return $this->redirect(Url::previous());
        }

        if(!$model = ServicesMenuCategoriesItems::findOne(['id' => $id])){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('form', ['model' => $model]);
    }
}
