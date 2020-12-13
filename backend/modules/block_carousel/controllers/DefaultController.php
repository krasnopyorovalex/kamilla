<?php

namespace backend\modules\block_carousel\controllers;

use backend\components\FileHelper;
use backend\components\MultiuploadBlockCarousel;
use backend\controllers\ModuleController;
use common\models\BlockCarousel as Model;
use common\models\BlockCarousel;
use common\models\BlockCarouselImages;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Default controller for the `articles` module
 */
class DefaultController extends ModuleController
{

    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => $this->findData(Model::find()->orderBy('pos'))
        ]);
    }
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['image-edit','update-positions', 'load', 'image-remove'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'image-edit' => ['post'],
                    'update-positions' => ['post'],
                    'load' => ['post'],
                    'image-remove' => ['post'],
                ],
            ],
        ]);
    }

    public function actionUpdate($id)
    {
        $model = BlockCarousel::find()->where(['id' => $id])->with(['blockCarouselImages'])->one();
        $this->loadData($model);
        return $this->render('form', [
            'model' => $model,
            'images' => new BlockCarouselImages()
        ]);
    }

    public function actionDelete($id)
    {
        if(Yii::$app->request->isPost && BlockCarouselImages::deleteAll(['block_carousel_id' => $id]) && BlockCarousel::findOne($id)->delete()){
            FileHelper::removeDirectory(Yii::getAlias('@frontend'.BlockCarouselImages::PATH . $id . MultiuploadBlockCarousel::DELIMITER));
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', [
            'model' => BlockCarousel::findOne($id),
            'images' => new BlockCarouselImages
        ]);

    }

    public function actionImageEdit($id)
    {
        $model = BlockCarouselImages::findOne($id);
        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()){
            return Json::encode($this->renderAjax('_image_box', ['model' => BlockCarousel::find()->where(['id' => $model->block_carousel_id])->with(['blockCarouselImages'])->one()]));
        }
        return $this->renderAjax('_image_edit', ['model' => $model]);
    }

    public function actionUpdatePositions()
    {
        foreach(Yii::$app->request->post('values') as $key => $value)
        {
            $image = BlockCarouselImages::findOne(['id' => (int)$value]);
            $image->pos = $key;
            $image->update();
        }
    }

    public function actionLoad($id)
    {
        return $this->renderAjax('_image_box', ['model' => BlockCarousel::find()->where(['id' => $id])->with(['blockCarouselImages'])->one()]);
    }

    public function actionImageRemove($id)
    {
        return BlockCarouselImages::findOne($id)->delete();
    }

}
