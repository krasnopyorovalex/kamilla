<?php

namespace backend\controllers;

use common\models\Files;
use Yii;
use backend\interfaces\IActions;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use backend\interfaces\ModelProviderInterface;
use yii\web\NotFoundHttpException;
use common\models\Redirects;
use yii\filters\VerbFilter;

class ModuleController extends SiteController implements IActions
{
    /**
     * @var $_model ActiveRecord
     */
    private $_model = null;

    public $actions = [
        'update' => 'Обновление',
        'add' => 'Добавление',
        'delete' => 'Удаление',
    ];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'add', 'update', 'delete', 'remove-image'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'remove-image' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @throws \ErrorException
     */
    public function init()
    {
        if ($this->module instanceof ModelProviderInterface) {
            $this->_model = $this->module->getModel();
        }
        if(!$this->_model){
            throw new \ErrorException('Не реализован метод getModels() у модуля');
        }
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = $this->_model;
        return $this->render('index',[
            'dataProvider' => $this->findData($model::find())
        ]);
    }

    /**
     * @return string
     */
    public function actionAdd()
    {
        $model = new $this->_model;
        $this->loadData($model);
        return $this->render('form',[
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->_model;
        if(!$model = $model::findOne(['id' => $id])){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $this->loadData($model);
        return $this->render('form', ['model' => $model]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->_model;
        if(Yii::$app->request->isPost && $model::findOne($id)->delete()){
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        if(!$model = $model::findOne(['id' => $id])){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('form', ['model' => $model]);
    }

    /**
     * @return bool|false|int
     * @throws \Exception
     * @throws \yii\db\StaleObjectException
     */
    public function actionRemoveImage()
    {
        $id = intval(Yii::$app->request->post('imgId'));
        if( $file = Files::findOne($id) ) {
            return $file->delete();
        }
        return false;
    }

    /**
     * @param $query
     * @return ActiveDataProvider
     */
    protected function findData($query)
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => false
        ]);
    }

    /**
     * @param $model ActiveRecord
     * @param null $redirect
     * @return bool|\yii\web\Response
     */
    protected function loadData($model, $redirect = null)
    {
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(!$model->isNewRecord && $model->isAttributeChanged('alias')){
                $this->insertNewRedirect($model);
            }
            $model->save();
            if( $redirect ){
                return $this->redirect($redirect);
            }
            return $this->redirect(Yii::$app->homeUrl . $this->module->id);
        }
        return true;
    }

    /**
     * @param $model ActiveRecord
     * @return bool
     */
    protected function insertNewRedirect($model)
    {
        return (new Redirects([
            'old_alias' => Redirects::DELIMITER.str_replace(['pages/'], '', $model::tableName().Redirects::DELIMITER.$model->getOldAttribute('alias')),
            'new_alias' => Redirects::DELIMITER.str_replace(['pages/'], '', $model::tableName().Redirects::DELIMITER.$model->alias)
        ]))->save();
    }

}