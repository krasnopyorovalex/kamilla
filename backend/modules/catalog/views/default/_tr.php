<?php
/* @var $this yii\web\View */
/* @var $model common\models\Category */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\components\IconHelper;
?>
<tr class="<?= isset($className) ? $className : ''?>">
    <td><?= $model['publish'] ? $model['name'] : Html::tag('s',$model['name']) ?></td>
    <td><?= $model['alias'] ?></td>
    <td><?= IconHelper::status($model['publish']) ?></td>
    <td><?= Yii::$app->formatter->asRelativeTime($model['updated_at']) ?></td>
    <td>
        <?= Html::a(Html::tag('i','',['class' => 'icon-pencil']), Url::toRoute(['default/update', 'id' => $model['id']]),[
            'rel' => 'tooltip',
            'data-original-title' => 'Редактировать'
        ]);?>
        <?= Html::a(Html::tag('i','',['class' => 'icon-list-ul']), Url::toRoute(['/catalog/product/list', 'id' => $model['id']]),[
            'rel' => 'tooltip',
            'data-original-title' => 'Список товаров'
        ]);?>
        <?= Html::a(Html::tag('i','',['class' => 'icon-remove']), Url::toRoute(['default/delete', 'id' => $model['id']]),[
            'rel' => 'tooltip',
            'data-original-title' => 'Удалить'
        ]);?>
    </td>
</tr>
<?php if (isset($model['categories'])): ?>
    <?php foreach ($model['categories'] as $child):?>
        <?= $this->render('_tr', ['model' => $child, 'className' => 'has_parent'])?>
    <?php endforeach;?>
<?php endif; ?>