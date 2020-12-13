<?php

namespace common\models;

use backend\components\FilesBehavior;
use backend\models\PrototypeModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%rooms}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slogan
 * @property string $alias
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property string $text_preview
 * @property string $price
 * @property integer $image_id
 * @property integer $image_main_preview_id
 * @property integer $image_preview_id
 * @property integer $gallery_id
 * @property integer $publish
 * @property integer $show_in_main
 * @property string $menu_name
 * @property integer $pos
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $video
 *
 * @property Price[] $prices
 * @property Gallery $gallery
 * @property Files $image
 * @property Files $imageMainPreview
 * @property Files $imagePreview
 * @property RoomsAttributesVia[] $roomsAttributesVias
 * @property RoomsAttributes[] $attributes
 * @property RoomsTabsVia[] $roomsTabsVias
 * @property RoomsTabs[] $tabs
 */
class Rooms extends PrototypeModel
{
    static $attrs;

    const PATH = '/rooms/';
    const IMAGE_ENTITY = 'image';

    public $attrArray;
    public $tabsArray;
    public $imageFile;
    public $imageMainPreviewFile;
    public $imagePreviewFile;

    const IMAGE_FILE = 'imageFile';
    const IMAGE_ID = 'image_id';

    const IMAGE_MAIN_PREVIEW_FILE = 'imageMainPreviewFile';
    const IMAGE_MAIN_PREVIEW_ID = 'image_main_preview_id';

    const IMAGE_PREVIEW_FILE = 'imagePreviewFile';
    const IMAGE_PREVIEW_ID = 'image_preview_id';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            [
                'class' => FilesBehavior::className(),
                'path' => self::PATH,
                'column' => self::IMAGE_ID,
                'field' => self::IMAGE_FILE
            ],
            [
                'class' => FilesBehavior::className(),
                'path' => self::PATH,
                'column' => self::IMAGE_PREVIEW_ID,
                'field' => self::IMAGE_PREVIEW_FILE
            ],
            [
                'class' => FilesBehavior::className(),
                'path' => self::PATH,
                'column' => self::IMAGE_MAIN_PREVIEW_ID,
                'field' => self::IMAGE_MAIN_PREVIEW_FILE
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'title'], 'required'],
            [['text', 'text_preview'], 'string'],
            [['image_id', 'image_main_preview_id', 'image_preview_id', 'gallery_id', 'publish', 'show_in_main', 'pos', 'created_at', 'updated_at'], 'integer'],
            [['name', 'slogan', 'menu_name', 'video'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 128],
            [['title', 'description', 'keywords', 'price'], 'string', 'max' => 512],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['image_main_preview_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_main_preview_id' => 'id']],
            [['image_preview_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_preview_id' => 'id']],
            [['name', 'title'], 'trim'],
            ['alias', 'unique', 'message' =>  'Такой alias уже есть в системе'],
            ['alias', 'match', 'pattern' => '/[a-zA-Z0-9-]+/', 'message' => 'Кириллица в поле alias запрещена'],
            [['attrArray', 'metaImage', 'tabsArray'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название номера',
            'slogan' => 'Слоган',
            'alias' => 'Alias',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'text' => 'Текст',
            'text_preview' => 'Краткий текст номера',
            'price' => 'Цена',
            'image_id' => 'Image ID',
            'image_main_preview_id' => 'Image Main Preview ID',
            'image_preview_id' => 'Image Preview ID',
            'gallery_id' => 'Галерея номера',
            'publish' => 'Публикация',
            'show_in_main' => 'Отображать на главной?',
            'menu_name' => 'Название в меню',
            'pos' => 'Позиция',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'imageMainPreviewFile' => 'Для главной',
            'imageFile' => 'Для шапки',
            'imagePreviewFile' => 'Фото номера для каталога',
            'video' => 'Ссылка на видео'
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->attrArray){
            $this->unlinkAll('attributesRooms', true);
            foreach ($this->attrArray as $key => $value){
                (new RoomsAttributesVia([
                    'room_id' => $this->id,
                    'attribute_id' => $key,
                    'value' => $value
                ]))->save();
            }
        }
        if($this->tabsArray){
            $this->unlinkAll('tabs', true);
            foreach ($this->tabsArray as $key => $value){
                (new RoomsTabsVia([
                    'room_id' => $this->id,
                    'tab_id' => $key,
                    'value' => $value
                ]))->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Files::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageMainPreview()
    {
        return $this->hasOne(Files::className(), ['id' => 'image_main_preview_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagePreview()
    {
        return $this->hasOne(Files::className(), ['id' => 'image_preview_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsAttributesVias()
    {
        return $this->hasMany(RoomsAttributesVia::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributesRooms()
    {
        return $this->hasMany(RoomsAttributes::className(), ['id' => 'attribute_id'])->viaTable('rooms_attributes_via', ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsTabsVias()
    {
        return $this->hasMany(RoomsTabsVia::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabs()
    {
        return $this->hasMany(RoomsTabs::className(), ['id' => 'tab_id'])->viaTable('{{%rooms_tabs_via}}', ['room_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return Url::toRoute(['catalog/index', 'alias' => $this->alias]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getNameAttributeById($id)
    {
        if( ! self::$attrs ) {
            self::$attrs = ArrayHelper::map(RoomsAttributes::find()->asArray()->all(),'id','name');
        }

        return self::$attrs[$id];
    }

    /**
     * @return array
     */
    public function getGalleries()
    {
        return ArrayHelper::map(Gallery::find()->asArray()->all(),'id','name');
    }
}
