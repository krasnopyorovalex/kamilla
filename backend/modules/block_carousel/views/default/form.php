<?php
/* @var $this yii\web\View */
/* @var $model common\models\BlockCarousel */
/* @var $file common\models\BlockCarouselImages */

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
                    <span class="title"><?= $this->context->actions[$this->context->action->id]?></span>
                </div>

                <div class="box-content">

                    <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>

                        <div class="row padded">

                            <div class="col-md-12">
                                <?= $form->field($model, 'name')->textarea() ?>
                                <?= $form->field($model, 'color')->textInput(['autocomplete' => 'off']) ?>
                            </div>
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

                </div>
            </div>

            <?php if(!$model->isNewRecord):?>
                <div class="row">
                    <div class="col-md-12">
                        <?php $formImage = ActiveForm::begin(['action' => Url::toRoute(['/site/multiupload-blocks-carousel']), 'id' => 'upload', 'options' => [
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
                <div class="row padded loaded_images">
                    <div class="box">
                        <div class="box-header">
                            <div class="title">Загруженные изображения</div>
                        </div>

                        <div id="image_box">
                            <?= $this->render('_image_box', ['model' => $model])?>
                        </div>
                    </div>
                </div>
            <?php endif;?>

        </div>
    </div>

</div>
<?= Html::tag('div','',['class' => 'modal fade', 'id' => 'edit-image'])?>