<?php
/* @var $this yii\web\View */
/* @var $model common\models\Reviews */
/* @var $images common\models\ReviewsImages */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;
use common\models\ReviewsImages;

CkEditorAsset::register($this);

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

                            <div class="col-md-9">
                                <?= $form->field($model, 'text')->textarea() ?>
                                <?= $form->field($model, 'answer')->textarea() ?>
                            </div>

                            <div class="col-md-3">
                                <?= $form->field($model, 'date')->textInput(['class' => 'datepicker']) ?>
                                <?= $form->field($model, 'name') ?>
                                <?= $form->field($model, 'city') ?>
                                <?= $form->field($model, 'email') ?>
                                <?= $form->field($model, 'publish')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                                <?= $form->field($model, 'show_in_main')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-actions">
                            <?= Html::submitButton($this->context->action->id == 'delete' ? 'Удалить' : 'Сохранить', [
                                'class' => $this->context->action->id == 'delete' ? 'btn btn-danger' :'btn btn-primary',
                                'rel' => 'tooltip',
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
                        <hr />
                        <div class="row padded">

                            <div class="col-md-12">

                                <?php $imageForm = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'reviews', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>

                                <?php if($model['reviewsImages']):?>
                                    <h5>Фото гостей</h5>
                                    <?= Html::ul($model['reviewsImages'], ['item' => function($item) {

                                        $actions = Html::tag('i','',['class' => 'icon-edit', 'data-toggle' => 'modal', 'href' => '#edit-image', 'data-link' => Url::toRoute(['default/edit-image', 'id' => $item['id']])]) .
                                            Html::tag('i','',['class' => 'icon-remove', 'data-id' => $item['id'], 'data-link' => Url::toRoute(['default/remove-image-by-id', 'id' => $item['id']])]);

                                        return Html::tag(
                                            'li',
                                            Html::img(ReviewsImages::PATH.$item['basename'].'.'.$item['ext']).Html::tag('div',$actions,['class' => 'actions']),
                                            ['id' => 'image_' . $item['id']]
                                        );
                                    },'class' => 'review_images']) ?>
                                <?php endif;?>

                                <?= $imageForm->field($images, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                                <?= Html::submitButton('Загрузить',['class' => 'btn btn-primary'])?>

                                <?php ActiveForm::end() ?>
                            </div>

                        </div>

                </div>
            </div>

        </div>
    </div>

</div>
<?= Html::tag('div','',['class' => 'modal fade', 'id' => 'edit-image'])?>