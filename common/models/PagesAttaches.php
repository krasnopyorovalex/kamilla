<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%pages_attaches}}".
 *
 * @property integer $page_id
 * @property string $table_name
 * @property integer $entity_id
 *
 * @property Pages $page
 */
class PagesAttaches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages_attaches}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'entity_id'], 'required'],
            [['page_id', 'entity_id'], 'integer'],
            [['table_name'], 'string', 'max' => 32],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => 'Page ID',
            'table_name' => 'Table Name',
            'entity_id' => 'Entity ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id']);
    }
}
