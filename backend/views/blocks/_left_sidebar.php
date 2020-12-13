<div class="primary-sidebar">

    <!-- Main nav -->
    <ul class="nav navbar-collapse collapse navbar-collapse-primary">

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/blocks/default/index'])?>">
                <i class="icon-th-large icon-2x"></i>
                <span>Блоки</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/pages/default/index'])?>">
                <i class="icon-file-alt icon-2x"></i>
                <span>Страницы</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/news/default/index'])?>">
                <i class="icon-th-list icon-2x"></i>
                <span>Новости</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/articles/default/index'])?>">
                <i class="icon-list-alt icon-2x"></i>
                <span>Статьи</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/specials/default/index'])?>">
                <i class="icon-coffee icon-2x"></i>
                <span>Спецпредложения</span>
            </a>
        </li>

        <li class="">
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/reviews/default/index'])?>">
                <i class="icon-comments-alt icon-2x"></i>
                <span>Отызвы</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/form/default/index'])?>">
                <i class="icon-edit icon-2x"></i>
                <span>Формы</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/menu/default/index'])?>">
                <i class="icon-reorder icon-2x"></i>
                <span>Навигация</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/statistic/default/index'])?>">
                <i class="icon-bar-chart icon-2x"></i>
                <span>Статистика</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/services_menu/default/index'])?>">
                <i class="icon-food icon-2x"></i>
                <span>Модуль услуг</span>
            </a>
        </li>

        <li>
            <span class="glow"></span>
            <a href="<?= \yii\helpers\Url::toRoute(['/banners/default/index'])?>">
                <i class="icon-share icon-2x"></i>
                <span>Сквозной баннер</span>
            </a>
        </li>

        <li class="dark-nav">

            <span class="glow"></span>
            <a class="accordion-toggle collapsed " data-toggle="collapse" href="#yJ6h3Npe7C">
                <i class="icon-folder-open-alt icon-2x"></i>
	                    <span>
	                      Каталог
	                      <i class="icon-caret-down"></i>
	                    </span>
            </a>

            <ul id="yJ6h3Npe7C" class="collapse ">

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/rooms/default/index'])?>">
                        <i class="icon-list"></i> Номера
                    </a>
                </li>

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/rooms_attributes/default/index'])?>">
                        <i class="icon-list-ol"></i> Характеристики
                    </a>
                </li>

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/rooms_tabs/default/index'])?>">
                        <i class="icon-columns"></i> Вкладки
                    </a>
                </li>

            </ul>

        </li>

        <li class="dark-nav">

            <span class="glow"></span>
            <a class="accordion-toggle collapsed " data-toggle="collapse" href="#yJ6h3Npe7C23">
                <i class="icon-money icon-2x"></i>
                <span>Прайс<i class="icon-caret-down"></i></span>
            </a>

            <ul id="yJ6h3Npe7C23" class="collapse">

                <li class="">
                    <a href="/_root/price">
                        <i class="icon-list-alt"></i> Значения прайса
                    </a>
                </li>

                <li class="">
                    <a href="/_root/price_attributes">
                        <i class="icon-calendar"></i> Периоды, даты
                    </a>
                </li>

                <li class="">
                    <a href="/_root/price_settings">
                        <i class="icon-cogs"></i> Настройки прайса
                    </a>
                </li>

            </ul>

        </li>

        <li class="dark-nav">

            <span class="glow"></span>
            <a class="accordion-toggle collapsed " data-toggle="collapse" href="#media">
                <i class="icon-dashboard icon-2x"></i>
	                    <span>
	                      Мультимедиа
	                      <i class="icon-caret-down"></i>
	                    </span>
            </a>

            <ul id="media" class="collapse ">

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/gallery/default/index'])?>">
                        <i class="icon-picture"></i> Галерея
                    </a>
                </li>

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/carousel/default/index'])?>">
                        <i class="icon-film"></i> Слайдшоу
                    </a>
                </li>

            </ul>

        </li>

        <li class="dark-nav">

            <span class="glow"></span>
            <a class="accordion-toggle collapsed " data-toggle="collapse" href="#congs">
                <i class="icon-cogs icon-2x"></i>
	                    <span>
	                      Параметры
	                      <i class="icon-caret-down"></i>
	                    </span>
            </a>

            <ul id="congs" class="collapse ">

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/settings/default/index'])?>">
                        <i class="icon-cog"></i>
                        <span>Настройки сайта</span>
                    </a>
                </li>

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/seo_blocks/default/index'])?>">
                        <i class="icon-th-large"></i>
                        <span>SEO-блоки</span>
                    </a>
                </li>

                <li class="">
                    <a href="<?= \yii\helpers\Url::toRoute(['/redirects/default/index'])?>">
                        <i class="icon-exchange"></i> Редиректы
                    </a>
                </li>

            </ul>

        </li>

    </ul>

    <div class="box-content padded">
        <a data-toggle="modal" href="#modal-short_codes" class="btn btn-gray center-block"><i class="icon-info-sign"></i> [Информация]</a>
    </div>

    <div id="modal-short_codes" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Информация о применении вспомогательных элементов</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>1. Для отображения на странице модуля добавьте в область контента:</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>Новости - {news}</li>
                                <li>Отзывы - {guestbook}</li>
                                <li>Статьи - {articles}</li>
                                <li>Таблица цен - {module_price}</li>
                                <li>Спецпредложения - {specials}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Рекомендуем к прочтению - {articles_list}</li>
                                <li>Блок-статистика - {stat}</li>
                                <li>Список номеров - {rooms}</li>
                                <li>Карта сайта - html - {sitemap}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>2. Формы:</h6>
                            <ul>
                                <li>Для добавления выпадающего календаря, создайте input и задайте css-класс date</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <h6>3. Использование плагина scroll-pane:</h6>
                            <ul>
                                <li>Для добавления scroll'а на страницу оберните необходимую часть контента в div с классом <b>.scroll-pane</b></li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <h6>4. Модуль услуг:</h6>
                            <ul>
                                <li>При создании категории модуля услуг необходимо обязательно начать системое название с ключеовго слова <b>services_</b>, дальше по усмотрению</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <h6>5. Виды отображения галерей:</h6>
                            <ol>
                                <li>grid - сетка</li>
                                <li>table - таблица</li>
                                <li>slider - слайдер</li>
                                <li>preview - слайдер с првеью</li>
                            </ol>
                            <p>Ключевое слово в тексте состоит из системного имени галереи, обязательного слова <b>_gallery_</b> и ключевого слова вида для галереи, обернув все фигурными скобками.</p>
                            <p>Пример: <b>{pool_gallery_grid}</b></p>
                            <h6>6. Кнопка - "Получить расчет проживания на e-mail"</h6>
                            <p>Ссылки в контенте - &lt;a href="/get-calculation-form" class="awe-btn awe-btn-13 awe-ajax"&gt;Получить расчет проживания на e-mail&lt;/a&gt;</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-blue" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
</div>
