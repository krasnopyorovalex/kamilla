<?php

namespace frontend\components;

use common\models\Rooms;
use yii\helpers\Html;

/**
 * Class AppHelper
 * @package frontend\components
 */
class AppHelper {

    public static function dropDownList(array $list = [])
    {
        $options = [];
        foreach ($list as $item){
            if($item['value'] == '{rooms}'){
                foreach (Rooms::find()->publish()->asArray()->all() as $room){
                    $options[$room['name']] = $room['name'];
                }
                return $options;
            }else{
                $options[$item['value']] = $item['value'];
            }
        }
        return $options;
    }

    public static function radioList(array $list = [], $field = '')
    {
        $html = '';
        foreach ($list as $key => $item){
            $html .= Html::radio($field, false, ['label' => $item['value']]);
        }
        return $html;
    }

    public static function checkboxList(array $list = [], $key)
    {
        $html = '';
        foreach ($list as $item){
            $html .= Html::checkbox($key.'[]', false, ['label' => $item['value'],'value' => $item['value']]);
        }
        return $html;
    }
}