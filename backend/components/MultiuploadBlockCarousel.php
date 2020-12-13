<?php

namespace backend\components;

use common\models\BlockCarousel;
use common\models\BlockCarouselImages;
use Yii;
use yii\base\Action;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\imagine\Image;

class MultiuploadBlockCarousel extends Action
{
    const DELIMITER = '/';
    public function run()
    {
        $block_carousel_id = Yii::$app->request->post('id');
        $path = Yii::getAlias('@frontend'.BlockCarouselImages::PATH . $block_carousel_id . self::DELIMITER);
        if (!file_exists($path)) FileHelper::createDirectory($path, 755, true);

        $image = new BlockCarouselImages();
        $image->file = UploadedFile::getInstancesByName('file');
        //save to DB
        $image['block_carousel_id'] = $block_carousel_id;
        $image['basename'] = md5('media_' . Yii::$app->getSecurity()->generateRandomString(25));
        $image['ext'] = $image->file[0]->extension;
        $image['publish'] = 1;

        if($image->validate()){
            $image->file[0]->saveAs($path . $image['basename'] . '.' . $image['ext']);
            //thumb
            Image::thumbnail($path . $image['basename'] . '.' . $image['ext'], 250, 250)
                ->save($path . $image['basename'] . '_250.' . $image['ext'], ['quality' => 100]);
            return $image->save();
        }
    }
} 