<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "price_dates_via".
 *
 * @property integer $price_id
 * @property integer $price_dates_id
 * @property string $value
 * @property string $popup
 *
 * @property Price $price
 * @property PriceDates $priceDates
 */
class PriceDatesVia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price_dates_via';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price_id', 'price_dates_id', 'value'], 'required'],
            [['price_id', 'price_dates_id'], 'integer'],
            [['value'], 'string'],
            [['popup'], 'string'],
            [['price_id'], 'exist', 'skipOnError' => true, 'targetClass' => Price::className(), 'targetAttribute' => ['price_id' => 'id']],
            [['price_dates_id'], 'exist', 'skipOnError' => true, 'targetClass' => PriceDates::className(), 'targetAttribute' => ['price_dates_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'price_id' => 'Price ID',
            'price_dates_id' => 'Price Dates ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
    {
        return $this->hasOne(Price::className(), ['id' => 'price_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceDates()
    {
        return $this->hasOne(PriceDates::className(), ['id' => 'price_dates_id']);
    }
}
