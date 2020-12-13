<?php
/* @var $this yii\web\View */
/* @var $model common\models\MenuItems */
/* @var $menu_id common\models\Menu */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => $this->context->module->params['name'], 'url' => Url::toRoute(['/'.$this->context->module->id])];
$this->params['breadcrumbs'][] = ['label' => 'Пункты меню', 'url' => Url::to(Url::previous())];
$this->params['breadcrumbs'][] = $this->context->actions[$this->context->action->id];
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header">
                    <span class="title">Редактирование</span>
                </div>

                <div class="box-content navigation_box">

                    <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['id' => 'form', 'class' => 'fill-up','enctype' => 'multipart/form-data']]); ?>

                        <div class="row padded">
                            <div class="col-md-8">
                                <?= $form->field($model, 'parent_id')->dropDownList(($model->dropDown($model->isNewRecord ? $menu_id : null)),['class' => 'chzn-select']) ?>
                                <?= $form->field($model, 'name') ?>
                                <?= $form->field($model, 'link', [
                                    'inputTemplate' => '{input}<i class="icon-link" rel="tooltip" data-original-title="Выбрать из выпадающего меню"></i>',
                                    'options' => [
                                        'class' => 'link'
                                    ]
                                ])?>
                                <?= $form->field($model, 'options')->dropDownList($model->links(),['class' => 'uniform options__list']) ?>
                                <?php if($model->isNewRecord):?>
                                    <?= $form->field($model, 'menu_id')->hiddenInput(['value' => $menu_id])->label(false) ?>
                                <?php endif;?>
                            </div>
                            <div class="col-md-4">
                                <?php if($model->icon):?>
                                    <div class="thumbnail">
                                        <?= Html::img($model::PATH.$model->icon)?>
                                        <?= Html::button('Удалить иконку',[
                                            'class' => 'btn btn-sm btn-red',
                                            'id' => 'remove_image'
                                        ])?>
                                    </div>
                                <?php endif;?>
                                <?= $form->field($model, 'file')->fileInput(['accept' => 'image/*']) ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <?= Html::submitButton($this->context->action->id == 'delete-item' ? 'Удалить' : 'Сохранить', [
                                'class' => $this->context->action->id == 'delete-item' ? 'btn btn-danger' :'btn btn-primary',
                                'rel' => 'tooltip',
                                'data-original-title' => $this->context->action->id == 'delete-item' ? 'Удалить и вернуться к списку' : 'Сохранить и вернуться к списку'
                            ]) ?>
                            <?= Html::a('Вернуться', Url::previous(), [
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
