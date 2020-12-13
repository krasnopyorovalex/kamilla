<?php

namespace backend\components;

use Yii;
use yii\base\Action;
use yii\web\UploadedFile;
use common\models\GalleryImages;
use yii\imagine\Image;
use yii\helpers\FileHelper;

class Multiupload extends Action
{
    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function run()
    {
        $gallery_id = Yii::$app->request->post('id');
        $path = Yii::getAlias('@frontend'.GalleryImages::PATH . $gallery_id . DIRECTORY_SEPARATOR);
        if (!file_exists($path)) FileHelper::createDirectory($path, 0755, true);

        $image = new GalleryImages();
        $image->file = UploadedFile::getInstanceByName('file');

        $image->gallery_id = $gallery_id;
        $image->basename = md5($image->file->baseName . microtime());
        $image->ext = $image->file->extension;

        if($image->validate() && $image->save()){
            $image->file->saveAs($path . $image->basename . '.' . $image->ext);
            //thumb
            Image::thumbnail($path . $image->basename . '.' . $image->ext, 450, 225)
                ->save($path . $image->basename . '_thumb.' . $image->ext, ['quality' => 100]);
            return true;
        }
        return false;
    }
} 