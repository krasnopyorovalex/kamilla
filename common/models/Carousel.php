<?php

namespace common\models;

use backend\models\PrototypeModel;
use Yii;

/**
 * This is the model class for table "carousel".
 *
 * @property integer $id
 * @property string $name
 * @property string $video
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CarouselImages[] $carouselImages
 */
class Carousel extends PrototypeModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carousel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 512],
            [['video'], 'string', 'max' => 128],
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
            'video' => 'Ссылка на видео',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarouselImages()
    {
        return $this->hasMany(CarouselImages::className(), ['carousel_id' => 'id'])->orderBy('pos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarouselImagesPublish()
    {
        return $this->hasMany(CarouselImages::className(), ['carousel_id' => 'id'])->orderBy('pos')->andWhere(['publish' => 1])->andWhere(['is_mob_show' => 0]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarouselImagesIsMobPublish()
    {
        return $this->hasMany(CarouselImages::className(), ['carousel_id' => 'id'])->orderBy('pos')->andWhere(['publish' => 1])->andWhere(['is_mob_show' => 1]);
    }
}
