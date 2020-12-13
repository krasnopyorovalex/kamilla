<?php

namespace backend\modules\services_menu\controllers;

use backend\controllers\ModuleController;
use common\models\ServicesMenu;
use common\models\ServicesMenuCategories;
use common\models\ServicesMenuCategoriesItems;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `services_menu` module
 */
class DefaultController extends ModuleController
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['categories', 'categories-items'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }

    /**
     * @return string
     */
    public function actionAdd()
    {
        $model = new ServicesMenu();
        $this->loadData($model, Url::to(Yii::$app->homeUrl . $this->module->id));

        return $this->render('form',[
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = new ServicesMenu();
        if(!$model = $model::findOne(['id' => $id])){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $this->loadData($model, Url::to(Yii::$app->homeUrl . $this->module->id));
        return $this->render('form', ['model' => $model]);
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
        if(Yii::$app->request->isPost && ($model = ServicesMenu::findOne($id))){

            if(ServicesMenuCategories::find()->where(['services_menu_id' => $id])->count()) {
                Yii::$app->session->setFlash('error', 'Нельзя удалить услугу, содержащую категории');
            } else {
                $model->delete();
                return $this->redirect(Yii::$app->homeUrl . $this->module->id);
            }

        }

        if(!$model = ServicesMenu::findOne(['id' => $id])){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('form', ['model' => $model]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionCategories($id)
    {
        Url::remember();

        return $this->render('categories',[
            'dataProvider' => $this->findData(ServicesMenuCategories::find()->where(['services_menu_id' => $id])),
            'servicesMenu' => ServicesMenu::findOne($id)
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionCategoriesItems($id)
    {
        Url::remember();

        return $this->render('categories_items',[
            'dataProvider' => $this->findData(ServicesMenuCategoriesItems::find()->where(['services_menu_category_id' => $id])),
            'servicesMenuCategory' => ServicesMenuCategories::findOne($id)
        ]);
    }

}
