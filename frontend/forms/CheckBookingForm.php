<?php

namespace frontend\forms;

use yii\base\Model;

/**
 * @property string $check_in
 * @property string $check_out
 * @property integer $count_peoples
 * @property integer $count_peoples_list
 */
class CheckBookingForm extends Model
{
    public $date_in;
    public $date_out;
    public $count_peoples;
    public $count_peoples_list = [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7
    ];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['check_in','check_out','count_peoples'], 'required'],
            [['date_in', 'date_out'], 'string'],
            [['count_peoples'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date_in' => 'Дата заезда',
            'date_out' => 'Дата выезда',
            'count_peoples' => 'Кол-во человек'
        ];
    }
}
