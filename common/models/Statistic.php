<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%statistic}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property integer $count
 */
class Statistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%statistic}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['count'], 'integer'],
            [['name', 'text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'text' => 'Текст',
            'count' => 'Значение',
        ];
    }
}
