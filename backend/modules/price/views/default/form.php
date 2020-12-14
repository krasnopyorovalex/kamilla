<?php

/* @var $model common\models\Price */
/* @var $attributes_array common\models\PriceDates */
/* @var $attributes_price common\models\PriceDatesVia */
/* @var array $galleries common\models\Gallery */
/* @var array $rooms common\models\Rooms */

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
                    </ul>
                </div>

                <div class="box-content padded">

                    <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            <div class="row">
                                <div class="col-md-9">
                                    <?= $form->field($model, 'name')->textInput() ?>
                                    <?= $form->field($model, 'description')->textarea() ?>
                                </div>

                                <div class="col-md-3">
                                    <?= $form->field($model, 'room_id')->dropDownList($rooms, [
                                        'class' => 'chzn-select',
                                        'prompt' => 'Не выбрано'
                                    ]) ?>
                                    <?= $form->field($model, 'gallery_id')->dropDownList($galleries, [
                                        'class' => 'chzn-select',
                                        'prompt' => 'Не выбрано'
                                    ]) ?>
                                    <?php if($model->image):?>
                                        <div class="thumbnail">
                                            <?= Html::img($model::PATH.$model->image)?>
                                            <?= Html::button('Удалить иконку',[
                                                'class' => 'btn btn-sm btn-red',
                                                'id' => 'remove_image'
                                            ])?>
                                        </div>
                                    <?php endif;?>
                                    <?= $form->field($model, 'file')->fileInput(['accept' => 'image/*']) ?>
                                    <?= $form->field($model, 'square')->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <!-- price dates -->
                                    <?php if($attributes_array):?>
                                        <?= Html::beginTag('div', ['class' => 'attributes_product'])?>
                                        <?php foreach ($attributes_array as $aa):?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?= $form->field($model, 'attrArray['.$aa['id'].']')->textarea([
                                                       'value' => isset($attributes_price[$aa['id']])
                                                           ? $attributes_price[$aa['id']]
                                                           : ''
                                                   ])->label($aa['name'])?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?= $form->field($model, 'attrPopupArray['.$aa['id'].']')->textarea([
                                                       'value' => isset($attributes_popup[$aa['id']])
                                                           ? $attributes_popup[$aa['id']]
                                                           : ''
                                                   ])->label('Для всплывающего окна')?>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
                                        <?= Html::endTag('div')?>
                                    <?php endif;?>
                                    <!-- price dates -->
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