<?php
/* @var $this yii\web\View */
/* @var $model common\models\ServicesMenuCategories */
/* @var $servicesMenu common\models\ServicesMenu */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use backend\assets\CkEditorAsset;

CkEditorAsset::register($this);

$servicesMenu = isset($model->servicesMenu) ? $model->servicesMenu : $servicesMenu;

$this->params['breadcrumbs'][] = ['label' => 'Меню услуг', 'url' => Url::toRoute(['/services_menu'])];
$this->params['breadcrumbs'][] = ['label' => $servicesMenu->name, 'url' => Url::toRoute(['/services_menu/categories/'.$servicesMenu->id])];
$this->params['breadcrumbs'][] = $this->context->actions[$this->context->action->id];
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php if(Yii::$app->session->getFlash('error')):?>
                <div class="alert-danger alert fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?= Yii::$app->session->getFlash('error')?>
                </div>
            <?php endif;?>

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
                                    <?= $form->field($model, 'name')->textInput(['autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'slogan')->textInput(['autocomplete' => 'off']) ?>
                                    <?php if($model->isNewRecord):?>
                                        <?= $form->field($model, 'services_menu_id')->hiddenInput(['value' => Yii::$app->request->get('services_menu_id')])->label(false) ?>
                                    <?php endif;?>
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
