<?php
/* @var $this yii\web\View */
/* @var $model common\models\ServicesMenu */

use common\widgets\Alert;
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

            <?php if(Yii::$app->session->getFlash('error')):?>
                <div id="w0-error-0" class="alert-danger alert fade in">
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
                                    <?= $form->field($model, 'sys_name')->textInput(['autocomplete' => 'off']) ?>
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
