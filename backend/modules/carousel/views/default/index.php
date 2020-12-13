<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\Carousel */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
$this->params['breadcrumbs'][] = $this->context->module->params['name'];
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title"><?= $this->context->module->params['name']?></span></div>
                <div class="box-content padded">
                    <div id="dataTables">
                        <?php echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'summary' => false,
                            'tableOptions' => ['class' => 'table responsive table-sortable'],
                            'rowOptions' => function($model){
                                return [
                                    'id' => $model['id']
                                ];
                            },
                            'columns' => [
                                'name',
                                [
                                    'attribute' => 'date',
                                    'header' => 'Дата последнего редактирования',
                                    'value' => function ($model) {
                                        return Yii::$app->formatter->asDate($model->updated_at);
                                    },
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>