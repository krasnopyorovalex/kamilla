<?php

namespace common\models;

use backend\models\PrototypeModel;

/**
 * This is the model class for table "{{%popups}}".
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
}
