<?php

namespace frontend\widgets\GuestbookMainPage;

use common\models\Reviews as Model;
use yii\base\Widget;

class GuestbookMainPage extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('guestbook.twig', [
            'model' => Model::find()->publish()->where(['show_in_main' => Model::SHOW_MAIN])->orderBy('date DESC')->all()
        ]);
    }
}