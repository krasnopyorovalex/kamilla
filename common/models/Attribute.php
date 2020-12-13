<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attribute".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AttributeProduct[] $attributeProducts
 * @property CategoryProduct[] $products
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование атрибута',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeProducts()
    {
        return $this->hasMany(AttributeProduct::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(CategoryProduct::className(), ['id' => 'product_id'])->viaTable('attribute_product', ['attribute_id' => 'id']);
    }
}
