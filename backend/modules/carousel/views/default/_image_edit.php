<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $model \common\models\CarouselImages */
?>
<div class="modal-dialog">
    <div class="modal-content">
        <?php $form = ActiveForm::begin(['method' => 'post', 'options' => ['class' => 'fill-up']]); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Редактирование информации об изображении</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 form-edit">
                        <?= $form->field($model, 'link')->dropDownList(\yii\helpers\ArrayHelper::merge(['' => 'Не выбрано'],$model->links())) ?>
                        <?= $form->field($model, 'color')->textInput(['placeholder' => 'Формат - #c5c5c5']) ?>
                        <?= $form->field($model, 'text_top') ?>
                        <?= $form->field($model, 'text_middle') ?>
                        <?= $form->field($model, 'text_btn') ?>
                        <?= $form->field($model, 'alt') ?>
                        <?= $form->field($model, 'title') ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'publish')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                            </div>
                            <div class="col-md-8">
                                <?= $form->field($model, 'is_mob_show')->checkbox(['class' => 'iButton-icons'], false)->error(false) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-blue', 'id' => 'edit_image_button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
