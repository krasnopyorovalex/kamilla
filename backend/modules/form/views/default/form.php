<?php
/* @var $this yii\web\View */
/* @var $model common\models\Form */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->params['breadcrumbs'][] = ['label' => $this->context->module->params['name'], 'url' => Url::toRoute(['/'.$this->context->module->id])];
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

                            <div class="col-md-8">
                                <?= $form->field($model, 'type')->dropDownList($model->types, ['class' => 'chzn-select']) ?>

                                <?= $form->field($model, 'name') ?>
                                <?= $form->field($model, 'theme') ?>
                                <?= $form->field($model, 'submit_btn_text') ?>
                                <?= $form->field($model, 'submit_success') ?>
                                <?= $form->field($model, 'event') ?>
                                <?= $form->field($model, 'json_schema')->hiddenInput(['id' => 'json_schema'])->label(false) ?>
                                <?= $form->field($model, 'images_on')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                <?= $form->field($model, 'captcha')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                <?= $form->field($model, 'show_name')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'email') ?>
                                <?= $form->field($model, 'sys_name') ?>
                                <?= $form->field($model, 'css') ?>
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
                        </div>
                    <div class="row padded">
                        <div class="col-md-4" id="form_builder">
                            <div class="buttons">
                                <button class="btn btn-blue" data-action="input">Добавить «input»</button>
                                <button class="btn btn-blue" data-action="select">Добавить «select»</button>
                                <button class="btn btn-blue" data-action="checkbox">Добавить «checkbox»</button>
                                <button class="btn btn-blue" data-action="radio">Добавить «radio»</button>
                                <button class="btn btn-blue" data-action="textarea">Добавить «textarea»</button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="form_build"></div>
                        </div>
                    </div>
                        <div class="form-actions">
                            <?= Html::submitButton($this->context->action->id == 'delete' ? 'Удалить' : 'Сохранить', [
                                'class' => $this->context->action->id == 'delete' ? 'btn btn-danger' :'btn btn-primary',
                                'rel' => 'tooltip',
                                'id' => 'save_form',
                                'data-original-title' => $this->context->action->id == 'delete' ? 'Удалить и вернуться к списку' : 'Сохранить и вернуться к списку'
                            ]) ?>
                            <?= Html::a('Вернуться', Url::toRoute(["/{$this->context->module->id}"]), [
                                'class' => 'btn btn-green',
                                'id' => 'return',
                                'rel' => 'tooltip',
                                'data-original-title' => 'Вернуться к списку'
                            ])?>
                        </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>

</div>
