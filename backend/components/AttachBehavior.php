<?php

namespace backend\components;

use common\models\Articles;
use common\models\News;
use common\models\Pages;
use common\models\PagesAttaches;
use common\models\Specials;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class AttachBehavior
 * @package backend\components
 */
class AttachBehavior extends Behavior
{

    private $names = [
        'pages' => 'Страницы',
        'articles' => 'Статьи',
        'specials' => 'Акции',
        'news' => 'Новости',
    ];
    /**
     * @var array
     */
    private $list = [];

    /**
     * @return array
     */
    public function getListForAttach()
    {
        $this->setToList(Pages::find()->andWhere(['<>', 'id', $this->owner->id])->publish()->all());
        $this->setToList(News::find()->publish()->all());
        $this->setToList(Articles::find()->publish()->all());
        $this->setToList(Specials::find()->publish()->all());

        return ArrayHelper::map($this->list,'id','name','module');
    }

    /**
     * @param $attaches
     * @return array
     */
    public function getAttaches($attaches)
    {
        array_map(function ($item) {
            /**
             * @var $item PagesAttaches
             */
            return array_push($this->list, $item->table_name . '_' . $item->entity_id);
        }, $attaches);

        return $this->list;
    }

    /**
     * @param $items
     */
    private function setToList($items)
    {
        array_map(function ($item) {
            /**
             * @var $item ActiveRecord
             */
            return array_push($this->list, [
                'id' => $item::tableName() . '_' . $item['id'],
                'name' => $item['name'],
                'module' => $this->names[$item::tableName()]
            ]);
        }, $items);
    }

}