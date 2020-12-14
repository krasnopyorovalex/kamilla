<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%price_settings}}".
 *
 * @property integer $id
 * @property string $color_head_btn
 * @property string $color_first
 * @property string $color_second
 * @property string $color_third
 * @property string $color_fourth
 * @property string $color_border
 */
class PriceSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%price_settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['color_head_btn', 'color_first', 'color_second', 'color_third', 'color_fourth', 'color_five', 'color_border'], 'string', 'max' => 7],
            [['col_name', 'col_name_mob'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color_head_btn' => 'Цвет кнопки',
            'color_first' => 'Фон шапки первого и второго столбцов таблицы',
            'color_second' => 'Фон шапки второго столбца таблицы',
            'color_third' => 'Цвет фона столбца справа от слайдера',
            'color_fourth' => 'Первый цвет фона таблицы',
            'color_five' => 'Второй цвет фона таблицы',
            'color_border' => 'Цвет границ таблицы',
            'col_name' => 'Название столбца',
            'col_name_mob' => 'Название столбца в мобильной версии',
        ];
    }
}
