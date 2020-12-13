<?php

namespace backend\modules\carousel\controllers;

use backend\components\MultiuploadCarousel;
use backend\controllers\ModuleController;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\CarouselImages;
use common\models\Carousel;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use Yii;

/**
 * Default controller for the `carousel` module
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

    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => $this->findData(Carousel::find())
        ]);
    }

    /**
     * @return string
     */
    public function actionAdd()
    {
        $model = new Carousel();
        $this->loadData($model);
        return $this->render('form',[
            'model' => $model,
            'images' => new CarouselImages()
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Carousel::find()->where(['id' => $id])->with(['carouselImages'])->one();
        $this->loadData($model);
        return $this->render('form', [
            'model' => $model,
            'images' => new CarouselImages
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws \Exception
     * @throws \yii\base\ErrorException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if(Yii::$app->request->isPost && Carousel::findOne($id)->delete()){
            FileHelper::removeDirectory(Yii::getAlias('@frontend'.CarouselImages::PATH . $id . DIRECTORY_SEPARATOR));
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', [
            'model' => Carousel::findOne($id),
            'images' => new CarouselImages
        ]);

    }

    public function actionImageEdit($id)
    {
        $model = CarouselImages::findOne($id);
        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()){
            return Json::encode($this->renderAjax('_image_box', ['model' => Carousel::find()->where(['id' => $model->carousel_id])->with(['carouselImages'])->one()]));
        }
        return $this->renderAjax('_image_edit', ['model' => $model]);
    }

    /**
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionUpdatePositions()
    {
        foreach(Yii::$app->request->post('values') as $key => $value)
        {
            $image = CarouselImages::findOne(['id' => (int)$value]);
            $image->pos = $key;
            $image->update();
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function actionLoad($id)
    {
        return $this->renderAjax('_image_box', ['model' => Carousel::find()->where(['id' => $id])->with(['carouselImages'])->one()]);
    }

    /**
     * @param $id
     * @return false|int
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionImageRemove($id)
    {
        return CarouselImages::findOne($id)->delete();
    }

}
