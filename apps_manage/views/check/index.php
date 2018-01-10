<?php
use yii\helpers\Url;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>领先大酒店</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="<?php echo Yii::$app->request->baseUrl ?>/js/libs/jquerymobile/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl ?>/css/index.css">
    <script src="<?php echo Yii::$app->request->baseUrl ?>/js/libs/jquery/jquery-1.11.3.js"></script>
    <script
        src="<?php echo Yii::$app->request->baseUrl ?>/js/libs/jquerymobile/jquery.mobile-1.4.5.min.js"></script>


</head>
<body>


<div data-role="page">
    <div data-role="header" data-position="fixed" data-tap-toggle="false">

        <h1>领先大酒店</h1>
        <a href="#" data-role="button" class="ui-btn-left" data-iconpos="notext" data-icon="bars">返回</a>
        <a href="#anylink" data-role="button" class="ui-btn-right" data-iconpos="notext" data-icon="refresh">刷新</a>

    </div>

    <div data-role="content" class="guest">


        <div data-role="tabs" id="tabs">
            <div data-role="navbar">
                <ul>
                    <li><a href="#one" data-ajax="false" class="ui-btn-active">在住报告</a></li>
                    <li><a href="#two" data-ajax="false">今日离店</a></li>
                    <li><a href="#three" data-ajax="false">昨日离店</a></li>
                </ul>
            </div>
            <div id="one" class="ui-body-d ui-content">
                <div class="house"> 在住间数：<?php echo $now_check_in_count ?>间 &nbsp;&nbsp;
                    房价合计：<?php echo $now_check_in_price_total ?>元
                </div>
                <div class="ui-grid-c wid t1">
                    <div class="ui-block-a">
                        房号
                    </div>
                    <div class="ui-block-b">
                        姓名
                    </div>
                    <div class="ui-block-c">
                        房价
                    </div>
                    <div class="ui-block-d">
                        低离时间
                    </div>
                </div>

                <?php foreach ($now_check_in as $v) : ?>
                    <div class="a">
                        <a href="<?php echo Url::to(['check/detail', 'id' => $v['checkin_id'], 'type' => 'one']) ?>"
                           target="_top">
                            <div class="ui-block-a">
                                <?php echo $v['room_no'] ?>
                            </div>
                            <div class="ui-block-b">
                                <?php echo $v['name'] ?>
                            </div>
                            <div class="ui-block-c">
                                <?php echo $v['real_price'] ?>
                            </div>
                            <div class="ui-block-d">
                                <?php echo date("m/d", $v['checkin_time']) . '-' . date("m/d", $v['checkout_time']) ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div id="two">

                <div class="house"> 今日：<?php echo $today_check_out_total_amount ?>
                    元&nbsp; <?php echo $today_check_out_night_count ?>间夜
                    &nbsp;<?php echo $today_check_out_avg ?> 元/间夜
                </div>

                <div class="ui-grid-c wid t1">
                    <div class="ui-block-a">
                        房号
                    </div>
                    <div class="ui-block-b">
                        姓名
                    </div>
                    <div class="ui-block-c">
                        间夜
                    </div>
                    <div class="ui-block-d">
                        总消费
                    </div>
                </div>

                <?php foreach ($today_check_out as $k => $v) : ?>
                    <div class="b">
                        <a href="<?php echo Url::to(['check/detail', 'id' => $v['checkin_id'], 'type' => 'two']) ?>"
                           target="_top">
                            <div class="ui-block-a">
                                <?php echo $v['room_no'] ?>
                            </div>
                            <div class="ui-block-b">
                                <?php echo $v['name'] ?>
                            </div>
                            <div class="ui-block-c">
                                <?php echo $v['night_count'] ?>
                            </div>
                            <div class="ui-block-d">
                                <?php echo $v['total_amount'] ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>


            </div>
            <div id="three">
                <div class="house"> 本月：<?php echo $month_check_out_total ?>元&nbsp;
                    昨日：<?php echo $yestoday_check_out_total_amount ?>
                    元 <?php echo $yestoday_check_out_total_amount ?>间夜 <?php echo $yestoday_check_out_total_amount ?>
                    元/间夜
                </div>
                <div class="ui-grid-c wid t1">
                    <div class="ui-block-a">
                        房号
                    </div>
                    <div class="ui-block-b">
                        姓名
                    </div>
                    <div class="ui-block-c">
                        间夜
                    </div>
                    <div class="ui-block-d">
                        总消费
                    </div>
                </div>
                <?php foreach ($yestoday_check_out as $k => $v) : ?>
                    <div class="c">
                        <a href="<?php echo Url::to(['check/detail', 'id' => $v['checkin_id'], 'type' => 'three']) ?>"
                           target="_top">
                            <div class="ui-block-a">
                                <?php echo $v['room_no'] ?>
                            </div>
                            <div class="ui-block-b">
                                <?php echo $v['name'] ?>
                            </div>
                            <div class="ui-block-c">
                                <?php echo $v['night_count'] ?>
                            </div>
                            <div class="ui-block-d">
                                <?php echo $v['total_amount']; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div data-role="footer" data-position="fixed" data-id="footernav">
        <div data-role="navbar">
            <ul>
                <?php if (in_array(1, Yii::$app->session['rights'])): ?>
                    <li><a href="<?php echo Url::to(['revenue/index']) ?>" data-icon="calendar" target="_top">营收</a>
                    </li>
                <?php endif; ?>
                <?php if (in_array(2, Yii::$app->session['rights'])): ?>
                    <li><a href="<?php echo Url::to(['live/index1']) ?>" data-icon="home" target="_top">实况</a></li>
                <?php endif; ?>
                <?php if (in_array(3, Yii::$app->session['rights'])): ?>
                    <li><a href="<?php echo Url::to(['check/index']) ?>" data-icon="user" target="_top"
                           class="ui-btn-active ui-state-persist">客人</a></li>
                <?php endif; ?>
                <?php if (in_array(4, Yii::$app->session['rights'])): ?>
                    <li><a href="<?php echo Url::to(['shift/index']) ?>" data-icon="bullets" target="_top">交班</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    //隔行变色
    $(".a:even").addClass("ui-grid-c wid t2");
    $(".a:odd").addClass("ui-grid-c wid");

    $(".b:even").addClass("ui-grid-c wid t2");
    $(".b:odd").addClass("ui-grid-c wid");

    $(".c:even").addClass("ui-grid-c wid t2");
    $(".c:odd").addClass("ui-grid-c wid");
</script>

</body>
</html>