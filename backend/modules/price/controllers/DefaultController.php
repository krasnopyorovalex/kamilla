<?php

namespace backend\modules\price\controllers;

use backend\controllers\ModuleController;
use common\models\Gallery;
use common\models\Price;
use common\models\PriceDates;
use common\models\Rooms;
use yii\helpers\ArrayHelper;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Default controller for the `price` module
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
                        'actions' => ['update-pos'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update-pos' => ['post']
                ],
            ],
        ]);
    }
    
    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => $this->findData(Price::find()->orderBy('pos'))
        ]);
    }
    
    public function actionAdd()
    {
        $model = new Price();
        $this->loadData($model);
        return $this->render('form',[
            'model' => new $model,
            'attributes_price' => [],
            'attributes_popup' => [],
            'attributes_array' => PriceDates::find()->asArray()->all(),
            'galleries' => ArrayHelper::map(Gallery::find()->asArray()->all(),'id','name'),
            'rooms' => ArrayHelper::map(Rooms::find()->asArray()->all(),'id','name')
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Price::find()->where(['id' => $id])->with(['priceDatesVias'])->one();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->isAttributeChanged('alias')){
                $this->insertNewRedirect($model);
            }
            $model->save();
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form',[
            'model' =>  $model,
            'attributes_price' => ArrayHelper::map($model['priceDatesVias'], 'price_dates_id', 'value'),
            'attributes_popup' => ArrayHelper::map($model['priceDatesVias'], 'price_dates_id', 'popup'),
            'attributes_array' => PriceDates::find()->asArray()->all(),
            'galleries' => ArrayHelper::map(Gallery::find()->asArray()->all(),'id','name'),
            'rooms' => ArrayHelper::map(Rooms::find()->asArray()->all(),'id','name')
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = Price::findOne($id);
        if(Yii::$app->request->isPost && $model->delete()){
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', [
            'model' => $model,
            'attributes_price' => ArrayHelper::map($model['priceDatesVias'], 'price_dates_id', 'value'),
            'attributes_popup' => ArrayHelper::map($model['priceDatesVias'], 'price_dates_id', 'popup'),
            'attributes_array' => PriceDates::find()->asArray()->all(),
            'galleries' => ArrayHelper::map(Gallery::find()->asArray()->all(),'id','name'),
            'rooms' => ArrayHelper::map(Rooms::find()->asArray()->all(),'id','name')
        ]);
    }
    
    /**
     * @return bool|\yii\web\Response
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionUpdatePos()
    {
        $to_db = array_flip(Yii::$app->request->post('positions'));
        foreach($to_db as $pos => $id){
            if($rooms = Price::findOne((int)$id)){
                $rooms->pos = $pos;
                $rooms->update();
            }
        }
        return $this->redirect(Yii::$app->homeUrl . $this->module->id);
    }
}
