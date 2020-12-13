<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\ServicesMenuCategoriesItems */
/* @var $servicesMenuCategory common\models\ServicesMenuCategories */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = ['label' => $this->context->module->params['name'], 'url' => Url::toRoute(['/'.$this->context->module->id])];
$this->params['breadcrumbs'][] = ['label' => $servicesMenuCategory->servicesMenu->name, 'url' => Url::toRoute(['/'.$this->context->module->id.'/categories/'.$servicesMenuCategory->servicesMenu->id])];
$this->params['breadcrumbs'][] = $servicesMenuCategory->name;
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title"></span></div>
                <div class="box-content padded">
                    <div id="dataTables">
                        <?php echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'summary' => false,
                                    'tableOptions' => ['class' => 'table responsive'],
                                    'columns' => [
                                        'name',
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => 'Действия',
                                            'template' => '{update} {delete}',
                                            'buttons' => [
                                                'update' => function($url){
                                                    return Html::a(Html::tag('i','',['class' => 'icon-pencil']), str_replace('services_menu','services_menu_categories_items',$url),[
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => 'Редактировать'
                                                    ]);
                                                },
                                                'delete' => function($url){
                                                    return Html::a(Html::tag('i','',['class' => 'icon-remove']), str_replace('services_menu','services_menu_categories_items',$url),[
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => 'Удалить'
                                                    ]);
                                                }
                                            ],
                                        ],
                                    ],
                                ]);
                                echo Html::tag('div', Html::a('Добавить', Url::toRoute(["/services_menu_categories_items/add?services_menu_category_id=" . $servicesMenuCategory->id]), ['class' => 'btn btn-blue']),[
                                    'class' => 'padded'
                                ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
