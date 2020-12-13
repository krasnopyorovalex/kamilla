<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\Price */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\components\IconHelper;
$this->params['breadcrumbs'][] = $this->context->module->params['name'];
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title">Таблица цен</span></div>
                <div class="box-content padded">
                    <div id="dataTables" class="price__table">
                        <?= Html::beginForm(['/price/update-pos'], 'post') ?>
                        <?php echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    //'summary' => false,
                                    'tableOptions' => ['class' => 'table responsive'],
                                    'showFooter' => true,
                                    'columns' => [
                                        'name',
                                        [
                                            'attribute' => 'image',
                                            'header' => 'Иконка',
                                            'value' => function ($model) {
                                                return Html::img($model::PATH.$model->image);
                                            },
                                            'format' => 'html'
                                        ],
                                        [
                                            'header' => 'Позиция',
                                            'class' => 'yii\grid\ActionColumn',
                                            'template' => '{pos}',
                                            'buttons' => [
                                                'pos' => function($url,$model){
                                                    return Html::input('text','positions['.$model['id'].']',$model['pos']);
                                                }
                                            ],
                                            'footer' => Html::submitButton('Сохранить',['class' => 'btn btn-xs btn-green']),
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
                                echo Html::tag('div', Html::a('Добавить', Url::toRoute(["/{$this->context->module->id}/add"]), ['class' => 'btn btn-blue']),[
                                    'class' => 'padded'
                                ]);
                        ?>
                        <?= Html::endForm() ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</div>
