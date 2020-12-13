<?php

namespace backend\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use backend\components\TreeBehavior;

/**
 * Class PrototypeModel
 * @package backend\models
 *
 * @mixin TreeBehavior
 */
class PrototypeModel extends ActiveRecord
{
    const PUBLISH = 1;
    const SHOW_MAIN = 1;

    public $metaImage;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
            [
                'class' => TreeBehavior::className()
            ]
        ];
    }

    /**
     * @return Scopes
     */
    public static function find() {
        return new Scopes(get_called_class());
    }
}

class Scopes extends ActiveQuery{

    /**
     * @return $this
     */
    public function publish()
    {
        return $this->andWhere(['publish' => PrototypeModel::PUBLISH]);
    }

}