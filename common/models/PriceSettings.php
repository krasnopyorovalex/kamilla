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
            [['color_head_btn', 'color_first', 'color_second', 'color_third', 'color_fourth', 'color_border'], 'string', 'max' => 7],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color_head_btn' => 'Цвет шапки и кнопки',
            'color_first' => 'Первый цвет фона таблицы',
            'color_second' => 'Второй цвет фона таблицы',
            'color_third' => 'Третий цвет фона таблицы',
            'color_fourth' => 'Четвертый цвет фона таблицы',
            'color_border' => 'Цвет границ таблицы',
        ];
    }
}
