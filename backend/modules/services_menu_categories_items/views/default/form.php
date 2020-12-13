<?php
/* @var $this yii\web\View */
/* @var $model common\models\ServicesMenuCategoriesItems */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;

CkEditorAsset::register($this);

if( ! $model->isNewRecord ) {
    $servicesMenuCategories = $model->servicesMenuCategory;
}

$this->params['breadcrumbs'][] = ['label' => 'Меню услуг', 'url' => Url::toRoute(['/services_menu'])];
$this->params['breadcrumbs'][] = ['label' => $servicesMenuCategories->name, 'url' => Url::toRoute(['/services_menu/categories/'.$servicesMenuCategories->servicesMenu->id])];
$this->params['breadcrumbs'][] = 'Пункты';
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
                                <div class="col-md-8">
                                    <div class="custom_block">
                                        <?= $form->field($model, 'name')->textInput(['autocomplete' => 'off']) ?>
                                        <?= $form->field($model, 'name_link')->textInput(['autocomplete' => 'off']) ?>
                                    </div>
                                    <!-- /.custom_block -->
                                    <?php if($model->isNewRecord):?>
                                        <?= $form->field($model, 'services_menu_category_id')->hiddenInput(['value' => Yii::$app->request->get('services_menu_category_id')])->label(false) ?>
                                    <?php endif;?>
                                    <?= $form->field($model, 'price')->textarea() ?>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom_block">
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
                                        <?= $form->field($model, 'image_link')->textInput() ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'text')->textarea() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <?= Html::submitButton($this->context->action->id == 'delete' ? 'Удалить' : 'Сохранить', [
                            'class' => $this->context->action->id == 'delete' ? 'btn btn-danger' :'btn btn-primary',
                            'rel' => 'tooltip',
                            'data-original-title' => $this->context->action->id == 'delete' ? 'Удалить и вернуться к списку' : 'Сохранить и вернуться к списку'
                        ]) ?>
                        <?php
                        $url = Url::previous() ? Url::to(Url::previous()) : Url::toRoute("/{$this->context->module->id}");
                        ?>
                        <?= Html::a('Вернуться', $url, [
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
