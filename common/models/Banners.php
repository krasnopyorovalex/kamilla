<?php

namespace common\models;

use backend\components\FilesBehavior;
use backend\models\PrototypeModel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%banners}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $image_id
 * @property string $link
 *
 * @property Files $image
 * @property BannersPagesVia[] $bannersPagesVias
 * @property Pages[] $pages
 */
class Banners extends PrototypeModel
{

    const PATH = '/banners/';

    public $imageFile;
    public $entities;

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
        return '{{%banners}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['image_id'], 'integer'],
            [['name', 'link'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['entities', 'metaImage'], 'safe']
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
            'image_id' => 'Image ID',
            'imageFile' => 'Изображение баннера',
            'link' => 'Ссылка',
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
    public function getBannersPagesVias()
    {
        return $this->hasMany(BannersPagesVia::className(), ['banner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['id' => 'page_id'])->viaTable('{{%banners_pages_via}}', ['banner_id' => 'id']);
    }

    public function getListPages()
    {
        return ArrayHelper::map(Pages::find()->asArray(['id','name'])->all(),'id','name');
    }

    public function afterFind()
    {
        $this->entities = array_map(function ($item) {
            return $item['id'];
        }, $this->getPages()->select('id')->asArray()->all());

        parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->entities){
            $this->unlinkAll('bannersPagesVias', true);
            foreach ($this->entities as $key => $value){
                (new BannersPagesVia([
                    'banner_id' => $this->id,
                    'page_id' => $value
                ]))->save();
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
