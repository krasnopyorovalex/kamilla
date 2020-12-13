<?php

namespace frontend\models;

use Yii;

class SendModel
{
    /**
     * @param $form
     * @param $text
     * @return bool
     */
    public function send($form, $text)
    {
        return Yii::$app->mailer->compose()
            ->setFrom(['resorts-bron5@yandex.ru' => $form['name']])
            ->setTo(explode(',', $form['email']))
            ->setHtmlBody($text['text_email'])
            ->setSubject($form['theme'])
            ->send();
    }

}