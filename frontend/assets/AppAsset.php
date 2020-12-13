<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Hind:400,300,500,600|Montserrat:400,700',
        //'https://paymaster.ru/widget/css/widget.css',
        'css/lib/font-awesome.min.css',
        'css/lib/font-hilltericon.css',
        'css/lib/bootstrap.min.css',
        'css/lib/owl.carousel.css',
        'css/lib/jquery-ui.min.css',
        'css/lib/magnific-popup.css',
        'css/lib/settings.css',
        'css/lib/bootstrap-select.min.css',
        'css/lib/jquery.jscrollpane.css',
        'css/lib/datepicker.min.css',
        'css/price/app.min.css',
        'css/style.css',
		'css/custom.css'
    ];
    public $js = [
        'js/lib/jquery-ui.min.js',
        'js/lib/bootstrap.min.js',
        'js/lib/bootstrap-select.js',
        'js/lib/isotope.pkgd.min.js',
        'js/lib/jquery.themepunch.revolution.min.js',
        'js/lib/jquery.themepunch.tools.min.js',
        'js/lib/owl.carousel.js',
        'js/lib/jquery.appear.min.js',
        'js/lib/jquery.countTo.js',
        'js/lib/jquery.countdown.min.js',
        'js/lib/jquery.parallax-1.1.3.js',
        'js/lib/jquery.magnific-popup.min.js',
	'js/lib/stickypricehead.js',
        'js/lib/SmoothScroll.js',
        //'js/lib/jquery.form.min.js',
        //'js/lib/jquery.validate.min.js',
        'js/lib/jquery.jscrollpane.min.js',
        'js/lib/datepicker.min.js',
        //'//paymaster.ru/widget/widget.bundle.js',
        'js/scripts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
