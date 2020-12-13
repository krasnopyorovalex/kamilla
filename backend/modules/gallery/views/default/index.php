<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\Gallery */

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
                        <?= Html::beginForm(['/gallery/update-pos'], 'post') ?>
                        <?php echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'summary' => false,
                            'tableOptions' => ['class' => 'table responsive table-sortable'],
                            'showFooter' => true,
                            'columns' => [
                                [
                                    'header' => '',
                                    'value' => function(){
                                        return Html::tag('i','',['class' => 'icon-move']);
                                    },
                                    'format' => 'html'
                                ],
                                [
                                    'attribute' => 'name',
                                    'header' => 'Название',
                                    'value' => function ($model) {
                                        return $model->publish ? $model->name : Html::tag('s',$model->name);
                                    },
                                    'format' => 'html'
                                ],
                                'alias',
                                [
                                    'attribute' => 'date',
                                    'header' => 'Дата последнего редактирования',
                                    'value' => function ($model) {
                                        return Yii::$app->formatter->asDate($model->updated_at);
                                    },
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
