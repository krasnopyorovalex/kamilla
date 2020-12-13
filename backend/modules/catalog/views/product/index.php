<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\Category */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\components\IconHelper;

$this->params['breadcrumbs'][] = ['label' => $this->context->module->params['name'], 'url' => Url::toRoute(['/'.$this->context->module->id])];
$this->params['breadcrumbs'][] = 'Товары';
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title">Товары</span></div>
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
                                        return $model->publish ? $model->name : Html::tag('s',$model->name);
                                    },
                                    'format' => 'html'
                                ],
                                [
                                    'attribute' => 'category_id',
                                    'header' => 'Категория',
                                    'value' => 'category.name'
                                ],
                                'alias',
                                [
                                    'attribute' => 'publish',
                                    'header' => 'Публикация',
                                    'value' => function ($model) {
                                        return IconHelper::status($model->publish);
                                    },
                                    'format' => 'html'
                                ],
                                [
                                    'attribute' => 'updated_at',
                                    'header' => 'Обновлена',
                                    'value' => function ($model) {
                                        return Yii::$app->formatter->asRelativeTime($model->updated_at);
                                    },
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Действия',
                                    'template' => '{update-product} {delete-product}',
                                    'buttons' => [
                                        'update-product' => function($url){
                                            return Html::a(Html::tag('i','',['class' => 'icon-pencil']), $url,[
                                                'rel' => 'tooltip',
                                                'data-original-title' => 'Редактировать'
                                            ]);
                                        },
                                        'delete-product' => function($url){
                                            return Html::a(Html::tag('i','',['class' => 'icon-remove']), $url,[
                                                'rel' => 'tooltip',
                                                'data-original-title' => 'Удалить'
                                            ]);
                                        }
                                    ],
                                ],
                            ],
                        ]);
                        echo Html::tag('div', Html::a('Добавить', Url::toRoute(["/{$this->context->module->id}/product/add-product", 'id' => $model_id]), ['class' => 'btn btn-blue']),[
                            'class' => 'padded'
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
