<?php
/* @var $this yii\web\View */
/* @var $model common\models\Specials */

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
                        <li class="active"><a href="#main" data-toggle="tab"><i class="icon-pencil"></i> <span>Основное-SEO</span></a></li>
                        <li><a href="#content" data-toggle="tab"><i class="icon-list-alt"></i> <span>Контент</span></a></li>
                        <li><a href="#images" data-toggle="tab"><i class="icon-camera-retro"></i> <span>Мультимедиа</span></a></li>
                        <li><a href="#rr" data-toggle="tab"><i class="icon-file-alt"></i> <span>Для блока - «Рекомендуем к прочтению»</span></a></li>
                    </ul>
                </div>

                <div class="box-content padded">

                    <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">
                                <div class="col-md-8">
                                    <?= $form->field($model, 'name')->textInput(['id' => 'transliterate__input', 'autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'title')->textInput(['autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'description')->textInput(['autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'keywords')->textInput(['autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'video')->textInput(['autocomplete' => 'off']) ?>
                                </div>

                                <div class="col-md-4">
                                    <?= $form->field($model, 'alias', [
                                        'inputTemplate' => '{input}<i class="icon-refresh" rel="tooltip" data-original-title="Транслитеровать название в Alias"></i>',
                                        'options' => [
                                            'class' => 'alias__transliterate'
                                        ]
                                    ])->textInput(['autocomplete' => 'off'])?>
                                    <?= $form->field($model, 'slogan')->textInput(['autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'date')->textInput(['class' => 'datepicker']) ?>
                                    <?= $form->field($model, 'galleries')->dropDownList($model->getGalleries(), [
                                        'class' => 'chzn-select',
                                        'multiple' => true,
                                    ]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $form->field($model, 'is_finished')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                </div>
                                <div class="col-md-3">
                                    <?php if(!$model->isNewRecord):?>
                                        <?= $form->field($model, 'publish')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                    <?php endif;?>
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                        <div class="tab-pane" id="images">
                            <div class="row">
                                <div class="col-md-4">
                                    <?= $form->field($model, $model::IMAGE_PREVIEW_FILE)->fileInput(['accept' => 'image/*']) ?>
                                    <?php if($model->imagePreview):?>
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
                                            'field' => $model->imagePreview
                                        ])?>
                                    <?php endif;?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, $model::IMAGE_HEADER_FILE)->fileInput(['accept' => 'image/*']) ?>
                                    <?php if($model->imageHeader):?>
                                        <div class="thumbnail">
                                            <?= Html::img($model->imageHeader->path, [
                                                'data-id' => $model->imageHeader->id
                                            ])?>
                                            <?= Html::a('Метаинформация','#' . $model::IMAGE_HEADER_FILE,[
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
                                            'target' => $model::IMAGE_HEADER_FILE,
                                            'form' => $form,
                                            'field' => $model->imageHeader
                                        ])?>
                                    <?php endif;?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, $model::IMAGE_ACTION_FILE)->fileInput(['accept' => 'image/*']) ?>
                                    <?php if($model->imageAction):?>
                                        <div class="thumbnail">
                                            <?= Html::img($model->imageAction->path, [
                                                'data-id' => $model->imageAction->id
                                            ])?>
                                            <?= Html::a('Метаинформация','#' . $model::IMAGE_ACTION_FILE,[
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
                                            'target' => $model::IMAGE_ACTION_FILE,
                                            'form' => $form,
                                            'field' => $model->imageAction
                                        ])?>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?= $form->field($model, 'text_preview')->textarea() ?>
                                            <?= $form->field($model, 'text')->textarea() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="rr">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?= $form->field($model, 'name_rr')->textInput() ?>
                                            <?= $form->field($model, 'text_rr')->textarea() ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?php if($model->imageRr):?>
                                                <div class="thumbnail">
                                                    <?= Html::img($model->imageRr->path, [
                                                        'data-id' => $model->imageRr->id
                                                    ])?>
                                                    <?= Html::a('Метаинформация','#' . $model::IMAGE_RR_FILE,[
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
                                                    'target' => $model::IMAGE_RR_FILE,
                                                    'form' => $form,
                                                    'field' => $model->imageRr
                                                ])?>
                                            <?php endif;?>

                                            <?= $form->field($model, $model::IMAGE_RR_FILE)->fileInput(['accept' => 'image/*']) ?>
                                        </div>
                                    </div>
                                </div>
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
