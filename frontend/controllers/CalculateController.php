<?php

namespace frontend\controllers;

use common\models\Form;
use frontend\forms\CalculateForm;
use ReCaptcha\ReCaptcha;
use yii\filters\VerbFilter;

/**
 * Calculate Controller
 */
class CalculateController extends SiteController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get-calculation-form' => ['post'],
                    'send-calculation-form' => ['post'],
                ],
            ],
        ];
    }

    public function actionSendCalculationForm()
    {
        $model = new CalculateForm();
        $recaptcha = new ReCaptcha(\Yii::$app->params['settings']['g_private_key']);
        $resp = $recaptcha->verify(\Yii::$app->request->post('g-recaptcha-response'), \Yii::$app->request->getUserIP());

        if($resp->isSuccess() && $model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->sendEmail(Form::find()->limit(1)->column('email'));
            return $this->asJson(['status' => 'success', 'message' => \Yii::$app->params['calculate_success']]);
        }

        return $this->asJson(['status' => 'error', 'message' => \Yii::$app->params['calculate_error']]);
    }

    public function actionGetCalculationForm()
    {
        $this->layout  = false;

        return $this->renderAjax('calculation-form.twig', [
            'calculate' => new CalculateForm
        ]);
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, ['get-calculation-form'])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

}