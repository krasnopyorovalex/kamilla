<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $name
 * @property string $iso
 * @property double $exchange
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'iso'], 'required'],
            [['exchange'], 'number'],
            [['name'], 'string', 'max' => 32],
            [['iso'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назвние',
            'iso' => 'Iso',
            'exchange' => 'Курс обмена',
        ];
    }
}
