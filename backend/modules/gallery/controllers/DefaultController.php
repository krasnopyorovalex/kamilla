<?php

namespace backend\modules\gallery\controllers;

use backend\controllers\ModuleController;
use common\models\Gallery;
use common\models\GalleryImages;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use backend\components\Multiupload;

/**
 * Default controller for the `gallery` module
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
                        'actions' => ['image-edit','update-positions', 'load', 'image-remove', 'update-pos', 'remove-checked','copy-checked','move-checked'],
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
                    'update-pos' => ['post'],
                    'remove-checked' => ['post'],
                    'move-checked' => ['post'],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => $this->findData(Gallery::find()->orderBy('pos'))
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Gallery::find()->where(['id' => $id])->with(['galleryImages'])->one();
        $this->loadData($model);
        return $this->render('form', [
            'model' => $model,
            'images' => new GalleryImages
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
        if(Yii::$app->request->isPost && Gallery::findOne($id)->delete()){
            GalleryImages::deleteAll(['gallery_id' => $id]);
            FileHelper::removeDirectory(Yii::getAlias('@frontend'.GalleryImages::PATH . $id . Multiupload::DELIMITER));
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', [
            'model' => Gallery::findOne($id),
            'images' => new GalleryImages
        ]);
    }

    public function actionImageEdit($id)
    {
        $model = GalleryImages::findOne($id);
        if($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()){
            return Json::encode($this->renderAjax('_image_box', ['model' => Gallery::find()->where(['id' => $model->gallery_id])->with(['galleryImages'])->one()]));
        }
        return $this->renderAjax('_image_edit', ['model' => $model]);
    }

    public function actionUpdatePositions()
    {
        foreach(Yii::$app->request->post('values') as $key => $value)
        {
            $image = GalleryImages::findOne(['id' => (int)$value]);
            $image->pos = $key;
            $image->update();
        }
    }

    public function actionLoad($id)
    {
        return $this->_load($id);
    }
    
    public function actionImageRemove($id)
    {
        return GalleryImages::findOne($id)->delete();
    }

    public function actionUpdatePos()
    {
        if(Yii::$app->request->post('positions')){
            $to_db = array_flip(Yii::$app->request->post('positions'));
        } else {
            $to_db = Yii::$app->request->post('data');
        }
        foreach($to_db as $pos => $id){
            if($gallery = Gallery::findOne((int)$id)){
                $gallery->pos = $pos;
                $gallery->update();
            }
        }
        if(Yii::$app->request->post('positions')){
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        } else {
            return true;
        }
    }

    public function actionRemoveChecked($id)
    {
        $this->_removeImages($id);
        return $this->_load($id);
    }

    public function actionMoveChecked($id)
    {
        $this->_copyImages();
        $this->_removeImages($id);
        return $this->_load($id);
    }

    public function actionCopyChecked($id)
    {
        $this->_copyImages();
        return $this->_load($id);
    }

    private function _load($id)
    {
        return $this->renderAjax('_image_box', ['model' => Gallery::find()->where(['id' => $id])->with(['galleryImages'])->one()]);
    }

    private function _copyImages()
    {
        foreach (Yii::$app->request->post('data') as $item){
            $model = GalleryImages::findOne((int)($item));
            $model->copyImage((int)Yii::$app->request->post('gallery_to'));
        }
    }

    private function _removeImages($id)
    {
        foreach (Yii::$app->request->post('data') as $item){
            GalleryImages::find()->where(['id' => (int)$item, 'gallery_id' => $id])->one()->delete();
        }
    }

}