<?php
/* @var $this yii\web\View */
/* @var $seo_blocks common\models\SeoBlocks */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;
use common\models\SeoBlocks;
use yii\helpers\Json;

CkEditorAsset::register($this);
$this->params['breadcrumbs'][] = $this->context->module->params['name'];
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title">SEO-блоки</span></div>
                    <div class="box-content padded">
                            <div class="box-header">
                                <ul class="nav nav-tabs nav-tabs-left">
                                    <li class="active"><a href="#favicon" data-toggle="tab"><span>Фавикон</span></a></li>
                                    <li><a href="#chat" data-toggle="tab"><span>Чат</span></a></li>
                                    <li><a href="#share_in_social_networks" data-toggle="tab"><span>Поделиться в соцсетях</span></a></li>
                                    <li><a href="#we_in_social_networks" data-toggle="tab"><span>Мы в соцсетях</span></a></li>
                                    <li><a href="#widget_social_networking" data-toggle="tab"><span>Виджет соцсетей</span></a></li>
                                    <li><a href="#metric" data-toggle="tab"><span>Метрика</span></a></li>
                                    <li><a href="#count_mail" data-toggle="tab"><span>Счетчик</span></a></li>
                                    <li><a href="#yandex_verification" data-toggle="tab"><span>Y</span></a></li>
                                    <li><a href="#google_verification" data-toggle="tab"><span>G</span></a></li>
                                </ul>
                            </div>

                            <div class="box-content padded">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="favicon">
                                        <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $seo_blocks['favicon']['id']]), 'post', ['enctype' => 'multipart/form-data', 'class' => 'fill-up']) ?>
                                            <div class="form-group">
                                                <?php if($seo_blocks['favicon']['value']):?>
                                                    <?= Html::tag('div', $seo_blocks['favicon']['value'], ['class' => 'favicon_ico'])?>
                                                <?php endif;?>
                                                <?= Html::fileInput('file', '', ['class' => 'form-control']) ?>
                                            </div>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                        <?= Html::endForm() ?>
                                    </div>
                                    <div class="tab-pane" id="chat">
                                        <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $seo_blocks['chat']['id']]), 'post', ['class' => 'fill-up']) ?>
                                            <div class="form-group">
                                                <?= Html::textarea('value', $seo_blocks['chat']['value'], ['class' => 'form-control off_ckeditor', 'rows' => 10]) ?>
                                            </div>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                        <?= Html::endForm() ?>
                                    </div>
                                    <div class="tab-pane" id="share_in_social_networks">
                                        <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $seo_blocks['share_in_social_networks']['id']]), 'post', ['class' => 'fill-up']) ?>
                                            <div class="form-group" style="display: none">
                                                <?= Html::dropDownList('checked[]', Json::decode($seo_blocks['share_in_social_networks']['show_in_pages']), SeoBlocks::$modules,[
                                                    'multiple' => 'multiple',
                                                    'class' => 'chzn-select'
                                                ])?>
                                            </div>
                                            <div class="form-group">
                                                <?= Html::textarea('value', $seo_blocks['share_in_social_networks']['value'], ['class' => 'form-control off_ckeditor']) ?>
                                            </div>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                        <?= Html::endForm() ?>
                                    </div>
                                    <div class="tab-pane" id="we_in_social_networks">
                                        <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $seo_blocks['we_in_social_networks']['id']]), 'post', ['class' => 'fill-up']) ?>
                                            <div class="form-group">
                                                <?= Html::textarea('value', $seo_blocks['we_in_social_networks']['value'], ['class' => 'form-control']) ?>
                                            </div>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                        <?= Html::endForm() ?>
                                    </div>
                                    <div class="tab-pane" id="widget_social_networking">
                                        <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $seo_blocks['widget_social_networking']['id']]), 'post', ['class' => 'fill-up']) ?>
                                            <div class="form-group">
                                                <?= Html::textarea('value', $seo_blocks['widget_social_networking']['value'], ['class' => 'form-control off_ckeditor', 'rows' => 10]) ?>
                                            </div>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                        <?= Html::endForm() ?>
                                    </div>
                                    <div class="tab-pane" id="metric">
                                        <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $seo_blocks['metric']['id']]), 'post', ['class' => 'fill-up']) ?>
                                            <div class="form-group">
                                                <?= Html::textarea('value', $seo_blocks['metric']['value'], ['class' => 'form-control off_ckeditor', 'rows' => 10]) ?>
                                            </div>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                        <?= Html::endForm() ?>
                                    </div>
                                    <div class="tab-pane" id="count_mail">
                                        <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $seo_blocks['count_mail']['id']]), 'post', ['class' => 'fill-up']) ?>
                                            <div class="form-group">
                                                <?= Html::textarea('value', $seo_blocks['count_mail']['value'], ['class' => 'form-control off_ckeditor', 'rows' => 10]) ?>
                                            </div>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                        <?= Html::endForm() ?>
                                    </div>
                                    <div class="tab-pane" id="yandex_verification">
                                        <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $seo_blocks['yandex_verification']['id']]), 'post', ['enctype' => 'multipart/form-data', 'class' => 'fill-up']) ?>

                                            <?php if($seo_blocks['yandex_verification']['value']):?>
                                                <?= Html::tag('div',$seo_blocks['yandex_verification']['value'], ['class' => 'form-group'])?>
                                            <?php endif;?>

                                            <div class="form-group">
                                                <?= Html::fileInput('file', '', ['class' => 'form-control']) ?>
                                            </div>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue']) ?>
                                        <?= Html::endForm() ?>
                                    </div>
                                    <div class="tab-pane" id="google_verification">
                                        <?= Html::beginForm(Url::toRoute(['default/update', 'id' => $seo_blocks['google_verification']['id']]), 'post', ['enctype' => 'multipart/form-data', 'class' => 'fill-up']) ?>

                                            <?php if($seo_blocks['google_verification']['value']):?>
                                                <?= Html::tag('div',$seo_blocks['google_verification']['value'], ['class' => 'form-group'])?>
                                            <?php endif;?>

                                            <div class="form-group">
                                                <?= Html::fileInput('file', '', ['class' => 'form-control']) ?>
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
