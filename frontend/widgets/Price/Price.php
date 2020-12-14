<?php

namespace frontend\widgets\Price;

use common\models\PriceDates;
use common\models\PriceDatesVia;
use common\models\Price as Model;
use common\models\PriceSettings;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class Price extends Widget
{
    public $idList = [];

    private $template = 'price.twig';

    /**
     * @return string
     */
    public function run()
    {
        if (\Yii::$app->mobileDetect->isMobile()) {
            $this->template = 'price_mobile.twig';
        }

        $attributesPriceQuery = Model::find()->with(['priceDatesVias', 'gallery' => function($query) {
            return $query->with(['galleryImages'])->orderBy('pos');
        }, 'room'])->orderBy('pos');

        if ($this->idList) {
            $attributesPriceQuery->andWhere(['id' => $this->idList]);
        }

        return $this->render($this->template, [
            'attributes_price' => $attributesPriceQuery->all(),
            'attributes_array' => PriceDates::find()->asArray()->all(),
            'price_dates_vias' => ArrayHelper::map(PriceDatesVia::find()->asArray()->all(), function ($item){
                return $item['price_id'].'_'.$item['price_dates_id'];
            },'value'),
            'settings' => PriceSettings::findOne(1)
        ]);
    }
}
