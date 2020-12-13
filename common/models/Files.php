<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%files}}".
 *
 * @property integer $id
 * @property string $path
 * @property string $title
 * @property string $alt
 *
 * @property Articles[] $articles
 * @property Articles[] $articles0
 * @property Articles[] $articles1
 * @property Banners[] $banners
 * @property Form[] $forms
 * @property News[] $news
 * @property News[] $news0
 * @property News[] $news1
 * @property Pages[] $pages
 * @property Pages[] $pages0
 * @property Rooms[] $rooms
 * @property Rooms[] $rooms0
 * @property Rooms[] $rooms1
 * @property ServicesMenuCategoriesItems[] $servicesMenuCategoriesItems
 * @property Specials[] $specials
 * @property Specials[] $specials0
 * @property Specials[] $specials1
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path'], 'required'],
            [['path', 'title', 'alt'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'title' => 'Title',
            'alt' => 'Alt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['image_header_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles0()
    {
        return $this->hasMany(Articles::className(), ['image_preview_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles1()
    {
        return $this->hasMany(Articles::className(), ['image_rr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banners::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForms()
    {
        return $this->hasMany(Form::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['image_header_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews0()
    {
        return $this->hasMany(News::className(), ['image_preview_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews1()
    {
        return $this->hasMany(News::className(), ['image_rr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages0()
    {
        return $this->hasMany(Pages::className(), ['image_rr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms0()
    {
        return $this->hasMany(Rooms::className(), ['image_main_preview_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms1()
    {
        return $this->hasMany(Rooms::className(), ['image_preview_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesMenuCategoriesItems()
    {
        return $this->hasMany(ServicesMenuCategoriesItems::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecials()
    {
        return $this->hasMany(Specials::className(), ['image_header_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecials0()
    {
        return $this->hasMany(Specials::className(), ['image_preview_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecials1()
    {
        return $this->hasMany(Specials::className(), ['image_rr_id' => 'id']);
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        @unlink(Yii::getAlias('@frontend/web') . $this->path);
        return parent::beforeDelete();
    }
}
