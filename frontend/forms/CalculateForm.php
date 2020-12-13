<?php

namespace frontend\forms;

use Yii;
use yii\base\Model;

/**
 * @property integer $id
 * @property string $date
 * @property string $ip
 */
class CalculateForm extends Model
{

    const SUBJECT = 'Получить расчет проживания на e-mail';

    public $fio;
    public $phone;
    public $email;
    public $room;
    public $dateIn;
    public $dateOut;
    public $countAdults;
    public $countChildren;
    public $ageChildren;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countAdults','fio','phone'], 'required'],
            [['ageChildren', 'rooms', 'phone'], 'string'],
            ['email', 'email'],
            [['countChildren', 'countAdults'], 'integer'],
            [['dateIn', 'dateOut'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fio' => 'ФИО',
            'phone' => 'Номер телефона',
            'email' => 'E-mail',
            'room' => 'Номер',
            'dateIn' => 'Дата заезда',
            'dateOut' => 'Дата выезда',
            'countAdults' => 'Количество взрослых',
            'ageChildren' => 'Количество детей',
            'countChildren' => 'Возраст детей'
        ];
    }

    /**
     * @param $email
     * @return bool
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose('calculate',['model' => $this])
            ->setTo($email)
            ->setFrom(['resorts-bron5@yandex.ru' => Yii::$app->request->hostName])
            ->setSubject(self::SUBJECT)
            ->send();
    }
}
