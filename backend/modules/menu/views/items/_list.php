<?php
/* @var $this yii\web\View */
/* @var $model common\models\MenuItems */
/* @var $className yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\MenuItems;

?>
<?= Html::beginTag('ol',['class' => $className])?>
    <?php foreach ($model as $item): ?>
        <?= Html::beginTag('li',['id' => 'item_' . $item['id']]);?>
        <?= Html::tag('div',Html::tag('div',$item['name'], ['class' => 'item_name']) .
            Html::tag('div',$item['link'],['class' => 'center-block']) .
            Html::tag('div',Html::a(Html::tag('i','',['class' => 'icon-pencil']), Url::toRoute(['edit-item','id' => $item['id']])) .
                Html::a(Html::tag('i','',['class' => 'icon-remove']), Url::toRoute(['delete-item','id' => $item['id']])),[
                'class' => 'actions'
            ])
        )?>

        <?php if($list = MenuItems::find()->where(['parent_id' => $item['id']])->orderBy('pos')->asArray()->all()):?>
            <?= $this->render('_list',[
                'model' => $list,
                'className' => ''
            ])?>
        <?php endif;?>
    <?= Html::endTag('li')?>

    <?php endforeach; ?>
<?= Html::endTag('ol')?>