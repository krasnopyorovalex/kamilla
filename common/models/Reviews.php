<?php

namespace common\models;

use backend\models\PrototypeModel;

/**
 * This is the model class for table "{{%reviews}}".
 *
 * @property integer $id
 * @property string $date
 * @property string $ip
 * @property string $name
 * @property string $email
 * @property string $city
 * @property string $text
 * @property string $answer
 * @property integer $publish
 * @property integer $show_in_main
 *
 * @property ReviewsImages[] $reviewsImages
 */
class Reviews extends PrototypeModel
{
    const PATH = '/userfiles/reviews/';

    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['text'], 'required'],
            [['text', 'answer'], 'string'],
            [['publish', 'show_in_main'], 'integer'],
            [['ip'], 'string', 'max' => 15],
            [['name', 'city'], 'string', 'max' => 128],
            [['email'], 'string', 'max' => 64],
            [['email'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата отзыва',
            'ip' => 'Ip',
            'name' => 'Имя',
            'email' => 'Email',
            'city' => 'Город',
            'text' => 'Текст отзыва',
            'answer' => 'Ответ',
            'publish' => 'Публикация',
            'show_in_main' => 'Отображать на главной?',
            'file' => 'Изображения'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewsImages()
    {
        return $this->hasMany(ReviewsImages::className(), ['review_id' => 'id']);
    }
}
