<?php

namespace frontend\widgets\ServicesMenu;

use common\models\ServicesMenu as Model;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class ServicesMenu extends Widget
{

    public $sysName;

    private static $servicesMenus;

    /**
     * @return string
     */
    public function run()
    {
        if( ! self::$servicesMenus ) {
            self::$servicesMenus = ArrayHelper::map(Model::find()->with(['servicesMenuCategories' => function ($query) {
                return $query->with(['servicesMenuCategoriesItems' => function($query) {
                    return $query->with(['image']);
                }]);
            }])->all(), 'sys_name', 'servicesMenuCategories');
        }

        return $this->render('services_menu.twig', [
            'model' => self::$servicesMenus[$this->sysName]
        ]);
    }
}