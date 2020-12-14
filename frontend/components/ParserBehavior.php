<?php

namespace frontend\components;

use frontend\widgets\Articles\Articles;
use frontend\widgets\CreateForm\CreateForm;
use frontend\widgets\GalleryListForContent\GalleryListForContent;
use frontend\widgets\GalleryTypes\GalleryTypes;
use frontend\widgets\Guestbook\Guestbook;
use frontend\widgets\News\News;
use frontend\widgets\Price\Price;
use frontend\widgets\Rooms\Rooms;
use frontend\widgets\ServicesMenu\ServicesMenu;
use frontend\widgets\Sitemap\Sitemap;
use frontend\widgets\Specials\Specials;
use frontend\widgets\Statistic\Statistic;
use yii\base\Behavior;

/**
 * Class ParserBehavior
 * @package frontend\components
 */
class ParserBehavior extends Behavior
{
    /**
     * @param $model
     * @return mixed|string
     * @throws \Exception
     */
    public function parse($model)
    {
        if(strstr($model->text, '{gallery}')){
            $model->text = str_replace('<p>{gallery}</p>', GalleryListForContent::widget(), $model->text);
        }

        if(strstr($model->text, '{articles}')){
            $model->text = str_replace('<p>{articles}</p>', Articles::widget(), $model->text);
        }

        if(strstr($model->text, '{specials}')){
            $model->text = str_replace('<p>{specials}</p>', Specials::widget(), $model->text);
        }

        if(strstr($model->text, '{news}')){
            $model->text = str_replace('<p>{news}</p>', News::widget(), $model->text);
        }

        if(strstr($model->text, '{guestbook}')){
            $model->text = str_replace('<p>{guestbook}</p>', Guestbook::widget(), $model->text);
        }

        if(strstr($model->text, '{rooms}')){
            $model->text = str_replace('<p>{rooms}</p>', Rooms::widget(), $model->text);
        }

        if(strstr($model->text, '{stat}')){
            $model->text = str_replace('<p>{stat}</p>', Statistic::widget(), $model->text);
        }

        if(strstr($model->text, '{module_price}')){
            $model->text = str_replace('<p>{module_price}</p>', Price::widget(), $model->text);
        }

        if(strstr($model->text, '{sitemap}')){
            $model->text = str_replace('<p>{sitemap}</p>', Sitemap::widget(), $model->text);
        }

        preg_match_all("#(<p(.*)>)?{module_price_([\d_])*}(<\/p>)?#", $model->text, $matches);
        if ($matches[0]) {
            array_map(function ($item) use ($model)  {
                $extract = str_replace(['{', '}', 'module_price'], '', $item);
                $idList = array_filter(explode('_', strip_tags($extract)));

                $model->text = str_replace($item, Price::widget(['idList' => $idList]), $model->text);
            }, $matches[0]);
        }

        preg_match_all("#(<p(.*)>)?{services_([a-z_])*}(<\/p>)?#", $model->text, $matches);
        array_map(function ($item) use ($model) {
            $model->text = str_replace($item, ServicesMenu::widget([
                'sysName' => strip_tags(str_replace(['{','}'], '', $item))
            ]), $model->text);
        }, $matches[0]);

        preg_match_all("#(<p(.*)>)?{([a-z_\d])*(_gallery_)([a-z_])*}(<\/p>)?#", $model->text, $matches);
        array_map(function ($item) use ($model) {
            $model->text = str_replace($item, GalleryTypes::widget([
                'code' => strip_tags(str_replace(['{','}','_gallery'], '', $item))
            ]), $model->text);
        }, $matches[0]);

        preg_match_all("/{form_[a-z].*}/", $model->text, $matches);
        foreach ($matches[0] as $item){
            $sys_name = str_replace(['{','}'], '', $item);
            $model->text = str_replace($item, $this->createForm($sys_name), $model->text);
        }

        return $model->text;
    }

    /**
     * @param $sysName
     * @return string
     * @throws \Exception
     */
    private function createForm($sysName)
    {
        return CreateForm::widget(['sysName' => $sysName]);
    }

}