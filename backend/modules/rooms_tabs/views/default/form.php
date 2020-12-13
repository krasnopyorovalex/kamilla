<?php
/* @var $this yii\web\View */
/* @var $model common\models\RoomsTabs */

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
                    <span class="title"><?= $this->context->actions[$this->context->action->id]?></span>
                </div>

                <div class="box-content">

                    <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>

                        <div class="row padded">

                            <div class="col-md-12">
                                <?= $form->field($model, 'name')->textInput(['id' => 'transliterate__input']) ?>
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

        </div>
    </div>

</div>
