<?php

namespace common\models;

use backend\models\PrototypeModel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%gallery}}".
 *
 * @property integer $id
 * @property string $sys_name
 * @property integer $add_menu
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text_above
 * @property string $text_below
 * @property string $alias
 * @property integer $view_in_gallery
 * @property integer $publish
 * @property integer $pos
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property GalleryImages[] $galleryImages
 * @property Price[] $prices
 * @property Rooms[] $rooms
 */
class Gallery extends PrototypeModel
{
    const VIEW_IN_GALLERY = 1;
    const ADD_MENU = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gallery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_name', 'name', 'title', 'alias'], 'required'],
            [['text_above', 'text_below'], 'string'],
            [['view_in_gallery', 'publish', 'pos', 'created_at', 'updated_at', 'add_menu'], 'integer'],
            [['sys_name'], 'string', 'max' => 64],
            [['name', 'title', 'description', 'keywords'], 'string', 'max' => 512],
            [['alias'], 'string', 'max' => 255],
            ['alias', 'unique', 'message' =>  'Такой alias уже есть в системе'],
            ['alias', 'match', 'pattern' => '/[a-zA-Z0-9-]+/', 'message' => 'Кириллица в поле alias запрещена']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sys_name' => 'Системное имя',
            'name' => 'Название галереи',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'text_above' => 'Текст перед фото',
            'text_below' => 'Текстпосле фото',
            'alias' => 'Alias',
            'view_in_gallery' => 'Отображать в разделе Галерея?',
            'publish' => 'Публикация',
            'pos' => 'Позиция',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'add_menu' => 'Собрать в меню?'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryImages()
    {
        return $this->hasMany(GalleryImages::className(), ['gallery_id' => 'id'])->orderBy('pos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['gallery_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['gallery_id' => 'id']);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getGalleriesList($id)
    {
        return ArrayHelper::map(self::find()->where(['<>', 'id', $id])->asArray()->all(), 'id', 'name');
    }

    /**
     * @return array|mixed|null
     */
    public function dropDown()
    {
        return $this->tree(self::find()->asArray()->all(), $this->id);
    }
}
