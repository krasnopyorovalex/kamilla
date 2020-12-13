<?php

namespace backend\modules\seo_blocks\controllers;

use backend\controllers\SiteController;
use common\models\SeoBlocks;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use Yii;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * Default controller for the `seo_blocks` module
 */
class DefaultController extends SiteController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $seo_blocks = SeoBlocks::find()->asArray()->all();
        return $this->render('index',[
            'seo_blocks' => ArrayHelper::index($seo_blocks, 'sys_name')
        ]);
    }

    public function actionUpdate($id)
    {
        $model = SeoBlocks::findOne($id);
        if(Yii::$app->request->isPost) {
            if ($model->file = UploadedFile::getInstanceByName('file')) {
                $model->upload();
                return $this->redirect(Yii::$app->homeUrl . $this->module->id);
            }

            $model->value = Yii::$app->request->post('value');
            $model->show_in_pages = Yii::$app->request->post('checked') ? Json::encode(Yii::$app->request->post('checked')) : '';
            $model->save();
        }
        return $this->redirect(Yii::$app->homeUrl . $this->module->id);
    }
}
