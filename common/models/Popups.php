<?php

namespace common\models;

use backend\components\FilesBehavior;
use backend\components\TreeBehavior;
use backend\models\PrototypeModel;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%articles}}".
 *
 * @property integer $id
 * @property string $text
 */
class Popups extends PrototypeModel
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'popups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст в модальном окне'
        ];
    }
    /**
     * @return string
     */
    public function getLink()
    {
        return Url::toRoute(['popup/get-popup', 'id' => $this->id]);
    }
}
