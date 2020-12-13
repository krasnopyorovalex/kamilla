<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%services_menu_categories}}".
 *
 * @property integer $id
 * @property integer $services_menu_id
 * @property string $name
 * @property string $slogan
 *
 * @property ServicesMenu $servicesMenu
 * @property ServicesMenuCategoriesItems[] $servicesMenuCategoriesItems
 */
class ServicesMenuCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%services_menu_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['services_menu_id', 'name'], 'required'],
            [['services_menu_id'], 'integer'],
            [['name', 'slogan'], 'string', 'max' => 512],
            [['services_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServicesMenu::className(), 'targetAttribute' => ['services_menu_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'services_menu_id' => 'Services Menu ID',
            'name' => 'Название',
            'slogan' => 'Слоган',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesMenu()
    {
        return $this->hasOne(ServicesMenu::className(), ['id' => 'services_menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesMenuCategoriesItems()
    {
        return $this->hasMany(ServicesMenuCategoriesItems::className(), ['services_menu_category_id' => 'id']);
    }
}
