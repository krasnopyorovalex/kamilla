<?php

namespace frontend\widgets\RecommendedReading;

use common\models\Files;
use common\models\Pages;
use common\models\PagesAttaches;
use yii\base\Widget;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class RecommendedReading extends Widget
{

    /**
     * @var $model Pages
     */
    public $model;

    private $list = [];
    private $items = [];
    private $images = [];

    /**
     * @return string
     */
    public function run()
    {
        $attaches = $this->model->pagesAttaches;

        array_map(function ($item) {
            return $this->setAttach($item);
        }, $attaches);

        $this->getItems();

        return $this->render(\Yii::$app->params['settings']['recommended_reading_view'] . '/recommended_reading.twig', [
            'items' => $this->items,
            'images' => $this->images
        ]);
    }

    /**
     * @param $item
     */
    private function setAttach($item)
    {
        /**
         * @var $item PagesAttaches
         */
        $this->list[$item->table_name][] = $item->entity_id;
    }

    private function getItems()
    {
        foreach ($this->list as $key => $value) {
            $query = new Query();
            $query->from($key)->where(['id' => $value]);
            $this->items[$key] = $query->all();
        }

        foreach ($this->items as $items) {
            array_map(function ($item) {
                if($item['image_rr_id']) {
                    $this->images[] = $item['image_rr_id'];
                }
            }, $items);
        }
        $this->images = ArrayHelper::index(Files::find()->where(['id' => $this->images])->asArray()->all(),'id');
    }
}