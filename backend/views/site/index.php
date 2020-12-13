<div class="container site-index">
    <div class="action-nav-normal action-nav-line">
        <div class="row action-nav-row">
            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/pages/default/index'])?>" title="Страницы">
                    <i class="icon-file-alt"></i>
                    <span>Страницы</span>
                </a>
            </div>

            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/reviews/default/index'])?>" title="Отзывы">
                    <i class="icon-comments-alt"></i>
                    <span>Отзывы</span>
                </a>
            </div>

            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/news/default/index'])?>" title="Новости">
                    <i class="icon-th-list"></i>
                    <span>Новости</span>
                </a>
            </div>

            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/articles/default/index'])?>" title="Статьи">
                    <i class="icon-list-alt"></i>
                    <span>Статьи</span>
                </a>
            </div>

            <div class="col-sm-2 action-nav-button">
                <a href="<?= \yii\helpers\Url::toRoute(['/form/default/index'])?>" title="Формы">
                    <i class="icon-edit"></i>
                    <span>Формы</span>
                </a>
            </div>

        </div>
    </div>
</div>