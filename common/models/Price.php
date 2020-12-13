<?php

namespace common\models;

use backend\components\FileBehavior;

/**
 * This is the model class for table "{{%price}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $gallery_id
 * @property integer $room_id
 * @property integer $pos
 *
 * @property Gallery $gallery
 * @property Rooms $room
 * @property PriceDatesVia[] $priceDatesVias
 * @property PriceDates[] $priceDates
 */
class Price extends \yii\db\ActiveRecord
{

    const PATH = '/userfiles/price_icons/';
    const IMAGE_ENTITY = 'image';

    public $file;
    public $attrArray;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price';
    }

    public function behaviors()
    {
        return [
            [
                'class' => FileBehavior::className(),
                'path' => self::PATH,
                'entity_db' => self::IMAGE_ENTITY
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['gallery_id', 'pos'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['image'], 'string', 'max' => 512],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['room_id' => 'id']],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
            ['attrArray', 'safe']
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
            'description' => 'Описание',
            'image' => 'Иконка',
            'file' => 'Иконка',
            'gallery_id' => 'Галерея прайса',
            'pos' => 'Позиция',
            'room_id' => 'Ссылка на номер'
        ];
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
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceDatesVias()
    {
        return $this->hasMany(PriceDatesVia::className(), ['price_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceDates()
    {
        return $this->hasMany(PriceDates::className(), ['id' => 'price_dates_id'])->viaTable('price_dates_via', ['price_id' => 'id']);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if($this->attrArray){
            $this->unlinkAll('priceDates', true);
            foreach ($this->attrArray as $key => $value){
                (new PriceDatesVia([
                    'price_id' => $this->id,
                    'price_dates_id' => $key,
                    'value' => $value
                ]))->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
