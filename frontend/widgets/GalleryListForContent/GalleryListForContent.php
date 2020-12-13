<?php

namespace frontend\widgets\GalleryListForContent;

use common\models\Gallery as Model;
use yii\base\Widget;

class GalleryListForContent extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        $galleries = Model::find()
            ->andWhere(['view_in_gallery' => Model::VIEW_IN_GALLERY])
            ->publish()
            ->orderBy('pos')
            ->with(['galleryImages']);

        $galleriesAddMenu = clone $galleries;

        return $this->render('gallery.twig', [
            'galleries' => $galleries->andWhere(['add_menu' => 0])->asArray()->all(),
            'galleriesAddMenu' => $galleriesAddMenu->andWhere(['add_menu' => Model::ADD_MENU])->asArray()->all()
        ]);
    }
}