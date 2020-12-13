<?php

namespace common\models;

use backend\components\FilesBehavior;
use backend\models\PrototypeModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slogan
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property string $text_preview
 * @property string $alias
 * @property string $date
 * @property integer $image_preview_id
 * @property integer $image_header_id
 * @property string $name_rr
 * @property integer $image_rr_id
 * @property string $text_rr
 * @property string $galleries
 * @property integer $publish
 * @property string $video
 *
 * @property Files $imageHeader
 * @property Files $imageRr
 * @property Files $imagePreview
 */
class News extends PrototypeModel
{
    const PATH = '/news/';

    public $imagePreviewFile;
    public $imageHeaderFile;
    public $imageRrFile;

    const IMAGE_PREVIEW_FILE = 'imagePreviewFile';
    const IMAGE_PREVIEW_ID = 'image_preview_id';

    const IMAGE_HEADER_FILE = 'imageHeaderFile';
    const IMAGE_HEADER_ID = 'image_header_id';

    const IMAGE_RR_FILE = 'imageRrFile';
    const IMAGE_RR_ID = 'image_rr_id';

    public function behaviors()
    {
        return [
            [
                'class' => FilesBehavior::className(),
                'path' => self::PATH,
                'column' => self::IMAGE_PREVIEW_ID,
                'field' => self::IMAGE_PREVIEW_FILE
            ],
            [
                'class' => FilesBehavior::className(),
                'path' => self::PATH,
                'column' => self::IMAGE_HEADER_ID,
                'field' => self::IMAGE_HEADER_FILE
            ],
            [
                'class' => FilesBehavior::className(),
                'path' => self::PATH,
                'column' => self::IMAGE_RR_ID,
                'field' => self::IMAGE_RR_FILE
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title', 'alias', 'date'], 'required'],
            [['text', 'text_preview', 'text_rr'], 'string'],
            [['date'], 'safe'],
            [['image_preview_id', 'image_header_id', 'image_rr_id', 'publish'], 'integer'],
            [['name', 'title', 'description', 'keywords', 'slogan'], 'string', 'max' => 512],
            [['alias', 'name_rr', 'video'], 'string', 'max' => 255],
            ['alias', 'unique', 'message' =>  'Такой alias уже есть в системе'],
            ['alias', 'match', 'pattern' => '/[a-zA-Z0-9-]+/', 'message' => 'Кириллица в поле alias запрещена'],
            [['image_header_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_header_id' => 'id']],
            [['image_preview_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_preview_id' => 'id']],
            [['image_rr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_rr_id' => 'id']],
            [['name', 'title'], 'trim'],
            [['galleries', 'metaImage'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название новости',
            'slogan' => 'Слоган',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'text' => 'Текст',
            'text_preview' => 'Краткий текст',
            'alias' => 'Alias',
            'date' => 'Дата',
            'image_preview_id' => 'Главная картинка новости',
            'imagePreviewFile' => 'Главная картинка новости',
            'image_header_id' => 'Изображение в шапке',
            'imageHeaderFile' => 'Изображение в шапке',
            'name_rr' => 'Название',
            'imageRrFile' => 'Фото',
            'text_rr' => 'Краткий текст',
            'publish' => 'Публикация',
            'galleries' => 'Прикреплённые галереи',
            'video' => 'Ссылка на видео'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageHeader()
    {
        return $this->hasOne(Files::className(), ['id' => 'image_header_id']);
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
    public function getImageRr()
    {
        return $this->hasOne(Files::className(), ['id' => 'image_rr_id']);
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return Url::toRoute(['news/page', 'alias' => $this->alias]);
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        PagesAttaches::deleteAll(['table_name' => self::tableName(), 'entity_id' => $this->id]);
        return parent::beforeDelete();
    }

    /**
     * @return array
     */
    public function getGalleries()
    {
        return ArrayHelper::map(Gallery::find()->asArray()->all(),'id','name');
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->galleries = json_decode($this->galleries);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->galleries = json_encode($this->galleries);
        return parent::beforeSave($insert);
    }
}
