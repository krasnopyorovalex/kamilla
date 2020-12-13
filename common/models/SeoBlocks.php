<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "seo_blocks".
 *
 * @property integer $id
 * @property string $sys_name
 * @property string $value
 * @property string $show_in_pages
 */
class SeoBlocks extends \yii\db\ActiveRecord
{
    public static $modules = [
        'pages' => 'Страницы',
        'catalog' => 'Каталог',
        'news' => 'Новости',
        'articles' => 'Статьи',
        'specials' => 'Спецпредложения',
    ];
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_blocks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'show_in_pages'], 'string'],
            [['sys_name'], 'string', 'max' => 128],
            [['file'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sys_name' => 'Sys Name',
            'value' => 'Value',
            'show_in_pages' => 'Show In Pages'
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->value = $this->file->baseName . '.' . $this->file->extension;
            $this->save();
            return $this->file->saveAs(Yii::getAlias('@frontend/web/').$this->file->baseName . '.' . $this->file->extension);
        } else {
            return false;
        }
    }
}
