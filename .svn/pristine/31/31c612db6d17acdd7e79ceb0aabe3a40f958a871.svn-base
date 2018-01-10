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
        <a href="#anylink" data-role="button" class="ui-btn-right" data-iconpos="notext" data-icon="refresh">刷新</a>
    </div>
    <div data-role="content" class="live">
        <div class="house">
            <div class="totals"><a href="<?php echo Url::to(['revenue/index'], true) ?>" target="_top"> <span
                        style="color:#999">营收</span></a> <a
                    href="<?php echo Url::to(['revenue/history'], true) ?>">历史</a>
            </div>
        </div>
        <div data-role="tabs" id="tabs">
            <div class=" his">
                <ul class="ui-grid-b">
                    <li class="ui-block-a" data-type="yestoday_revenue"><a href="#one" data-ajax="false"
                                                                           data-role="button"><h5>营业额</h5>
                            昨日:<?php echo $turnover['yestoday'] ?><br/>
                            本月:<?php echo $turnover['month'] ?><br/>
                            本年:<?php echo $turnover['year'] ?><br/></a>
                    </li>
                    <li class="ui-block-b" data-type="checkout"><a href="#two" data-ajax="false" data-role="button"><h5>
                                收款</h5>
                            昨日:<?php echo $checkout['yestoday'] ?><br/>
                            本月:<?php echo $checkout['month'] ?><br/>
                            本年:<?php echo $checkout['year'] ?><br/></a>
                    </li>
                    <li class="ui-block-c" data-type="finance_receivables"><a href="#three" data-ajax="false"
                                                                              data-role="button"><h5>财务应收</h5>
                            昨日:<?php echo $finance_receivables['yestoday'] ?><br/>
                            本月:<?php echo $finance_receivables['month'] ?><br/>
                            本年:<?php echo $finance_receivables['year'] ?><br/></a>
                    </li>
                    <li class="ui-block-a" data-type="house_sale"><a href="#four" data-ajax="false" data-role="button">
                            <h5>售房数</h5>
                            昨日:<?php echo $house_sale['yestoday'] ?><br/>
                            本月:<?php echo $house_sale['month'] ?><br/>
                            本年:<?php echo $house_sale['year'] ?><br/></a>
                    </li>
                    <li class="ui-block-b" data-type="occupancy_rate"><a href="#five" data-ajax="false"
                                                                         data-role="button"><h5>出租率</h5>
                            昨日:<?php echo $occupancy_rate['yestoday'] ?><br/>
                            本月:<?php echo $occupancy_rate['month'] ?><br/>
                            本年:<?php echo $occupancy_rate['year'] ?><br/></a>
                    </li>
                    <li class="ui-block-c" data-type="average_house_price"><a href="#six" data-ajax="false"
                                                                              data-role="button"><h5>平均房价</h5>
                            昨日:<?php echo $average_house_price['yestoday'] ?><br/>
                            本月:<?php echo $average_house_price['month'] ?><br/>
                            本年:<?php echo $average_house_price['year'] ?><br/></a>
                    </li>
                </ul>
            </div>
            <div class="ui-body-d ui-content lishi">
                <div class="bili">
                    <h3> 最近七天营业额</h3>
                    <div id="chartbox" style="width:100%;height:250px;"></div>
                </div>
                <div id="divRevenueRecord">

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
<script id="tpl_p_a" type="text/x-handlebars-template">
    <div class="ui-grid-a t1">
        <div class="ui-block-a">
            时间
        </div>
        <div class="ui-block-b">
            平均房价
        </div>
    </div>
    {{#each this}}
    <div class="a">
        <div class="ui-block-a">
            {{stats_date}}
        </div>
        <div class="ui-block-b">
            {{stats_data}}
        </div>
    </div>
    {{/each}}
</script>
<script type="text/javascript">
    var site_root = '<?php echo Yii::$app->params['site_root']; ?>';
</script>
<script src="<?php echo Yii::$app->request->baseUrl ?>/js/share/handlebars-v2.0.0.js?v=<?php echo rand(1, 1000); ?>"
<script src="<?php echo Yii::$app->request->baseUrl ?>/js/wap/base.js"
        type="text/javascript"></script>
<script src="<?php echo Yii::$app->request->baseUrl ?>/js/wap/wap-api.js"
        type="text/javascript"></script>

<script type="text/javascript">
    $(function () {
        loadData('yestoday_revenue');

        $('.ui-grid-b li').on('click', function () {
            var type = $(this).attr('data-type');
            loadData(type);
        });
    });

    function loadData(type) {
        var tmpltext = Handlebars.compile($("#tpl_p_a").html());
        api.Revenue.sevenhistory({
            data: {type: type},
            succ: function (data) {
                if (data.errcode == 0) {
                    $("#divRevenueRecord").html(tmpltext(data.revenue_record));
                    changeTrColor();
                } else {
                    alert(data.errmsg);
                }
            }
        });
    }

    function changeTrColor() {
        //隔行变色
        $(".a:even").addClass("ui-grid-a t2");
        $(".a:odd").addClass("ui-grid-a");
    }
</script>
</body>
</html>