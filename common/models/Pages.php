<?php

namespace common\models;

use backend\components\AttachBehavior;
use backend\components\FilesBehavior;
use backend\models\PrototypeModel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $template
 * @property string $name
 * @property string $slogan
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property string $alias
 * @property integer $image_id
 * @property integer $name_is_h1
 * @property string $galleries
 * @property integer $carousel_id
 * @property integer $publish
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $video
 *
 * @property BannersPagesVia[] $bannersPagesVias
 * @property Banners[] $banners
 * @property Carousel $carousel
 * @property Files $image
 * @property Pages $parent
 * @property Pages[] $pages
 * @property PagesAttaches[] $pagesAttaches
 * @property Files $imageRr
 *
 * @mixin AttachBehavior
 */
class Pages extends PrototypeModel
{
    private $templates = [
        'index.twig' => 'Главная страница',
        'page.twig' => 'Информационная страница',
    ];

    const PATH = '/pages/';
    const MAX_ATTACHES = 4;

    public $attaches;
    public $imageFile;
    public $imageRrFile;

    const IMAGE_FILE = 'imageFile';
    const IMAGE_ID = 'image_id';

    const IMAGE_RR_FILE = 'imageRrFile';
    const IMAGE_RR_ID = 'image_rr_id';

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
                'column' => self::IMAGE_RR_ID,
                'field' => self::IMAGE_RR_FILE
            ],
            [
                'class' => AttachBehavior::className()
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'image_id', 'name_is_h1', 'publish', 'image_rr_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'title', 'alias'], 'required'],
            [['text', 'text_rr'], 'string'],
            [['template'], 'string', 'max' => 32],
            [['name', 'title', 'description', 'keywords', 'slogan'], 'string', 'max' => 512],
            [['alias', 'name_rr', 'video'], 'string', 'max' => 255],
            [['carousel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carousel::className(), 'targetAttribute' => ['carousel_id' => 'id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['image_rr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_rr_id' => 'id']],
            [['name', 'title'], 'trim'],
            ['alias', 'unique', 'message' =>  'Такой alias уже есть в системе'],
            ['alias', 'match', 'pattern' => '/[a-zA-Z0-9-]+/', 'message' => 'Кириллица в поле alias запрещена'],
            [['metaImage','galleries','attaches'], 'safe'],
            ['attaches', 'validateAttaches'],
        ];
    }

    public function validateAttaches($attribute, $params)
    {
        if(count($this->attaches) > self::MAX_ATTACHES) {
            $this->addError($attribute, 'Нельзя прикрепить больше 4-х элементов');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская страница',
            'template' => 'Шаблон страницы',
            'name' => 'Название',
            'slogan' => 'Слоган',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'text' => 'Текст',
            'alias' => 'Alias',
            'image_id' => 'Image ID',
            'name_is_h1' => 'Обернуть название в h1?',
            'galleries' => 'Прикреплённые галереи',
            'carousel_id' => 'Карусель',
            'publish' => 'Публикация',
            'name_rr' => 'Название',
            'imageRrFile' => 'Фото',
            'text_rr' => 'Краткий текст',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'video' => 'Ссылка на видео'
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
    public function getImageRr()
    {
        return $this->hasOne(Files::className(), ['id' => 'image_rr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Pages::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannersPagesVias()
    {
        return $this->hasMany(BannersPagesVia::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banners::className(), ['id' => 'banner_id'])->viaTable('{{%banners_pages_via}}', ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarousel()
    {
        return $this->hasOne(Carousel::className(), ['id' => 'carousel_id']);
    }

    /**
     * @return array|mixed|null
     */
    public function dropDown()
    {
        return $this->tree(self::find()->asArray()->all(), $this->id);
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    /**
     * @return array
     */
    public function getGalleries()
    {
        return ArrayHelper::map(Gallery::find()->asArray()->all(),'id','name');
    }

    /**
     * @return array
     */
    public function getCarousels()
    {
        return ArrayHelper::map(Carousel::find()->asArray()->all(),'id','name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagesAttaches()
    {
        return $this->hasMany(PagesAttaches::className(), ['page_id' => 'id']);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->galleries = json_decode($this->galleries);
        $this->attaches = $this->getAttaches($this->getPagesAttaches()->all());
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->galleries = json_encode($this->galleries);

        $this->unlinkAll('pagesAttaches', true);
        if($this->attaches){
            foreach ($this->attaches as $value){
                $chunks = explode('_', $value);
                (new PagesAttaches([
                    'page_id' => $this->id,
                    'table_name' => $chunks[0],
                    'entity_id' => $chunks[1]
                ]))->save();
            }
        }
        return parent::beforeSave($insert);
    }
}
