<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%banners_pages_via}}".
 *
 * @property integer $banner_id
 * @property integer $page_id
 *
 * @property Banners $banner
 * @property Pages $page
 */
class BannersPagesVia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banners_pages_via}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banner_id', 'page_id'], 'required'],
            [['banner_id', 'page_id'], 'integer'],
            [['banner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Banners::className(), 'targetAttribute' => ['banner_id' => 'id']],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'banner_id' => 'Banner ID',
            'page_id' => 'Page ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanner()
    {
        return $this->hasOne(Banners::className(), ['id' => 'banner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id']);
    }
}
