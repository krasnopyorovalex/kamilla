<?php
namespace frontend\controllers;

use common\models\Pages;
use common\models\Reviews;
use common\models\Settings;
use frontend\components\ParserBehavior;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\Blocks;
use common\models\SeoBlocks;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 *
 * @mixin ParserBehavior
 */
class SiteController extends Controller
{
    public $layout = 'main.twig';
    public $is_canonical = false;

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            [
                'class' => ParserBehavior::className()
            ]
        ]);
    }

    /**
     * @param string $alias
     * @return string
     */
    public function actionIndex($alias = 'index')
    {
        $model = Pages::find()->where(['alias' => $alias])->one();
        return $this->render('index.twig',[
            'model' => $model
        ]);
    }

    /**
     * @param $alias
     * @return string
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionPage($alias)
    {
        /**
         * @var $model Pages
         */
        if(!$model = Pages::find()->where(['alias' => $alias])->with(['banners'])->publish()->limit(1)->one()){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        try {
            \Yii::$app->canonical->checkCanonical($model, $this);
            $model->text = $this->parse($model);
        } catch (\Exception $e) {
            $model->text = $e->getMessage();
        }

        return $this->render('page.twig', [
            'model' => $model
        ]);
    }

    /**
     * @return string
     */
    public function actionError()
    {
        return $this->render('error.twig');
    }

    /**
     * @param $message
     * @return string
     */
    public function actionOffline($message)
    {
        $this->layout = false;
        return $this->render('offline.twig',['message' => $message]);
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        \Yii::$app->params['blocks'] = ArrayHelper::map(Blocks::find()->publish()->asArray()->all(), 'sys_name', 'text');
        \Yii::$app->params['seo_blocks'] = ArrayHelper::map(SeoBlocks::find()->where(['for_frontend' => 1])->asArray()->all(), 'sys_name', 'value');
        \Yii::$app->params['settings'] = ArrayHelper::map(Settings::find()->asArray()->all(), 'sys_name', 'value');
        return true;
    }
}
