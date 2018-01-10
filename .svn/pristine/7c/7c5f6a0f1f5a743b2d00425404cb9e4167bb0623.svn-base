<?php
use yii\helpers\Url;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>领先大酒店</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="no-cache, no-store, must-revalidate" http-equiv="Cache-Control"/>
    <meta content="no-cache" http-equiv="Pragma"/>
    <meta content="0" http-equiv="Expires"/>
    <link rel="stylesheet"
          href="<?php echo Yii::$app->request->baseUrl ?>/js/libs/jquerymobile/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl ?>/css/index.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl ?>/css/roboto.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->request->baseUrl ?>/css/dhtmlxchart.css"/>
    <script src="<?php echo Yii::$app->request->baseUrl ?>/js/libs/jquery/jquery-1.11.3.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl ?>/js/libs/jquerymobile/jquery.mobile-1.4.5.min.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl ?>/css/dhtmlxchart.js"></script>
    <script src="<?php echo Yii::$app->request->baseUrl ?>/css/testdata.js"></script>
    <script>
        var myLineChart;
        function doOnLoad() {
            myLineChart = new dhtmlXChart({
                view: "spline",
                container: "chartbox",
                value: "#sales#",
                item: {
                    borderColor: "#ffffff",
                    color: "#000000"
                },
                line: {
                    color: "#ff9900",
                    width: 3
                },
                xAxis: {
                    template: "'#year#"
                },
                offset: 0,
                yAxis: {
                    start: 0,
                    end: 100,
                    step: 10,
                    template: function (obj) {
                        return (obj % 20 ? "" : obj)
                    }
                }
            });
            myLineChart.parse(dataset, "json");
        }
    </script>
</head>
<body onload="doOnLoad();">
<div data-role="page">
    <div data-role="header" data-position="fixed" data-tap-toggle="false">
        <h1>领先大酒店</h1>
        <a href="#" data-role="button" class="ui-btn-left" data-iconpos="notext" data-icon="bars">返回</a>
        <a href="<?php echo Url::to(['login/lo'], true) ?>" data-role="button" class="ui-btn-right" style="color:white"
           data-iconpos="notext" >退出</a>
    </div>
    <div data-role="content" class="revenue">
        <div class="rows1">
            <div class="totals"><a href="<?php echo Url::to(['revenue/index'], true) ?>"> <span>营收</span></a> <a
                    href="<?php echo Url::to(['revenue/historys'], true) ?>" style="color:#999"
                    target="_top">历史</a></div>
            <a href="<?php echo Url::to(['revenue/detail', 'type' => 'yestoday_revenue'], true) ?>" target="_top">
                <h2> 昨日营收<span>(元)</span></h2>
                <h1><?php echo $yestoday_revenue ?></h1>
        </div>
        </a>
        <div class="rows2">
            <a href="<?php echo Url::to(['revenue/detail', 'type' => 'yestoday_revenue'], true) ?>" target="_top">
                <h2> 本月累计<span>(元)</span></h2>
                <h1><?php echo $this_month ?></h1>
        </div>
        </a>
        <div class="money">
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'checkout'], true) ?>" target="_top">
                        <h3> 收款<span>(元)</span></h3>

                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $checkout['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $checkout['month'] ?></div>
                    </a>
                </div>
                <div class="ui-block-b">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'guest_accounts'], true) ?>" target="_top">
                        <h3> 宾客帐款<span>(元)</span></h3>
                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $guest_accounts['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $guest_accounts['month'] ?></div>
                    </a>
                </div>
            </div>
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'house_sale'], true) ?>" target="_top">
                        <h3> 售房数<span>(元)</span></h3>
                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $house_sale['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $house_sale['month'] ?></div>
                    </a>
                </div>
                <div class="ui-block-b">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'average_house_price'], true) ?>" target="_top">
                        <h3> 平均房价<span>(元)</span></h3>
                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $average_house_price['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $average_house_price['month'] ?></div>
                    </a>
                </div>
            </div>
            <div class="ui-grid-a ">
                <div class="ui-block-a">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'occupancy_rate'], true) ?>" target="_top">
                        <h3> 入住率 </h3>
                        <div class="days">昨日:&nbsp;&nbsp; <?php echo $occupancy_rate['yestoday'] ?>%<br/>
                            本月:&nbsp;&nbsp;&nbsp; <?php echo $occupancy_rate['month'] ?>%
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="bili">
            <h3> 最近7日入住率(%)</h3>
            <div id="chartbox" style="width:100%;height:250px;"></div>
        </div>
        <div class="money">
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'cash'], true) ?>" target="_top">
                        <h3> 现金<span>(元)</span></h3>
                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $cash['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $cash['month'] ?></div>
                    </a>
                </div>
                <div class="ui-block-b">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'credit_card'], true) ?>" target="_top">
                        <h3> 刷卡<span>(元)</span></h3>
                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $credit_card['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $credit_card['month'] ?></div>
                    </a>
                </div>
            </div>
            <div class="ui-grid-a ">
                <div class="ui-block-a">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'bill'], true) ?>" target="_top">
                        <h3> 挂帐<span>(元)</span></h3>
                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $bill['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $bill['month'] ?></div>
                    </a>
                </div>
                <div class="ui-block-b">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'free'], true) ?>" target="_top">
                        <h3> 免单<span>(元)</span></h3>
                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $free['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $free['month'] ?></div>
                    </a>
                </div>
            </div>
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'membership'], true) ?>" target="_top">
                        <h3>会员卡<span>(元)</span></h3>
                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $membership['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $membership['month'] ?></div>
                    </a>
                </div>
                <div class="ui-block-b">
                    <a href="<?php echo Url::to(['revenue/detail', 'type' => 'other'], true) ?>" target="_top">
                        <h3>其它<span>(元)</span></h3>
                        <div class="days">昨日:&nbsp;&nbsp;<?php echo $other['yestoday'] ?><br/>
                            本月:&nbsp;&nbsp;<?php echo $other['month'] ?></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div data-role="footer" data-position="fixed" data-id="footernav" data-tap-toggle="false">
        <div data-role="navbar">
            <ul>
                <?php if (in_array(1, Yii::$app->session['rights'])): ?>
                    <li><a href="<?php echo Url::to(['revenue/index']) ?>" data-icon="calendar" target="_top"
                           class="ui-btn-active ui-state-persist">营收</a></li>
                <?php endif; ?>
                <?php if (in_array(2, Yii::$app->session['rights'])): ?>
                    <li><a href="<?php echo Url::to(['live/index1']) ?>" data-icon="home" target="_top">实况</a></li>
                <?php endif; ?>
                <?php if (in_array(3, Yii::$app->session['rights'])): ?>
                    <li><a href="<?php echo Url::to(['check/index']) ?>" data-icon="user" target="_top">客人</a></li>
                <?php endif; ?>
                <?php if (in_array(4, Yii::$app->session['rights'])): ?>
                    <li><a href="<?php echo Url::to(['shift/index']) ?>" data-icon="bullets" target="_top">交班</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>