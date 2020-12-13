<?php
/* @var $this yii\web\View */
/* @var $model common\models\MenuItems */
/* @var $menu_name common\models\Menu */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\NestedSortable;

NestedSortable::register($this);
$this->params['breadcrumbs'][] = ['label' => $this->context->module->params['name'], 'url' => Url::toRoute(['/'.$this->context->module->id])];
$this->params['breadcrumbs'][] = 'Пункты меню';
?>
<div class="pages-default-index container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header"><span class="title">Пункты меню - «<?= $menu_name->name?>»</span></div>
                <div class="box-content padded">

                        <?php if ($model):?>
                            <?= $this->render('_list',[
                                'model' => $model,
                                'className' => 'navigation'
                            ])?>
                        <?php endif; ?>

                        <?= Html::tag('div', Html::a('Добавить', Url::toRoute(["/menu/items/add-item", 'id' => $menu_id]), ['class' => 'btn btn-blue']),[
                                'class' => 'padded'
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
</div>
