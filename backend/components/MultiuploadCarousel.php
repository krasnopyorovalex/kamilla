<?php

namespace backend\components;

use Yii;
use yii\base\Action;
use yii\web\UploadedFile;
use common\models\CarouselImages;
use yii\helpers\FileHelper;
use yii\imagine\Image;

class MultiuploadCarousel extends Action
{
    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function run()
    {
        $carousel_id = Yii::$app->request->post('id');
        $path = Yii::getAlias('@frontend'.CarouselImages::PATH . $carousel_id . DIRECTORY_SEPARATOR);
        if (!file_exists($path)) FileHelper::createDirectory($path, 755, true);

        $image = new CarouselImages();
        $image->file = UploadedFile::getInstanceByName('file');
        //save to DB
        $image['carousel_id'] = $carousel_id;
        $image['basename'] = md5($image->file->baseName . microtime());
        $image['ext'] = $image->file->extension;
        $image['publish'] = 1;

        if($image->validate()){
            $image->file->saveAs($path . $image['basename'] . '.' . $image['ext']);
            //thumb
            Image::thumbnail($path . $image['basename'] . '.' . $image['ext'], 250, 250)
                ->save($path . $image['basename'] . '_thumb.' . $image['ext'], ['quality' => 100]);
            return $image->save();
        }
    }
} 