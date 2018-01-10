<?php

namespace apps_wechat\assets;


/**
 * Main frontend application asset bundle.
 */
class AppAsset extends BaseAsset
{
    public $css = [
        'js/libs/jquery.mobile/jquery.mobile-1.4.5.min.css',
        'css/index.css',
        'css/flexslider.css'
    ];
    public $js = [

    ];
    public $jsOptions = [

        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'apps_wechat\assets\JqueryMobileAsset'
    ];


    public static function addScript($view, $jsfile)
    {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'apps_wechat\assets\JqueryMobileAsset', 'position' => \yii\web\View::POS_HEAD]);
    }

    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile)
    {
        $view->registerCssFile($cssfile, null);
    }
}
