<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use backend\components\TreeBehavior;

/**
 * This is the model class for table "carousel_images".
 *
 * @property integer $id
 * @property integer $carousel_id
 * @property string $color
 * @property string $name
 * @property string $text_top
 * @property string $text_middle
 * @property string $text_btn
 * @property string $link
 * @property string $alt
 * @property string $title
 * @property string $basename
 * @property string $ext
 * @property integer $publish
 * @property integer $is_mob_show
 * @property integer $pos
 *
 * @property Carousel $carousel
 */
class CarouselImages extends ActiveRecord
{

    const PATH = '/web/userfiles/carousel/';

    public $file;

    public function behaviors()
    {
        return [
            [
                'class' => TreeBehavior::className()
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carousel_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['carousel_id', 'name', 'caption', 'link', 'alt', 'title', 'basename', 'ext', 'pos'], 'required'],
            [['carousel_id', 'publish', 'pos'], 'integer'],
            [['name', 'link', 'alt', 'title', 'text_top', 'text_middle', 'text_btn'], 'string', 'max' => 512],
            [['basename'], 'string', 'max' => 256],
            [['ext'], 'string', 'max' => 5],
            [['color'], 'string', 'max' => 7],
            [['carousel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Carousel::className(), 'targetAttribute' => ['carousel_id' => 'id']],
            ['is_mob_show', 'default', 'value' => 0]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carousel_id' => 'Carousel ID',
            'name' => 'Название слайда',
            'text_top' => 'Верхний текст',
            'text_middle' => 'Средний текст',
            'text_btn' => 'Кнопка',
            'link' => 'Ссылка',
            'alt' => 'Alt',
            'title' => 'Title',
            'basename' => 'Basename',
            'ext' => 'Ext',
            'publish' => 'Публикация',
            'pos' => 'Pos',
            'color' => 'Цвет текста',
            'is_mob_show' => 'Отображать только в мобильной версии?'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarousel()
    {
        return $this->hasOne(Carousel::className(), ['id' => 'carousel_id']);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $path = Yii::getAlias('@frontend'.self::PATH . $this->carousel_id . DIRECTORY_SEPARATOR);
            unlink($path . $this->basename .'.'. $this->ext);
            unlink($path . $this->basename .'_thumb.'. $this->ext);
            return true;
        } else {
            return false;
        }
    }
}
