<?php
use apps_wechat\assets\AppAsset;
use yii\helpers\Url;

AppAsset::addScript($this, '@web/static/js/share/jquery.flexslider-min.js');
AppAsset::addScript($this, '@web/static/js/wap/index.js');
?>
<div data-role="page">
    <div data-role="header" data-position="fixed" data-tap-toggle="false">
        <h1>酒店详情</h1>
        <a href="#" data-role="button" class="ui-btn-left" data-iconpos="notext" data-icon="back" data-rel="back">返回</a>
        <a href="<?php echo Url::to(['home/index']) ?>" data-role="button" class="ui-btn-right" data-iconpos="notext"
           data-icon="home"
           target="_top">主页</a>

    </div>

    <div data-role="content" class="hotel">


        <div class="flexslider">
            <ul class="slides">
                <li><img src="static/img/1.jpg"/></li>
                <li><img src="static/img/2.jpg"/></li>
                <li><img src="static/img/3.jpg"/></li>
                <li><img src="static/img/4.jpg"/></li>
            </ul>
        </div>

        <div class="clear"></div>

        <div class="hotel_list">


            <ul data-role="listview" data-inset="true">
                <li class="bt"><a href="#"><h2>深圳东部华侨城瀑布酒店</h2><img src="static/img/wifi.png" alt="Germany"
                                                                    class="ui-li-icon">
                        <img src="static/img/parking.png" alt="Germany" class="ui-li-icon"> <img
                            src="static/img/fork.png"
                            alt="Germany"
                            class="ui-li-icon"> <img
                            src="static/img/ball.png" alt="Germany" class="ui-li-icon"></a></li>
                <li><a href="#"><img src="static/img/Location.png" alt="Germany" class="ui-li-icon">盐田区大梅沙东部华侨城大侠谷(山脚下）</a>
                </li>
                <li><a href="#"><img src="static/img/phone.png" alt="Great Britain" class="ui-li-icon">075525289999</a>
                </li>

            </ul>

        </div>


        <div class="dates">
            <div class="ui-grid-a">
                <div class="ui-block-a"><img src="static/img/bed.png"> 入住日期：</div>
                <div class="ui-block-b"><input class="ui-input-text ui-body-c" name="date" id="date"
                                               value="<?php echo $startDate ?>"
                                               type="date" data-mini="true"></div>
            </div>

            <div class="ui-grid-a">
                <div class="ui-block-a"><img src="static/img/Luggage.png"> 离店日期：</div>
                <div class="ui-block-b"><input class="ui-input-text ui-body-c" name="date" id="date"
                                               value="<?php echo $endDate ?>"
                                               type="date" data-mini="true"></div>
            </div>
            <a href="#" data-role="button" class="btn1" style="width:80%; margin:0 auto">查 询</a>
        </div>
        <ul data-role="listview">
            <?php foreach ($list as $item): ?>
                <li>
                    <div class="left wid1" data-id="<?php echo $item['id'] ?>"><h2><?php echo $item['name'] ?></h2>
                    </div>
                    <div class="right wid2" data-id="<?php echo $item['id'] ?>"><span
                            class="price">￥<span><?php echo $item['roomTypes']['cprice'] ?></span></span><a
                            href="<?php echo Url::to(['order/booking', 'room_type_id' => $item['id']]) ?>"
                            data-role="button"
                            data-inline="true"
                            class="btn1">预定</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <div data-role="collapsible" data-collapsed-icon="carat-d" data-expanded-icon="carat-u" class="notice">
            <h4>酒店公告</h4>
            <p>深圳东部华侨城瀑布酒店</p>
        </div>
    </div>


    <div class="footer">Copyright©深圳市领先智能科技有限公司</div>


    <?php foreach ($list as $item): ?>
        <div data-role="popup" id="popupDialog<?php echo $item['id'] ?>" data-overlay-theme="b" data-theme="b"
             data-dismissible="false"
             style="max-width:400px;">
            <div data-role="header" data-theme="a">
                <h1>豪华双人房</h1>
            </div>
            <div role="main" class="ui-content windows">
                <?php foreach ($item['attrs'] as $k => $v): ?>
                    <p><span><?php echo $k . '：' . $v; ?></span></p>
                <?php endforeach; ?>
                <p><img src="static/img/4.jpg" style="width:auto; height:8em; border:0.5em solid #fff"></p>

                <div class="price"><span class="price">￥<span><?php echo $item['roomTypes']['cprice'] ?></span></span>门市价：<span
                        style="text-decoration:line-through;">￥<?php echo $item['roomTypes']['oprice'] ?></span></div>


                <div class="btn2">
                    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">取消</a>
                    <a href="<?php echo Url::to(['order/booking', 'room_type_id' => $item['id']]) ?>"
                       class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">预定</a>
                </div>


            </div>
        </div>
    <?php endforeach; ?>

</div>
