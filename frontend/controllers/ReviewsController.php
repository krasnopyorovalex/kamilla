<?php
namespace frontend\controllers;

use common\models\Reviews;
use ReCaptcha\ReCaptcha;
use yii\filters\VerbFilter;

/**
 * Reviews Controller
 */
class ReviewsController extends SiteController
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
                    'form' => ['post']
                ],
            ],
        ];
    }

    public function actionAdd()
    {
        $model = new Reviews();
        $recaptcha = new ReCaptcha(\Yii::$app->params['settings']['g_private_key']);
        $resp = $recaptcha->verify(\Yii::$app->request->post('g-recaptcha-response'), \Yii::$app->request->getUserIP());

        if($resp->isSuccess() && $model->load(\Yii::$app->request->post()) && $model->validate()){
            $model['date'] = date('Y-m-d');
            $model['ip'] = \Yii::$app->request->userIP;
            $model->save(false);
            return $this->asJson(['status' => 'success', 'message' => \Yii::$app->params['review_success']]);
        }

        return $this->asJson(['status' => 'error', 'message' => \Yii::$app->params['error_send']]);
    }

    public function actionForm()
    {
        $this->layout  = false;

        return $this->renderAjax('guestbook-form.twig', [
            'guestbook' => new Reviews()
        ]);
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, ['form'])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

}