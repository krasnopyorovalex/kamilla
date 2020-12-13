<?php
/* @var $this yii\web\View */
/* @var $settings common\models\ */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;

CkEditorAsset::register($this);
$this->params['breadcrumbs'][] = $this->context->module->params['name'];
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title">Настройки сайта</span></div>
                <div class="box-content padded">
                    <div class="box-header">
                        <ul class="nav nav-tabs nav-tabs-left">
                            <li class="active"><a href="#site_status" data-toggle="tab"><span>Выключен сайт?</span></a></li>
                            <li><a href="#text_off" data-toggle="tab"><span>Текст выключенного сайта</span></a></li>
                            <li><a href="#robots" data-toggle="tab"><span>robots.txt</span></a></li>
                            <li><a href="#g_public_key" data-toggle="tab"><span>G-public key</span></a></li>
                            <li><a href="#g_private_key" data-toggle="tab"><span>G-private key</span></a></li>
                            <li><a href="#bg_color_top_line" data-toggle="tab"><span>Цвет верхней строки</span></a></li>
                            <li><a href="#bg_color_menu" data-toggle="tab"><span>Цвет подложки меню</span></a></li>
                            <li><a href="#head_bg_if_not_img" data-toggle="tab"><span>Цвет плашки</span></a></li>
                        </ul>
                    </div>

                    <div class="box-content padded">
                        <div class="tab-content">
                            <div class="tab-pane active" id="site_status">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['site_status']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::checkbox('value', (int)$settings['site_status']['value'], [
                                        'class' => 'iButton-icons',
                                        'value' => 1
                                    ])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="text_off">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['text_off']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::textarea('value', $settings['text_off']['value'], ['class' => 'form-control off_ckeditor', 'rows' => 5]) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="g_private_key">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['g_private_key']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['g_private_key']['value'], ['class' => 'form-control']) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="g_public_key">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['g_public_key']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['g_public_key']['value'], ['class' => 'form-control']) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="robots">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['robots']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::textarea('value', $settings['robots']['value'], ['class' => 'form-control off_ckeditor', 'rows' => 5]) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="bg_color_top_line">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['bg_color_top_line']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['bg_color_top_line']['value'], ['class' => 'form-control']) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="bg_color_menu">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['bg_color_menu']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['bg_color_menu']['value'], ['class' => 'form-control']) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="head_bg_if_not_img">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['head_bg_if_not_img']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <div class="form-group">
                                    <?= Html::input('text', 'value', $settings['head_bg_if_not_img']['value'], ['class' => 'form-control']) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="box-content padded">
                        <div class="box-header">
                            <ul class="nav nav-tabs nav-tabs-left">
                                <li class="active"><a href="#show_slider" data-toggle="tab"><span>Слайдер</span></a></li>
                                <li><a href="#recommended_reading_title" data-toggle="tab"><span>Заголовок блока - Рекомендуем к прочтению</span></a></li>
                                <li><a href="#statistic_title" data-toggle="tab"><span>Заголовок блока - Статистика</span></a></li>
                                <li><a href="#recommended_reading_view" data-toggle="tab"><span>Рекомендуем к прочтению(шаблон)</span></a></li>
                                <li><a href="#catalog_alias" data-toggle="tab"><span>Alias страницы каталога</span></a></li>
                                <li><a href="#name_gallery_menu" data-toggle="tab"><span>Название кнопки меню в списке галерей</span></a></li>
                                <li><a href="#view_booking_block" data-toggle="tab"><span>Блок бронирования под слайдером</span></a></li>
                                <li><a href="#form_recall_block" data-toggle="tab"><span>Форма заказать обратный звонок под слайдером</span></a></li>
                                <li><a href="#show_slider_actions" data-toggle="tab"><span>Отображать слайдер акций на главной</span></a></li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="show_slider">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['show_slider']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <br />
                                <div class="form-group">
                                    <?= Html::checkbox('value', (int)$settings['show_slider']['value'], [
                                        'class' => 'iButton',
                                        'value' => 1,
                                        'label' => 'Отображать слайдер?'
                                    ])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="view_booking_block">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['view_booking_block']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <br />
                                <div class="form-group">
                                    <?= Html::checkbox('value', (int)$settings['view_booking_block']['value'], [
                                        'class' => 'iButton',
                                        'value' => 1,
                                        'label' => 'Отображать?'
                                    ])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>

                            <div class="tab-pane" id="show_slider_actions">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['show_slider_actions']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <br />
                                <div class="form-group">
                                    <?= Html::checkbox('value', (int)$settings['show_slider_actions']['value'], [
                                        'class' => 'iButton',
                                        'value' => 1,
                                        'label' => 'Отображать?'
                                    ])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            
                            <div class="tab-pane" id="form_recall_block">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['form_recall_block']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <br />
                                <div class="form-group">
                                    <?= Html::checkbox('value', (int)$settings['form_recall_block']['value'], [
                                        'class' => 'iButton',
                                        'value' => 1,
                                        'label' => 'Отображать?'
                                    ])?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            
                            <div class="tab-pane" id="recommended_reading_title">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['recommended_reading_title']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <br />
                                <div class="form-group">
                                    <div class="form-group">
                                        <?= Html::input('text', 'value', $settings['recommended_reading_title']['value'], ['class' => 'form-control']) ?>
                                    </div>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="statistic_title">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['statistic_title']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <br />
                                <div class="form-group">
                                    <div class="form-group">
                                        <?= Html::input('text', 'value', $settings['statistic_title']['value'], ['class' => 'form-control']) ?>
                                    </div>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="catalog_alias">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['catalog_alias']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <br />
                                <div class="form-group">
                                    <div class="form-group">
                                        <?= Html::input('text', 'value', $settings['catalog_alias']['value'], ['class' => 'form-control']) ?>
                                    </div>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="name_gallery_menu">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['name_gallery_menu']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <br />
                                <div class="form-group">
                                    <div class="form-group">
                                        <?= Html::input('text', 'value', $settings['name_gallery_menu']['value'], ['class' => 'form-control']) ?>
                                    </div>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="tab-pane" id="recommended_reading_view">
                                <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $settings['recommended_reading_view']['id']]), 'post', ['class' => 'fill-up']) ?>
                                <br />
                                <div class="form-group">
                                    <?= Html::dropDownList('value', $settings['recommended_reading_view']['value'], [
                                            'v1' => 'Шаблон №1',
                                            'v2' => 'Шаблон №2',
                                    ], ['class' => 'chzn-select']) ?>
                                </div>
                                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                <?= Html::endForm() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
