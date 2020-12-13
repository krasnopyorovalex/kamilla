<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\Reviews */

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\IconHelper;
$this->params['breadcrumbs'][] = $this->context->module->params['name'];
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title"><?= $this->context->module->params['name']?></span></div>
                <div class="box-content padded">
                    <div id="dataTables">
                        <?= Html::beginForm(['/reviews/remove-checked'], 'post', ['class' => 'with__positions']) ?>
                        <?php echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'summary' => false,
                                    'tableOptions' => ['class' => 'table responsive'],
                                    'columns' => [
                                        [
                                            'class' => 'yii\grid\CheckboxColumn',
                                            'checkboxOptions' => function($model) {
                                                return ['value' => $model->id];
                                            }
                                        ],
                                        'date:date',
                                        //'ip',
                                        'email',
                                        'name',
                                        [
                                            'attribute' => 'text',
                                            'header' => 'Текст',
                                            'value' => function ($model) {
                                                return \yii\helpers\StringHelper::truncateWords($model->text, 7);
                                            },
                                            'format' => 'html'
                                        ],
                                        [
                                            'attribute' => 'publish',
                                            'header' => 'Опубликован',
                                            'value' => function ($model) {
                                                return IconHelper::status($model->publish);
                                            },
                                            'format' => 'html'
                                        ],
                                        [
                                            'header' => 'Фото',
                                            'value' => function($model){
                                                return $model->getReviewsImages()->count() ? 'Да' : 'Нет';
                                            }
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => 'Действия',
                                            'template' => '{update} {delete}',
                                            'buttons' => [
                                                'update' => function($url){
                                                    return Html::a(Html::tag('i','',['class' => 'icon-pencil']), $url,[
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => 'Редактировать'
                                                    ]);
                                                },
                                                'delete' => function($url){
                                                    return Html::a(Html::tag('i','',['class' => 'icon-remove']), $url,[
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => 'Удалить'
                                                    ]);
                                                }
                                            ],
                                        ],
                                    ],
                                ]);
                        ?>
                        <?=Html::submitButton('Удалить выбранные отзывы', ['class' => 'btn btn-gray']);?>
                        <?= Html::endForm();?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</div>
