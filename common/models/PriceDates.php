<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "price_dates".
 *
 * @property integer $id
 * @property string $name
 *
 * @property PriceDatesVia[] $priceDatesVias
 * @property Price[] $prices
 */
class PriceDates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price_dates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceDatesVias()
    {
        return $this->hasMany(PriceDatesVia::className(), ['price_dates_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['id' => 'price_id'])->viaTable('price_dates_via', ['price_dates_id' => 'id']);
    }
}
