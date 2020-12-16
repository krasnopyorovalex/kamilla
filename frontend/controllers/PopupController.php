<?php

namespace frontend\controllers;

use common\models\Popups;

/**
 * Calculate Controller
 */
class PopupController extends SiteController
{
    public function actionGetPopup($id)
    {
        $this->layout = false;

        $popup = Popups::find()
            ->where(['id' => $id])
            ->limit(1)
            ->one();

        return $this->renderAjax('popup.twig', [
            'text' => $popup->text
        ]);
    }
}