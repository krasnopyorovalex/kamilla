<?php

namespace common\models;

use backend\models\PrototypeModel;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property string $sys_name
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property MenuItems[] $menuItems
 */
class Menu extends PrototypeModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sys_name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
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
            'name' => 'Название меню',
            'sys_name' => 'Системное имя',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItems::className(), ['menu_id' => 'id'])->where(['parent_id' => null])->orderBy('pos');
    }
}
