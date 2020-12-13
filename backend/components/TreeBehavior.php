<?php
namespace backend\components;

use common\models\CategoryProduct;
use common\models\Settings;
use yii\base\Behavior;
use yii\helpers\ArrayHelper;
use Yii;

class TreeBehavior extends Behavior
{
    const POSTFIX = ' * ';
    const SLASH = '/';
    private $_list = [];
    private $_list_modules = [];
    private $_modules = [
        'pages' => 'Страницы',
        'news' => 'Новости',
        'articles' => 'Статьи',
        'specials' => 'Спецпредложения',
        //'catalog' => 'Каталог',
        'rooms' => 'Номера',
        //'gallery' => 'Галерея',
    ];
    private $_replaces = [
        'pages',
        'index'
    ];
    private $catalogAlias;

    /**
     * @param array $model
     * @param null $id
     * @return array|mixed|null
     */
    public function tree(array $model, $id = null)
    {
        if (is_array($model)) {
            $this->_createList($model);
            $this->_list = ArrayHelper::map(ArrayHelper::merge([['id' => '', 'name' => 'Не выбрано']],$this->_list),'id','name');
            if($id){
                ArrayHelper::remove($this->_list,$id);
            }
            return $this->_list;
        }
        return [];
    }

    public function links()
    {
        $catalogAlias = Settings::findOne(['sys_name' => 'catalog_alias']);
        $this->catalogAlias = $catalogAlias->value;

        foreach ($this->_modules as $key => $value){
            $model = Yii::$app->getModule($key)->getModel();
            $this->_each($model::find()->select(['id','name','alias'])->asArray()->all(), $key, $value);
        }
        return ArrayHelper::map($this->_list_modules,'alias','name','module');
    }

    public function ddl(array $model, $t = '-')
    {
        $this->_list = [];
        $t = $t.self::POSTFIX;
        if (is_array($model)) {
            foreach ($model as $item) {
                $this->_list[$item['id']]['id'] = $item['id'];
                $this->_list[$item['id']]['name'] = $t.$item['name'];
            }
            return ArrayHelper::map(ArrayHelper::merge([['id' => '', 'name' => 'Не выбрано']],$this->_list),'id','name');
        }
        return [];
    }

    /**
     * @param null $items
     * @param int $parent_id
     * @param string $t
     */
    private function _createList($items = null, $parent_id = 0, $t = '-')
    {
        if ($items !== null) {
            $t = $t.self::POSTFIX;
            foreach ($items as $item) {
                if ($item['parent_id'] == $parent_id) {
                    $this->_list[$item['id']]['id'] = $item['id'];
                    $this->_list[$item['id']]['name'] = $t.$item['name'];
                    $this->_createList($items, $item['id'], $t);
                }
            }
        }
    }

    private function _each(array $list, $key, $value)
    {
        foreach ($list as $item){
            $alias = preg_replace("/\/+/","/",str_replace($this->_replaces,'',self::SLASH.$key.self::SLASH.$item['alias']));
            $alias = str_replace('rooms', $this->catalogAlias, $alias);
            $this->_list_modules[] = [
                'alias' => $alias,
                'name' => self::POSTFIX.$item['name'],
                'module' => $value
            ];
            if($key == 'catalog' && $category_product = CategoryProduct::find()->where(['category_id' => $item['id']])->asArray()->all()){
                $this->_each($category_product, 'category_product', $item['name']);
            }
        }
    }

}
