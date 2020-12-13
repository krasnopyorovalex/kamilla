<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "redirects".
 *
 * @property integer $id
 * @property string $old_alias
 * @property string $new_alias
 * @property integer $code
 * @property integer $date
 */
class Redirects extends ActiveRecord
{
    const DELIMITER = '/';

    public $statuses = [
        300 => "Multiple Choices (несколько вариантов на выбор) - 300",
        301 => "Moved Permanently (перемещено навсегда) - 301",
        302 => "Temporary Redirect (временный редирект) - 302",
        303 => "See Other (затребованный ресурс можно найти по др. адресу) - 303",
        304 => "Not Modified (содержимое не изменялось - это могут быть рисунки, таблицы стилей и т.п.) - 304",
        305 => "Use Proxy (доступ должен осуществляться через прокси) - 305",
        306 => "(Unused) (не используется) - 306"
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redirects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_alias', 'new_alias'], 'required'],
            [['code', 'date'], 'integer'],
            [['old_alias', 'new_alias'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_alias' => 'Старый алиас',
            'new_alias' => 'Новый алиас',
            'code' => 'Статус-код ответа',
            'date' => 'Date',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = time();
            return true;
        }
        return false;
    }
}
