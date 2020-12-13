<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%rooms_tabs_via}}".
 *
 * @property integer $room_id
 * @property integer $tab_id
 * @property string $value
 *
 * @property Rooms $room
 * @property RoomsTabs $tab
 */
class RoomsTabsVia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rooms_tabs_via}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'tab_id'], 'required'],
            [['room_id', 'tab_id'], 'integer'],
            [['value'], 'string'],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['room_id' => 'id']],
            [['tab_id'], 'exist', 'skipOnError' => true, 'targetClass' => RoomsTabs::className(), 'targetAttribute' => ['tab_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'Room ID',
            'tab_id' => 'Tab ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTab()
    {
        return $this->hasOne(RoomsTabs::className(), ['id' => 'tab_id']);
    }
}
