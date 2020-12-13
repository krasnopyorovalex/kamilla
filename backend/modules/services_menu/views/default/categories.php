<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\ServicesMenuCategories */
/* @var $servicesMenu common\models\ServicesMenu */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = ['label' => $this->context->module->params['name'], 'url' => Url::toRoute(['/services_menu'])];
$this->params['breadcrumbs'][] = $servicesMenu->name;
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
                                    'tableOptions' => ['class' => 'table responsive'],
                                    'columns' => [
                                        'name',
                                        'slogan',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => 'Действия',
                                            'template' => '{update} {categories-items} {delete}',
                                            'buttons' => [
                                                'update' => function($url){
                                                    return Html::a(Html::tag('i','',['class' => 'icon-pencil']), str_replace('services_menu', 'services_menu_categories' ,$url),[
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => 'Редактировать'
                                                    ]);
                                                },
                                                'categories-items' => function($url){
                                                    return Html::a(Html::tag('i','',['class' => 'icon-list-ul']), $url,[
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => 'Категории'
                                                    ]);
                                                },
                                                'delete' => function($url){
                                                    return Html::a(Html::tag('i','',['class' => 'icon-remove']), str_replace('services_menu', 'services_menu_categories' ,$url),[
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => 'Удалить'
                                                    ]);
                                                }
                                            ],
                                        ],
                                    ],
                                ]);
                                echo Html::tag('div', Html::a('Добавить', Url::toRoute(["/services_menu_categories/add?services_menu_id=" . $servicesMenu->id]), ['class' => 'btn btn-blue']),[
                                    'class' => 'padded'
                                ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
