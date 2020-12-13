<div class="container">
    <div class="row">

        <div class="area-top clearfix">
            <div class="pull-left header">
                <h3 class="title">
                    <i class="icon-dashboard"></i>
                    Панель управления
                </h3>
            </div>

            <ul class="list-inline pull-right sparkline-box">

                <li class="sparkline-row">
                    <h4 class="green"><span>Отзывы</span> <?= \common\models\Reviews::find()->where(['publish' => 0])->count()?></h4>

                    <div class="sparkline big" data-color="green"><!--28,26,13,18,8,6,24,19,3,6,19,6--></div>
                </li>

            </ul>
        </div>
    </div>
</div>