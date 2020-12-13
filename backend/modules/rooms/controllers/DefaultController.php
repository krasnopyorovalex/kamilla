<?php

namespace backend\modules\rooms\controllers;

use backend\controllers\ModuleController;
use common\models\Rooms;
use common\models\RoomsAttributes;
use common\models\RoomsTabs;
use yii\helpers\ArrayHelper;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Default controller for the `rooms` module
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
            'dataProvider' => $this->findData(Rooms::find()->orderBy('pos'))
        ]);
    }

    public function actionAdd()
    {
        $model = new Rooms();
        $this->loadData($model);
        return $this->render('form',[
            'model' => new $model,
            'attributes_room' => [],
            'attributes_array' => RoomsAttributes::find()->asArray()->all(),
            'tabs_room' => [],
            'tabs_array' => RoomsTabs::find()->asArray()->all(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Rooms::find()->where(['id' => $id])->with(['roomsAttributesVias'])->one();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->isAttributeChanged('alias')){
                $this->insertNewRedirect($model);
            }
            $model->save();
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form',[
            'model' =>  $model,
            'attributes_room' => ArrayHelper::map($model['roomsAttributesVias'], 'attribute_id', 'value'),
            'attributes_array' => RoomsAttributes::find()->asArray()->all(),
            'tabs_room' => ArrayHelper::map($model['roomsTabsVias'], 'tab_id', 'value'),
            'tabs_array' => RoomsTabs::find()->asArray()->all(),
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
        $model = Rooms::findOne($id);
        if(Yii::$app->request->isPost && $model->delete()){
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return $this->render('form', [
            'model' => $model,
            'attributes_room' => ArrayHelper::map($model['roomsAttributesVias'], 'attribute_id', 'value'),
            'attributes_array' => RoomsAttributes::find()->asArray()->all(),
            'tabs_room' => ArrayHelper::map($model['roomsTabsVias'], 'tab_id', 'value'),
            'tabs_array' => RoomsTabs::find()->asArray()->all(),
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
            if($rooms = Rooms::findOne((int)$id)){
                $rooms->pos = $pos;
                $rooms->update();
            }
        }
        if(Yii::$app->request->post('positions')){
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        } else {
            return true;
        }
    }
}
