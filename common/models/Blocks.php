<?php

namespace common\models;

use backend\models\PrototypeModel;

/**
 * This is the model class for table "blocks".
 *
 * @property integer $id
 * @property string $name
 * @property string $sys_name
 * @property string $text
 * @property integer $publish
 * @property integer $created_at
 * @property integer $updated_at
 */
class Blocks extends PrototypeModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blocks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sys_name'], 'required'],
            [['text'], 'string'],
            [['publish', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 512],
            [['sys_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название блока',
            'sys_name' => 'Системное имя',
            'text' => 'Контент',
            'publish' => 'Публикация',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}