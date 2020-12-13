<?php

namespace common\models;

use backend\models\PrototypeModel;
use backend\components\FileBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu_items".
 *
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property string $icon
 * @property integer $pos
 * @property integer $parent_id
 * @property integer $menu_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Menu $menu
 * @property MenuItems $parent
 * @property MenuItems[] $menuItems
 */
class MenuItems extends PrototypeModel
{

    const PATH = '/userfiles/icons/';
    const IMAGE_ENTITY = 'icon';
    const NOT_PARENT = null;

    public $file;
    public $options;

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            [
                'class' => FileBehavior::className(),
                'path' => self::PATH,
                'entity_db' => self::IMAGE_ENTITY
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'link'], 'required'],
            [['pos', 'parent_id', 'menu_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'link'], 'string', 'max' => 512],
            [['icon'], 'string', 'max' => 128],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => MenuItems::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Анкор',
            'link' => 'Ссылка',
            'icon' => 'Пиктограмма',
            'file' => 'Пиктограмма',
            'pos' => 'Позиция',
            'parent_id' => 'Родительский пункт меню',
            'menu_id' => 'Menu ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'options' => 'Содержимое сайта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(MenuItems::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItems::className(), ['parent_id' => 'id']);
    }

    public function dropDown($menu_id)
    {
        $query = self::find();
        if(!$menu_id){
            $menu_id = $this->menu_id;
        }
        return $this->tree($query->andWhere(['menu_id' => $menu_id])->asArray()->all(), $this->id);
    }
}
