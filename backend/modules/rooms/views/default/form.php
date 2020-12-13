<?php
/* @var $this yii\web\View */
/* @var $model common\models\Rooms */
/* @var $attributes_array common\models\RoomsAttributes */
/* @var $attributes_room common\models\RoomsAttributesVia */
/* @var $tabs_room common\models\RoomsTabsVia */
/* @var $tabs_array common\models\RoomsTabs */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;

CkEditorAsset::register($this);

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
                        <li><a href="#attributes" data-toggle="tab"><i class="icon-list-ol"></i> <span>Характеристики</span></a></li>
                        <li><a href="#tabs" data-toggle="tab"><i class="icon-columns"></i> <span>Вкладки</span></a></li>
                        <li><a href="#images" data-toggle="tab"><i class="icon-picture"></i> <span>Изображения</span></a></li>
                    </ul>
                </div>

                <div class="box-content padded">

                    <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>
                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">

                                <div class="col-md-9">
                                    <?= $form->field($model, 'name')->textInput(['id' => 'transliterate__input', 'autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'title')->textInput(['autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'description')->textInput(['autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'keywords')->textInput(['autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'slogan')->textInput(['autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'video')->textInput(['autocomplete' => 'off']) ?>
                                    <div class="block_main-page">
                                        <?= $form->field($model, 'show_in_main')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                        <?= $form->field($model, 'menu_name')->textInput(['autocomplete' => 'off']) ?>
                                    </div>
                                    <!-- /.block_main-page -->
                                </div>

                                <div class="col-md-3">
                                    <?= $form->field($model, 'alias', [
                                        'inputTemplate' => '{input}<i class="icon-refresh" rel="tooltip" data-original-title="Транслитеровать название в Alias"></i>',
                                        'options' => [
                                            'class' => 'alias__transliterate'
                                        ]
                                    ])->textInput(['autocomplete' => 'off'])?>
                                    <?= $form->field($model, 'gallery_id')->dropDownList($model->getGalleries(), [
                                        'class' => 'chzn-select',
                                        'prompt' => 'Не выбрано'
                                    ]) ?>
                                    <?= $form->field($model, 'price') ?>
                                    <?php if(!$model->isNewRecord):?>
                                        <?= $form->field($model, 'publish')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'text')->textarea() ?>
                                    <?= $form->field($model, 'text_preview')->textarea() ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="attributes">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- attributes rooms -->
                                    <?php if($attributes_array):?>
                                        <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                        <?php foreach ($attributes_array as $aa):?>
                                            <?= $form->field($model, 'attrArray['.$aa['id'].']')->textInput([
                                                'value' => isset($attributes_room[$aa['id']])
                                                    ? $attributes_room[$aa['id']]
                                                    : ''
                                            ])->label($aa['name'])?>
                                        <?php endforeach;?>
                                        <?= Html::endTag('div')?>
                                    <?php endif;?>
                                    <!-- attributes rooms -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="images">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php if($model->image):?>
                                        <div class="thumbnail">
                                            <?= Html::img($model->image->path, [
                                                'data-id' => $model->image->id
                                            ])?>
                                            <?= Html::a('Метаинформация','#' . $model::IMAGE_FILE,[
                                                'class' => 'btn btn-sm btn-green',
                                                'data-toggle' => 'modal'
                                            ])?>
                                            <?= Html::button('Удалить изображение',[
                                                'class' => 'btn btn-sm btn-red',
                                                'id' => 'remove_image'
                                            ])?>
                                        </div>
                                        <?= $this->render('@app/views/blocks/_image_meta', [
                                            'model' => $model,
                                            'target' => $model::IMAGE_FILE,
                                            'form' => $form,
                                            'field' => $model->image
                                        ])?>
                                    <?php endif;?>

                                    <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>
                                </div>
                                <div class="col-md-4">
                                    <?php if($model->image):?>
                                        <div class="thumbnail">
                                            <?= Html::img($model->imagePreview->path, [
                                                'data-id' => $model->imagePreview->id
                                            ])?>
                                            <?= Html::a('Метаинформация','#' . $model::IMAGE_PREVIEW_FILE,[
                                                'class' => 'btn btn-sm btn-green',
                                                'data-toggle' => 'modal'
                                            ])?>
                                            <?= Html::button('Удалить изображение',[
                                                'class' => 'btn btn-sm btn-red',
                                                'id' => 'remove_image'
                                            ])?>
                                        </div>
                                        <?= $this->render('@app/views/blocks/_image_meta', [
                                            'model' => $model,
                                            'target' => $model::IMAGE_PREVIEW_FILE,
                                            'form' => $form,
                                            'field' => $model->image
                                        ])?>
                                    <?php endif;?>

                                    <?= $form->field($model, 'imagePreviewFile')->fileInput(['accept' => 'image/*']) ?>
                                </div>
                                <div class="col-md-4">
                                    <?php if($model->image):?>
                                        <div class="thumbnail">
                                            <?= Html::img($model->imageMainPreview->path, [
                                                'data-id' => $model->image->id
                                            ])?>
                                            <?= Html::a('Метаинформация','#' . $model::IMAGE_MAIN_PREVIEW_FILE,[
                                                'class' => 'btn btn-sm btn-green',
                                                'data-toggle' => 'modal'
                                            ])?>
                                            <?= Html::button('Удалить изображение',[
                                                'class' => 'btn btn-sm btn-red',
                                                'id' => 'remove_image'
                                            ])?>
                                        </div>
                                        <?= $this->render('@app/views/blocks/_image_meta', [
                                            'model' => $model,
                                            'target' => $model::IMAGE_MAIN_PREVIEW_FILE,
                                            'form' => $form,
                                            'field' => $model->image
                                        ])?>
                                    <?php endif;?>

                                    <?= $form->field($model, 'imageMainPreviewFile')->fileInput(['accept' => 'image/*']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs">
                            <div class="col-md-12">
                                <!-- tabs rooms -->
                                <?php if($tabs_array):?>
                                    <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                    <?php foreach ($tabs_array as $ta):?>
                                        <?= $form->field($model, 'tabsArray['.$ta['id'].']')->textarea([
                                            'value' => isset($tabs_room[$ta['id']])
                                                ? $tabs_room[$ta['id']]
                                                : ''
                                        ])->label($ta['name'])?>
                                    <?php endforeach;?>
                                    <?= Html::endTag('div')?>
                                <?php endif;?>
                                <!-- tabs rooms -->
                            </div>
                        </div>
                    </div>
                    <?= $this->render('@app/views/blocks/_actions')?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
