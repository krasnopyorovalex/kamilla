<?php

namespace backend\modules\menu\controllers;

use backend\controllers\ModuleController;
use common\models\Menu;
use common\models\MenuItems;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use Yii;
use yii\helpers\Url;
use yii\filters\VerbFilter;

/**
 * Default controller for the `menu` module
 */
class ItemsController extends ModuleController
{

    public $actions = [
        'edit-item' => 'Обновление пункта',
        'add-item' => 'Добавление пункта',
        'delete-item' => 'Удаление пункта',
    ];

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['items','add-item','edit-item','delete-item','sorting'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'sorting' => ['post'],
                ],
            ],
        ]);
    }

    public function actionItems($id)
    {
        Url::remember();
        return $this->render('index',[
            'model' =>  MenuItems::find()->where(['menu_id' => $id, 'parent_id' => null])->orderBy('pos')->asArray()->all(),
            'menu_id' => $id,
            'menu_name' => Menu::findOne($id)
        ]);
    }

    public function actionAddItem($id)
    {
        $model = new MenuItems;
        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->redirect(Url::previous());
        }
        return $this->render('form',[
            'model' =>  $model,
            'menu_id' => $id
        ]);
    }

    public function actionEditItem($id)
    {
        $model = MenuItems::findOne($id);
        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->redirect(Url::previous());
        }
        return $this->render('form',[
            'model' =>  $model
        ]);
    }

    public function actionDeleteItem($id)
    {
        $model = MenuItems::findOne($id);
        if(Yii::$app->request->isPost && $model->delete()){
            return $this->redirect(Url::previous());
        }
        return $this->render('form', [
            'model' => $model
        ]);
    }

    public function actionSorting($id)
    {
        foreach (Yii::$app->request->post() as $key => $value){
            $model = MenuItems::find()->where(['id' => $key, 'menu_id' => $id])->one();
            $model['pos'] = $value['pos'];
            $model['parent_id'] = $value['parent_id'];
            $model->save();
        }
    }

}
