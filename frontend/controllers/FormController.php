<?php

namespace frontend\controllers;

use common\models\Form;
use frontend\components\FormComponent;
use frontend\models\SendModel;
use yii\helpers\Json;
use yii\filters\VerbFilter;

/**
 * Form Controller
 */
class FormController extends SiteController
{
    private $_form;
    private $_text;
    private $_is_valid = true;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'contact' => ['post'],
                    'order' => ['post'],
                ],
            ],
        ];
    }

    public function actionContact()
    {
        if($this->_is_valid) {
            $model = new SendModel();
            $model->send($this->_form, $this->_text);
            return $this->asJson(['status' => 'success', 'message' => \Yii::$app->params['success_send_form']]);
        }
        return $this->asJson(['status' => 'error', 'message' => \Yii::$app->params['error_send_form']]);
    }

    public function actionOrder()
    {
        if($this->_is_valid){
            $model = new SendModel();
            $model->send($this->_form, $this->_text);
            return $this->asJson(['status' => 'success', 'message' => \Yii::$app->params['success_send_form']]);
        }
        return $this->asJson(['status' => 'error', 'message' => \Yii::$app->params['error_send_form']]);
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
        if(!FormComponent::validate()){
            $this->_is_valid = false;
        }
        //////////////////////////
        $this->_form = Form::find()->where(['sys_name' => \Yii::$app->request->post('sys_name')])->one();
        $fields = Json::decode($this->_form['json_schema']);
        $this->_text = FormComponent::writeText($fields);
        return true;
    }
}