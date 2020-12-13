<?php

namespace frontend\widgets\Gallery;

use common\models\Gallery as Model;
use yii\base\Widget;

class Gallery extends Widget
{

    public $viewInGallery = false;
    public $ids = false;
    
    private $template = 'gallery.twig';

    /**
     * @return string
     */
    public function run()
    {        
        if (\Yii::$app->request->url === '/' && \Yii::$app->mobileDetect->isMobile()) {
            $this->template = 'gallery_mobile.twig';
        }
        
        $galleries = Model::find()->publish()->orderBy('pos')->with(['galleryImages']);

        if($this->ids){
            $galleries->andWhere(['id' => $this->ids]);
        }

        if($this->viewInGallery){
            $galleries->andWhere(['view_in_gallery' => Model::VIEW_IN_GALLERY]);
        }

        return $this->render($this->template, [
            'galleries' => $galleries->asArray()->all(),
            'showBtn' => $this->viewInGallery
        ]);
    }
}
