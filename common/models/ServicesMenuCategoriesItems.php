<?php

namespace common\models;

use backend\components\FilesBehavior;
use backend\models\PrototypeModel;

/**
 * This is the model class for table "{{%services_menu_categories_items}}".
 *
 * @property integer $id
 * @property integer $services_menu_category_id
 * @property string $name
 * @property string $name_link
 * @property integer $image_id
 * @property string image_link
 * @property string $text
 * @property string $price
 *
 * @property Files $image
 * @property ServicesMenuCategories $servicesMenuCategory
 */
class ServicesMenuCategoriesItems extends PrototypeModel
{
    const PATH = '/services_menu_categories_items/';

    public $imageFile;

    const IMAGE_FILE = 'imageFile';
    const IMAGE_ID = 'image_id';

    public function behaviors()
    {
        return [
            [
                'class' => FilesBehavior::className(),
                'path' => self::PATH,
                'column' => self::IMAGE_ID,
                'field' => self::IMAGE_FILE
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%services_menu_categories_items}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['services_menu_category_id', 'name'], 'required'],
            [['services_menu_category_id', 'image_id'], 'integer'],
            [['text', 'price'], 'string'],
            [['name'], 'string', 'max' => 512],
            [['name_link', 'image_link'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['services_menu_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServicesMenuCategories::className(), 'targetAttribute' => ['services_menu_category_id' => 'id']],
            [['metaImage'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'services_menu_category_id' => 'Services Menu Category ID',
            'name' => 'Название',
            'image_id' => 'Image ID',
            'imageFile' => 'Изображение',
            'text' => 'Текст',
            'price' => 'Цена',
            'name_link' => 'Ссылка для названия',
            'image_link' => 'Ссылка для фото'
        ];
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
    public function getServicesMenuCategory()
    {
        return $this->hasOne(ServicesMenuCategories::className(), ['id' => 'services_menu_category_id']);
    }
}
