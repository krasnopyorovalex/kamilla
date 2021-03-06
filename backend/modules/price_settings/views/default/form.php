<?php
/* @var $this yii\web\View */
/* @var $model common\models\PriceSettings */

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
                                <div class="col-md-12">
                                    <?= $form->field($model, 'color_head_btn')->textInput() ?>
                                    <?= $form->field($model, 'color_first')->textInput() ?>
                                    <?= $form->field($model, 'color_second')->textInput() ?>
                                    <?= $form->field($model, 'color_third')->textInput() ?>
                                    <?= $form->field($model, 'color_fourth')->textInput() ?>
                                    <?= $form->field($model, 'color_five')->textInput() ?>
                                    <?= $form->field($model, 'color_border')->textInput() ?>
                                    <?= $form->field($model, 'col_name')->textInput() ?>
                                    <?= $form->field($model, 'col_name_mob')->textInput() ?>
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