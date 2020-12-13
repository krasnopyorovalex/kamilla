<?php
/* @var $this yii\web\View */
/* @var $model common\models\CategoryProduct */
/* @var $category_id common\models\Category */
/* @var $attribute_product common\models\AttributeProduct */
/* @var $attributes_array common\models\Attribute */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;

CkEditorAsset::register($this);
$this->params['breadcrumbs'][] = ['label' => $this->context->module->params['name'], 'url' => Url::toRoute(['/'.$this->context->module->id])];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => Url::to(Url::previous())];
$this->params['breadcrumbs'][] = $this->context->actions[$this->context->action->id];
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <span class="title"><?= $this->context->actions[$this->context->action->id]?></span>
                </div>

                <div class="box-content">
                    <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>

                        <div class="row padded">

                            <div class="col-md-9">
                                <?= $form->field($model, 'name')->textInput(['id' => 'transliterate__input']) ?>
                                <?= $form->field($model, 'title') ?>
                                <?= $form->field($model, 'description') ?>
                                <?= $form->field($model, 'keywords') ?>
                                <?php if($model->isNewRecord):?>
                                    <?= $form->field($model, 'category_id')->hiddenInput(['value' => $category_id])->label(false) ?>
                                <?php endif;?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'carousel_id')->dropDownList([], ['class' => 'chzn-select']) ?>
                                <?= $form->field($model, 'gallery_id')->dropDownList([], ['class' => 'chzn-select']) ?>
                                <?= $form->field($model, 'form_id')->dropDownList([], ['class' => 'chzn-select']) ?>
                                <?= $form->field($model, 'price') ?>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-md-9">
                                <?= $form->field($model, 'alias', [
                                    'inputTemplate' => '{input}<i class="icon-refresh" rel="tooltip" data-original-title="Транслитеровать название в Alias"></i>',
                                    'options' => [
                                        'class' => 'alias__transliterate'
                                    ]
                                ])?>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="clearfix"></div>
                            <div class="col-md-9">
                                <?= $form->field($model, 'text_preview')->textarea() ?>
                            </div>
                            <div class="col-md-3">
                                <?php if($model->image):?>
                                    <div class="thumbnail">
                                        <?= Html::img($model::PATH.$model->image)?>
                                        <?= Html::a('Метаинформация','#meta-image',[
                                            'class' => 'btn btn-sm btn-green',
                                            'data-toggle' => 'modal'
                                        ])?>
                                        <?= Html::button('Удалить изображение',[
                                            'class' => 'btn btn-sm btn-red',
                                            'id' => 'remove_image'
                                        ])?>
                                    </div>
                                <?php endif;?>
                                <?= $form->field($model, 'file')->fileInput(['accept' => 'image/*']) ?>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'text')->textarea() ?>

                                <!-- attributes product -->
                                <?php if($attributes_array):?>
                                    <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                        <?php foreach ($attributes_array as $aa):?>
                                            <?= $form->field($model, 'attrArray['.$aa['id'].']')->textInput([
                                                'value' => isset($attribute_product[$aa['id']])
                                                    ? $attribute_product[$aa['id']]
                                                    : ''
                                            ])->label($aa['name'])?>
                                        <?php endforeach;?>
                                    <?= Html::endTag('div')?>
                                <?php endif;?>
                                <!-- attributes product -->

                                <?php if(!$model->isNewRecord):?>
                                    <?= $form->field($model, 'publish')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                <?php endif;?>

                            </div>
                        </div>
                        <div class="form-actions">
                            <?= Html::submitButton($this->context->action->id == 'delete-product' ? 'Удалить' : 'Сохранить', [
                                'class' => $this->context->action->id == 'delete-product' ? 'btn btn-danger' :'btn btn-primary',
                                'rel' => 'tooltip',
                                'data-original-title' => $this->context->action->id == 'delete-product' ? 'Удалить и вернуться к списку' : 'Сохранить и вернуться к списку'
                            ]) ?>
                            <?= Html::a('Вернуться', Url::previous(), [
                                'class' => 'btn btn-green',
                                'id' => 'return',
                                'rel' => 'tooltip',
                                'data-original-title' => 'Вернуться к списку'
                            ])?>
                        </div>

                        <div id="meta-image" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Метаинформация для изображения</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?= $form->field($model, 'image_title')->textInput(['autocomplete' => 'off']) ?>
                                        <?= $form->field($model, 'image_alt')->textInput(['autocomplete' => 'off']) ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-blue" data-dismiss="modal">Закрыть</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal --><!-- find me in partials/modal_form -->

                        <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>

</div>
