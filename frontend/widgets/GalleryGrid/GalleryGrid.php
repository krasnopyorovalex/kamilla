<?php

namespace frontend\widgets\GalleryGrid;

use common\models\Gallery as Model;
use yii\base\Widget;

class GalleryGrid extends Widget
{

    public $ids = false;

    /**
     * @return string
     */
    public function run()
    {
        $galleries = Model::find()->publish()->orderBy('pos')->with(['galleryImages']);

        if($this->ids){
            $galleries->andWhere(['id' => $this->ids]);
        }

        return $this->render('gallery.twig', [
            'galleries' => $galleries->asArray()->all()
        ]);
    }
}