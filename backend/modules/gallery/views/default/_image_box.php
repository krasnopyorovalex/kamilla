<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model \common\models\Gallery */
?>
<div class="box-content">
    <div id="thumbs">
        <?= Html::ul($model->galleryImages, ['item' => function($item) {
            $actions = Html::tag('i','',['class' => 'icon-move']) .
                       Html::tag('i','',['class' => 'icon-edit', 'data-toggle' => 'modal', 'href' => '#edit-image', 'data-link' => Url::toRoute(['default/image-edit', 'id' => $item['id']])]) .
                       Html::tag('i','',['class' => 'icon-remove', 'data-id' => $item['id'], 'data-link' => Url::toRoute(['default/image-remove', 'id' => $item['id']])]) .
                       Html::checkbox('checked['.$item['id'].']',false,['data-id' => $item['id'],'value' => 0]);
            return Html::tag(
                'li',
                Html::a(Html::img('@gallery/'.$item['gallery_id'].'/'.$item['basename'].'_thumb.'.$item['ext']),
                    Url::to('@gallery/'.$item['gallery_id'].'/'.$item['basename'].'.'.$item['ext']),[
                        'data-id' => $item['id']
                    ]).Html::tag('div',$actions,['class' => 'actions']),
                [
                    'class' => $item['publish'] ? '' : 'unpublished',
                    'id' => 'image_' . $item['id']
                ]
            );
        }]) ?>
    </div>

</div>
<div class="clear"></div>