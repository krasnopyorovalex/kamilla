<?php
/**
 * @var $model \yii\db\ActiveRecord
 * @var $field \common\models\Files
 */
?>
<div id="<?= $target?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Метаинформация для изображения</h4>
            </div>
            <div class="modal-body">
                <?= $form->field($model, 'metaImage['.$target.'][title]')->textInput([
                        'autocomplete' => 'off',
                        'value' => $field->alt
                ])->label('title') ?>
                <?= $form->field($model, 'metaImage['.$target.'][alt]')->textInput([
                        'autocomplete' => 'off',
                        'value' => $field->title
                    ])->label('alt') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-blue" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal --><!-- find me in partials/modal_form -->