<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%rooms_tabs}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property RoomsTabsVia[] $roomsTabsVias
 * @property Rooms[] $rooms
 */
class RoomsTabs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rooms_tabs}}';
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
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsTabsVias()
    {
        return $this->hasMany(RoomsTabsVia::className(), ['tab_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['id' => 'room_id'])->viaTable('{{%rooms_tabs_via}}', ['tab_id' => 'id']);
    }
}
