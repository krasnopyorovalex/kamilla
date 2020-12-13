<?php
/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $images common\models\GalleryImages */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;
use backend\assets\GalleryAsset;

CkEditorAsset::register($this);
GalleryAsset::register($this);
$this->params['breadcrumbs'][] = ['label' => $this->context->module->params['name'], 'url' => Url::toRoute(['/'.$this->context->module->id])];
$this->params['breadcrumbs'][] = $this->context->actions[$this->context->action->id];
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <ul class="nav nav-tabs nav-tabs-left">
                        <li class="active"><a href="#main" data-toggle="tab"><i class="icon-pencil"></i> <span>Основное</span></a></li>
                        <?php if( ! $model->isNewRecord ):?>
                        <li><a href="#images" data-toggle="tab"><i class="icon-camera-retro"></i> <span>Мультимедиа</span></a></li>
                        <?php endif;?>
                    </ul>
                </div>

                <div class="box-content padded">
                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>
                            <div class="row">
                                <div class="col-md-8">
                                    <?= $form->field($model, 'name')->textInput(['id' => 'transliterate__input']) ?>
                                    <?= $form->field($model, 'title') ?>
                                    <?= $form->field($model, 'description') ?>
                                    <?= $form->field($model, 'keywords') ?>
                                    <?= $form->field($model, 'alias', [
                                        'inputTemplate' => '{input}<i class="icon-refresh" rel="tooltip" data-original-title="Транслитеровать название в Alias"></i>',
                                        'options' => [
                                            'class' => 'alias__transliterate'
                                        ]
                                    ])?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'sys_name') ?>
                                    <?= $form->field($model, 'add_menu')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                    <?php if(!$model->isNewRecord):?>
                                        <?= $form->field($model, 'publish')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                        <?= $form->field($model, 'view_in_gallery')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'text_above')->textarea() ?>
                                    <?= $form->field($model, 'text_below')->textarea() ?>
                                </div>
                            </div>
                            <?= $this->render('@app/views/blocks/_actions')?>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="tab-pane" id="images">

                            <?php if(!$model->isNewRecord && isset($images)):?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php $formImage = ActiveForm::begin(['action' => Url::toRoute(['/site/multiupload']), 'id' => 'upload', 'options' => [
                                            'enctype' => 'multipart/form-data',
                                            'class' => 'dropzone dz-clickable'
                                        ]]); ?>
                                        <span class="triangle-button orange"><i class="icon-plus"></i></span>
                                        <div class="form-group">
                                            <div class="dz-message">
                                                Перетащите сюда файлы или кликните для загрузки изображений<br><span class="icon-cloud-upload icon-2x"></span>
                                                <?= $formImage->field($images, 'file')->fileInput(['multiple' => true, 'class' => 'hidden'])->label(false) ?>
                                                <?= Html::input('hidden', 'id', $model->id, ['id' => 'gallery_cat_id']) ?>
                                            </div>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box">
                                            <div class="box-header">
                                                <div class="title">Загруженные изображения</div>

                                                <div class="box__galleries_list">

                                                    <div class="galleries__list">
                                                        <select name="group__actions" id="group__actions" class="uniform">
                                                            <option value=""> Выберите действие</option>
                                                            <option value="check_all"> Выделить всё</option>
                                                            <option value="copy-checked"> Копировать в ..</option>
                                                            <option value="move-checked"> Переместить в ..</a></option>
                                                            <option value="remove-checked"> Удалить выделенное</option>
                                                        </select>
                                                    </div>

                                                    <div class="galleries__list hidden">
                                                        <?= Html::dropDownList('galleries', '', \common\models\Gallery::getGalleriesList($model->id),['class' => 'uniform gallery_id'])?>
                                                    </div>
                                                    <div class="btn_action hidden">
                                                        <?= Html::button('Отправить',['class' => 'btn btn-xs btn-blue'])?>
                                                    </div>

                                                </div>
                                            </div>

                                            <div id="image_box">
                                                <?= $this->render('_image_box', ['model' => $model])?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= Html::tag('div','',['class' => 'modal fade', 'id' => 'edit-image'])?>