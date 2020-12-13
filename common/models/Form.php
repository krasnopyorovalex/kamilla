<?php

namespace common\models;

use backend\components\FilesBehavior;
use backend\models\PrototypeModel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%form}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $sys_name
 * @property string $css
 * @property string $name
 * @property string $email
 * @property string $theme
 * @property string $submit_btn_text
 * @property string $submit_success
 * @property string $event
 * @property string $json_schema
 * @property integer $captcha
 * @property integer $images_on
 * @property integer $show_name
 * @property integer $image_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Files $image
 */
class Form extends PrototypeModel
{
    public $types = [
        'contact' => 'Контактная форма',
        'order' => 'Форма заявок'
    ];

    const PATH = '/form/';

    public $attaches;
    public $imageFile;

    const IMAGE_FILE = 'imageFile';
    const IMAGE_ID = 'image_id';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            [
                'class' => FilesBehavior::className(),
                'path' => self::PATH,
                'column' => self::IMAGE_ID,
                'field' => self::IMAGE_FILE
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'email', 'theme', 'submit_btn_text', 'sys_name'], 'required'],
            [['json_schema'], 'string'],
            [['captcha', 'images_on', 'show_name', 'created_at', 'updated_at'], 'integer'],
            [['type', 'submit_btn_text'], 'string', 'max' => 128],
            [['submit_success'], 'string', 'max' => 512],
            [['sys_name'], 'string', 'max' => 64],
            [['css'], 'string', 'max' => 32],
            [['name', 'theme', 'event'], 'string', 'max' => 512],
            [['email'], 'string', 'max' => 256],
            [['sys_name'], 'unique'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип формы',
            'sys_name' => 'Системное имя',
            'css' => 'css-класс формы',
            'name' => 'Название формы',
            'email' => 'Email',
            'theme' => 'Тема письма',
            'submit_btn_text' => 'Текст кнопки «submit»',
            'submit_success' => 'Текст после успешной отправки формы',
            'event' => 'Событие на отправку кнопки',
            'json_schema' => 'Json Schema',
            'captcha' => 'Включить капчу?',
            'images_on' => 'Активировать загрузку изображений?',
            'show_name' => 'Отображать имя формы?',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Files::className(), ['id' => 'image_id']);
    }
}
