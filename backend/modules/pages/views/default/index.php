<?php
/* @var $this yii\web\View */
/* @var $dataProvider common\models\Pages */

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
                <div class="box-header"><span class="title">Информационные страницы</span></div>
                <div class="box-content padded">
                    <div id="dataTables">
                        <?= Html::beginTag('table',['class' => 'table responsive'])?>
                        <tr>
                            <th>Название</th>
                            <th>Alias</th>
                            <th>Публикация</th>
                            <th>Обновлена</th>
                            <th>Действия</th>
                        </tr>
                        <?php if ($dataProvider): ?>
                            <?php foreach ($dataProvider as $dp): ?>
                                <?= $this->render('_tr',['model' => $dp, 'className' => ''])?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?= Html::endTag('table')?>

                        <?= Html::tag('div', Html::a('Добавить', Url::toRoute(["/{$this->context->module->id}/add"]), ['class' => 'btn btn-blue']),[
                            'class' => 'padded'
                        ]);?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</div>
