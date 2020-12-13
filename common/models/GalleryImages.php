<?php

namespace common\models;

use backend\components\Multiupload;
use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "gallery_images".
 *
 * @property integer $id
 * @property integer $gallery_id
 * @property string $name
 * @property string $alt
 * @property string $title
 * @property string $basename
 * @property string $ext
 * @property integer $publish
 * @property integer $pos
 *
 * @property Gallery $gallery
 */
class GalleryImages extends \yii\db\ActiveRecord
{

    const PATH = '/web/userfiles/gallery/';

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gallery_id', 'publish', 'pos'], 'integer'],
            [['name', 'alt', 'title'], 'string', 'max' => 512],
            [['basename'], 'string', 'max' => 256],
            [['ext'], 'string', 'max' => 5],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gallery_id' => 'Gallery ID',
            'name' => 'Название',
            'alt' => 'Alt',
            'title' => 'Title',
            'basename' => 'Basename',
            'ext' => 'Ext',
            'publish' => 'Публикация',
            'pos' => 'Pos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $path = Yii::getAlias('@frontend'.self::PATH . $this->gallery_id . DIRECTORY_SEPARATOR);
            unlink($path . $this->basename .'.'. $this->ext);
            unlink($path . $this->basename .'_thumb.'. $this->ext);
            return true;
        } else {
            return false;
        }
    }

    public function copyImage($gallery_id)
    {
        $file_name = $this->basename.'.'.$this->ext;
        $file_name_800 = $this->basename.'_800.'.$this->ext;
        $file_name_250 = $this->basename.'_250.'.$this->ext;
        $path = Yii::getAlias('@frontend'.self::PATH . $this->gallery_id . Multiupload::DELIMITER);
        $path_new = Yii::getAlias('@frontend'.self::PATH . $gallery_id . Multiupload::DELIMITER);
        if (!file_exists($path_new)) FileHelper::createDirectory($path_new, 755, true);
        if(copy($path.$file_name, $path_new.$file_name) && copy($path.$file_name_800, $path_new.$file_name_800) && copy($path.$file_name_250, $path_new.$file_name_250)){
            return (new GalleryImages([
                'gallery_id' => $gallery_id,
                'publish' => 1,
                'basename' => $this->basename,
                'ext' => $this->ext
            ]))->save();
        }
        return false;
    }
}
