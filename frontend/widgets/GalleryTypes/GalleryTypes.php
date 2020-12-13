<?php

namespace frontend\widgets\GalleryTypes;

use common\models\Gallery as Model;
use yii\base\Widget;

class GalleryTypes extends Widget
{
    const EXT = '.twig';

    public $ids;
    public $code;

    private $allowedTypes = ['grid', 'table', 'slider', 'preview'];

    /**
     * @return string
     */
    public function run()
    {
        list($sysName, $type) = explode('_', $this->code);

        if( ! in_array($type, $this->allowedTypes) ) {
            throw new \DomainException(\Yii::$app->params['gallery_type_error']);
        }

        $gallery = Model::find()
            ->publish()
            ->andWhere(['sys_name' => $sysName])
            ->with(['galleryImages'])
            ->limit(1)
            ->one();

        return $this->render($this->getTemplate($type), [
            'gallery' => $gallery
        ]);
    }

    /**
     * @param $type
     * @return string
     */
    private function getTemplate($type)
    {
        return $type . self::EXT;
    }
}