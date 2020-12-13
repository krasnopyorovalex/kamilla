<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\Menu */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
$this->params['breadcrumbs'][] = $this->context->module->params['name'];
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title">Навигация</span></div>
                <div class="box-content padded">
                    <div id="dataTables">
                        <?php echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'summary' => false,
                                    'tableOptions' => ['class' => 'table responsive'],
                                    'columns' => [
                                        [
                                            'attribute' => 'name',
                                            'header' => 'Название',
                                            'value' => function ($model) {
                                                return $model->name;
                                            },
                                            'format' => 'html'
                                        ],
                                        [
                                            'attribute' => 'created_at',
                                            'header' => 'Дата создания',
                                            'value' => function ($model) {
                                                return Yii::$app->formatter->asDate($model->created_at);
                                            },
                                        ],
                                        'sys_name',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => 'Действия',
                                            'template' => '{update} {items} {delete}',
                                            'buttons' => [
                                                'update' => function($url){
                                                    return Html::a(Html::tag('i','',['class' => 'icon-pencil']), $url,[
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => 'Редактировать'
                                                    ]);
                                                },
                                                'items' => function($url){
                                                    return Html::a(Html::tag('i','',['class' => 'icon-list-ul']), $url,[
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => 'Пункты меню'
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
                    </div>
                    </div>
                </div>
            </div>
        </div>
</div>
