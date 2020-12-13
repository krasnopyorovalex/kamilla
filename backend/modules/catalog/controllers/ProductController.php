<?php

namespace backend\modules\catalog\controllers;

use backend\controllers\ModuleController;
use common\models\Attribute;
use common\models\CategoryProduct;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use Yii;
use backend\components\FileHelper as FH;

/**
 * Default controller for the `catalog` module
 */
class ProductController extends ModuleController
{

    public $actions = [
        'update-product' => 'Обновление',
        'add-product' => 'Добавление',
        'delete-product' => 'Удаление',
    ];

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['list','add-product','update-product','delete-product','remove-image-product'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'remove-image-product' => ['post'],
                ],
            ],
        ]);
    }

    public function actionList($id)
    {
        Url::remember();
        return $this->render('index',[
            'dataProvider' => $this->findData(CategoryProduct::find()->where(['category_id' => $id])->with(['category'])),
            'model_id' => $id
        ]);
    }

    public function actionAddProduct($id)
    {
        $model = new CategoryProduct();
        $this->loadData($model,Url::previous());
        return $this->render('form',[
            'model' => new $model,
            'category_id' => $id,
            'attribute_product' => [],
            'attributes_array' => Attribute::find()->asArray()->all()
        ]);
    }

    public function actionUpdateProduct($id)
    {
        $model = CategoryProduct::find()->where(['id' => $id])->with(['attributeProducts'])->one();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->isAttributeChanged('alias')){
                $this->insertNewRedirect($model);
            }
            $model->save();
            return $this->redirect(Url::previous());
        }
        return $this->render('form',[
            'model' =>  $model,
            'attribute_product' => ArrayHelper::map($model['attributeProducts'], 'attribute_id', 'value'),
            'attributes_array' => Attribute::find()->asArray()->all()
        ]);
    }

    public function actionDeleteProduct($id)
    {
        $model = CategoryProduct::findOne($id);
        if(Yii::$app->request->isPost && $model->delete()){
            return $this->redirect(Url::previous());
        }
        return $this->render('form', [
            'model' => $model,
            'attribute_product' => ArrayHelper::map($model['attributeProducts'], 'attribute_id', 'value'),
            'attributes_array' => Attribute::find()->asArray()->all()
        ]);
    }

    public function actionRemoveImageProduct($id)
    {
        $model = CategoryProduct::findOne($id);
        if(FH::removeFile($model->image,$model::PATH)){
            $model->image = '';
            return $model->save();
        }
        return false;
    }

}
