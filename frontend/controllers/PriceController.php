<?php

namespace frontend\controllers;

use common\models\PriceDatesVia;

/**
 * Calculate Controller
 */
class PriceController extends SiteController
{
    public function actionGetPricePopup($priceId, $priceDateId)
    {
        $this->layout = false;

        $popup = PriceDatesVia::find()
            ->select('popup')
            ->where(['price_id' => $priceId])
            ->andWhere(['price_dates_id' => $priceDateId])
            ->limit(1)
            ->one();

        return $this->renderAjax('get-price-popup.twig', [
            'popup' => $popup->popup
        ]);
    }
}