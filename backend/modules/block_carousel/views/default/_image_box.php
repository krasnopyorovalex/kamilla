<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model \common\models\BlockCarousel */
?>
<div class="box-content">
    <div id="thumbs">
        <?= Html::ul($model->blockCarouselImages, ['item' => function($item) {
            $actions = Html::tag('i','',['class' => 'icon-move']) .
                       Html::tag('i','',['class' => 'icon-edit', 'data-toggle' => 'modal', 'href' => '#edit-image', 'data-link' => Url::toRoute(['default/image-edit', 'id' => $item['id']])]) .
                       Html::tag('i','',['class' => 'icon-remove', 'data-id' => $item['id'], 'data-link' => Url::toRoute(['default/image-remove', 'id' => $item['id']])]);
            return Html::tag(
                'li',
                Html::a(Html::img('@blocks_carousel/'.$item['block_carousel_id'].'/'.$item['basename'].'_250.'.$item['ext']),
                    Url::to('@blocks_carousel/'.$item['block_carousel_id'].'/'.$item['basename'].'.'.$item['ext']),[
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