<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "reviews_images".
 *
 * @property integer $id
 * @property integer $review_id
 * @property string $alt
 * @property string $title
 * @property string $basename
 * @property string $ext
 * @property integer $pos
 *
 * @property Reviews $review
 */
class ReviewsImages extends \yii\db\ActiveRecord
{

    const PATH = '/userfiles/reviews/';

    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['review_id', 'alt', 'title', 'basename', 'ext', 'pos'], 'required'],
            [['review_id', 'pos'], 'integer'],
            [['alt', 'title'], 'string', 'max' => 512],
            [['basename'], 'string', 'max' => 256],
            [['ext'], 'string', 'max' => 5],
            [['review_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reviews::className(), 'targetAttribute' => ['review_id' => 'id']],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'review_id' => 'Review ID',
            'alt' => 'Alt',
            'title' => 'Title',
            'basename' => 'Basename',
            'ext' => 'Ext',
            'pos' => 'Pos',
            'imageFiles' => 'Перезагрузить изображения при необходимости',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Reviews::className(), ['id' => 'review_id']);
    }

    public function upload($review_id)
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $fileName = md5($file->baseName . microtime());
                (new ReviewsImages(['review_id' => $review_id,'basename' => $fileName,'ext' => $file->extension]))->save();
                $file->saveAs(Yii::getAlias('@frontend/web') . self::PATH . $fileName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $path = Yii::getAlias('@frontend/web'.self::PATH);
            unlink($path . $this->basename .'.'. $this->ext);
            return true;
        } else {
            return false;
        }
    }
}
