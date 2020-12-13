<?php

namespace backend\modules\services_menu_categories\controllers;

use backend\controllers\ModuleController;
use common\models\ServicesMenu;
use common\models\ServicesMenuCategories;
use common\models\ServicesMenuCategoriesItems;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `services_menu_categories` module
 */
class DefaultController extends ModuleController
{

    /**
     * @return string
     */
    public function actionAdd()
    {
        $model = new ServicesMenuCategories;
        $this->loadData($model, Url::previous());

        return $this->render('form',[
            'model' => $model,
            'servicesMenu' => ServicesMenu::findOne(Yii::$app->request->get('services_menu_id'))
        ]);
    }


    /**
     * @param $id
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = ServicesMenuCategories::findOne($id);
        $this->loadData($model, Url::previous());

        return $this->render('form',[
            'model' => $model,
            'servicesMenu' => $model->servicesMenu
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
        if(Yii::$app->request->isPost && ($model = ServicesMenuCategories::findOne($id))){

            if( $items = ServicesMenuCategoriesItems::find()->where(['services_menu_category_id' => $id])->all() ) {
                foreach ($items as $item) {
                    $item->delete();
                }
            }

            $model->delete();
            return $this->redirect(Url::previous());

            /*if(ServicesMenuCategoriesItems::find()->where(['services_menu_category_id' => $id])->count()) {
                Yii::$app->session->setFlash('error', 'Нельзя удалить категорию, содержащую дочерние пункты');
            } else {
                $model->delete();
                return $this->redirect(Url::previous());
            }*/
        }

        if(!$model = ServicesMenuCategories::findOne(['id' => $id])){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('form', ['model' => $model]);
    }

}
