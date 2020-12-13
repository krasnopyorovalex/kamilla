<?php

namespace backend\modules\reviews\controllers;

use backend\controllers\ModuleController;
use common\models\Reviews;
use common\models\ReviewsImages;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\components\FileHelper as FH;

/**
 * Default controller for the `reviews` module
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
                        'actions' => ['edit-image', 'remove-checked', 'remove-image-by-id'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'edit-image' => ['post'],
                    'remove-image-by-id' => ['post'],
                ],
            ],
        ]);
    }

    public function actionAdd()
    {
        return $this->redirect(Yii::$app->homeUrl . $this->module->id);
    }

    public function actionIndex()
    {
        $model = Reviews::find()->orderBy('date DESC');
        return $this->render('index',[
            'dataProvider' => new ActiveDataProvider([
                'query' => $model,
                'sort' => false,
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]),
        ]);
    }

    public function actionUpdate($id)
    {
        Url::remember();
        $model = Reviews::find()->where(['id' => $id])->with('reviewsImages')->one();
        $images = new ReviewsImages;

        if(Yii::$app->request->isPost && ($images->imageFiles = UploadedFile::getInstances($images, 'imageFiles'))){
            $images->upload($id);
            return $this->redirect(Url::previous() . '#reviews');
        }

        if($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', [
            'model' => $model,
            'images' => $images
        ]);
    }

    /**
     * @param $id
     * @return false|int
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionRemoveImageById($id)
    {
        return ReviewsImages::findOne($id)->delete();
    }

    public function actionEditImage($id)
    {
        $model = ReviewsImages::findOne($id);
        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()){
            return true;
        }
        return $this->renderAjax('_image_edit', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Reviews::find()->where(['id' => $id])->with('reviewsImages')->one();
        $images = new ReviewsImages;
        
        if(Yii::$app->request->isPost && FH::deleteAllImages($model['reviewsImages'],ReviewsImages::PATH) && $model->delete()){
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', [
            'model' => $model,
            'images' => $images
        ]);
    }

    public function actionRemoveChecked()
    {
        $selection = (array)Yii::$app->request->post('selection');
        if(count($selection)){
            foreach($selection as $id){
                $model = Reviews::findOne((int)$id);
                $model->delete();
            }
        }
        return $this->redirect(Yii::$app->homeUrl . $this->module->id);
    }
}
