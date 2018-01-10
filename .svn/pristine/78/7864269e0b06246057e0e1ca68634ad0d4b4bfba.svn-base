<?php
use apps_wechat\assets\AppAsset;
use yii\helpers\Url;

AppAsset::addScript($this, '@web/static/js/share/jquery.flexslider-min.js');
?>

<div data-role="page">
    <div data-role="header" data-position="fixed" data-tap-toggle="false">
        <h1>订单支付</h1>
        <a href="#" data-role="button" class="ui-btn-left" data-iconpos="notext" data-icon="back" data-rel="back">返回</a>
    </div>

    <div data-role="content" class="payment">
        <div class="zhifu">
            <div class="ui-grid-a">
                <div class="ui-block-a" style="width:30%"><img src="static/img/check.png"
                                                               style="width:2.5em; height:2em">
                </div>
                <div class="ui-block-b" style="width:70%"><h2>
                        你正在为 <?php echo $model['goods_name'] . ' 住' . $model['room_days'] . '晚' . ' 的订单支付</h2>订单总价为：￥' . $model['totalc_price'] ?>
                </div>
            </div>
        </div>

        <div class="zhifu1">
            <ul data-role="listview" data-inset="true">
                <li data-role="list-divider">预付全额房费￥<?php echo $model['totalc_price'] ?></li>
                <li><a href="#"><img src="static/img/Wechat.png" class="ui-li-icon">微信支付</a></li>
            </ul>
        </div>
    </div>
</div>
