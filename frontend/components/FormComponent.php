<?php

namespace frontend\components;

use common\models\Form;
use common\models\Reviews;
use ReCaptcha\ReCaptcha;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\UploadedFile;

class FormComponent
{
    const DELIMITER = ' ';
    
    public static function validate()
    {
        if(!$form = Form::find()->where(['sys_name' => \Yii::$app->request->post('sys_name')])->one()){
            return false;
        } else {

            $schema = Json::decode($form['json_schema']);
            //captcha
            if($form['captcha']){
                $recaptcha = new ReCaptcha(\Yii::$app->params['settings']['g_private_key']);
                $resp = $recaptcha->verify(\Yii::$app->request->post('g-recaptcha-response'), \Yii::$app->request->getUserIP());
                if(!$resp->isSuccess()){
                    return false;
                }
            }

            $required_fields = array_filter($schema, function ($item){
                return $item['required'];
            });

            if($required_fields){
                foreach (array_keys($required_fields) as $field){
                    if(!is_array(\Yii::$app->request->post($field)) && trim(\Yii::$app->request->post($field)) == ''){
                        return false;
                    }
                }
            }

            if($form['images_on'] && ($images = UploadedFile::getInstancesByName('images'))){
                foreach ($images as $file) {
                    $file->saveAs(\Yii::getAlias('@frontend/web' . Reviews::PATH) . $file->baseName . '.' . $file->extension);
                }
            }
        }
        return true;
    }

    public static function writeText($fields)
    {
        $text['text_db'] = '';
        $text['text_email'] = '';
        $text['email'] = '';
        foreach(\Yii::$app->request->post() as $key => $item){
            if(isset($fields[$key])){
                if(is_array($item)){
                    $text['text_db'] .= Html::tag('p', implode(', ', $item));
                    $text['text_email'] .= Html::tag('p', (Html::tag('b', $fields[$key]['label'] ? $fields[$key]['label'] : $fields[$key]['placeholder'])) .' '. self::DELIMITER . implode(', ', $item));
                } else {
                    strstr($item,'@')
                        ? $text['email'] = $item
                        : $text['text_db'] .= Html::tag('p', $item);
                    $text['text_email'] .= Html::tag('p', (Html::tag('b', $fields[$key]['label'] ? $fields[$key]['label'] : $fields[$key]['placeholder'])) .' '. self::DELIMITER . $item);
                }
            }
        }
        return $text;
    }
    
}