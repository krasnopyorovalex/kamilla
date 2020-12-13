<?php
namespace backend\components;


use yii\helpers\Html;

class IconHelper
{
    public static function status($status)
    {
        return $status ? Html::tag('i','',['class' => 'icon-ok text-center icon-center']) : Html::tag('i','',['class' => 'icon-remove text-center icon-center']);
    }

}