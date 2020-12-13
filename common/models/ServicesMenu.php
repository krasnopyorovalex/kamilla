<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%services_menu}}".
 *
 * @property integer $id
 * @property string $sys_name
 * @property string $name
 *
 * @property ServicesMenuCategories[] $servicesMenuCategories
 */
class ServicesMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%services_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_name', 'name'], 'required'],
            [['sys_name'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 512],
            ['sys_name', 'checkSysName']
        ];
    }

    public function checkSysName($attribute, $params)
    {
        if( strlen($this->sys_name) < 10 || ! strstr($this->sys_name,'services_')) {
            $this->addError($attribute, 'Неверное системное имя');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sys_name' => 'Системное имя',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesMenuCategories()
    {
        return $this->hasMany(ServicesMenuCategories::className(), ['services_menu_id' => 'id']);
    }
}
