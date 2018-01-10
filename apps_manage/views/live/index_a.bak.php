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


</head>
<body>
<div data-role="page">
    <div data-role="header" data-position="fixed" data-tap-toggle="false">

        <h1>领先大酒店</h1>
        <a href="#" data-role="button" class="ui-btn-left" data-iconpos="notext" data-icon="bars">返回</a>
        <a href="#anylink" data-role="button" class="ui-btn-right" data-iconpos="notext" data-icon="refresh">刷新</a>

    </div>

    <div data-role="content" class="live">


        <div class="house">
            <div class="totals"><a href="<?php echo Url::to(['live/index1'], true) ?>" target="_top">
                    <span>房号</span></a>
                <a href="<?php echo Url::to(['live/index2'], true) ?>"
                   target="_top"
                   style="color:#999">房型</a>
            </div>
            今日入住率：40% 房费：1118.0元
        </div>


        <div data-role="tabs" id="tabs">
            <div class="">
                <ul class="ui-grid-b">
                    <li class="ui-block-a"><a href="#one" data-ajax="false" data-role="button" class="grey">空房<br/><span
                                id="tab_one"></span>
                            (间)</a></li>
                    <li class="ui-block-b "><a href="#two" data-ajax="false" data-role="button"
                                               class="black">脏房<br/><span
                                id="tab_two"></span>
                            (间)</a></li>
                    <li class="ui-block-c"><a href="#three" data-ajax="false" data-role="button"
                                              class="green">住人<br/><span
                                id="tab_three"></span>
                            (间) </a></li>
                    <li class="ui-block-a"><a href="#four" data-ajax="false" data-role="button"
                                              class="yellow">维修<br/><span
                                id="tab_four"></span>
                            (间)</a></li>
                    <li class="ui-block-b"><a href="#five" data-ajax="false" data-role="button"
                                              class="purple">预抵<br/><span
                                id="tab_five"></span>
                            (间)</a></li>
                    <li class="ui-block-c"><a href="#six" data-ajax="false" data-role="button" class="alls">自用<br/><span
                                id="tab_six"></span>
                            (间)</a></li>
                </ul>
            </div>

            <div id="one">
            </div>
            <div id="two">
            </div>
            <div id="three">
            </div>
            <div id="four">
            </div>
            <div id="five">
            </div>
            <div id="six">
            </div>

            <div id="seven">
            </div>
        </div>

        <script id="tpl_p_a" type="text/x-handlebars-template">
            <div class="ui-grid-d lives">
                {{#each this}}
                <a href="desc.html" data-role="button" target="_top" class="grey">{{room_no}}</a>
                {{/each}}
            </div>
        </script>

        <script id="tpl_p_b" type="text/x-handlebars-template">
            <div class="ui-grid-d lives">
                {{#each this}}
                <a href="desc.html" data-role="button" target="_top" class="black">{{room_no}}</a>
                {{/each}}
            </div>
        </script>

        <script id="tpl_p_c" type="text/x-handlebars-template">
            <div class="ui-grid-d lives">
                {{#each this}}
                <a href="desc.html" data-role="button" target="_top" class="green">{{room_no}}</a>
                {{/each}}
            </div>
        </script>

        <script id="tpl_p_d" type="text/x-handlebars-template">
            <div class="ui-grid-d lives">
                {{#each this}}
                <a href="desc.html" data-role="button" target="_top" class="yellow">{{room_no}}</a>
                {{/each}}
            </div>
        </script>

        <script id="tpl_p_e" type="text/x-handlebars-template">
            <div class="ui-grid-d lives">
                {{#each this}}
                <a href="desc.html" data-role="button" target="_top" class="purple">{{room_no}}</a>
                {{/each}}
            </div>
        </script>

        <script id="tpl_p_f" type="text/x-handlebars-template">
            <div class="ui-grid-d lives">
                {{#each this}}
                <a href="desc.html" data-role="button" target="_top" class="alls">{{room_no}}</a>
                {{/each}}
            </div>
        </script>

        <script type="text/javascript">
            var site_root = '<?php echo Yii::$app->params['site_root']; ?>';
        </script>
        <script
            src="<?php echo Yii::$app->request->baseUrl ?>/js/share/handlebars-v2.0.0.js?v=<?php echo rand(1, 1000); ?>"
        <script src="<?php echo Yii::$app->request->baseUrl ?>/js/wap/base.js"
                type="text/javascript"></script>
        <script src="<?php echo Yii::$app->request->baseUrl ?>/js/wap/wap-api.js"
                type="text/javascript"></script>

        <script type="text/javascript">
            $(function () {
                loadData();
            });

            function loadData() {
                var tmpltext_a = Handlebars.compile($("#tpl_p_a").html());
                var tmpltext_b = Handlebars.compile($("#tpl_p_b").html());
                var tmpltext_c = Handlebars.compile($("#tpl_p_c").html());
                var tmpltext_d = Handlebars.compile($("#tpl_p_d").html());
                var tmpltext_e = Handlebars.compile($("#tpl_p_e").html());
                var tmpltext_f = Handlebars.compile($("#tpl_p_f").html());

                api.Live.checkInfo({
                    data: {},
                    succ: function (data) {
                        if (data.errcode == 0) {
                            //房型类型总数统计
                            $("#tab_one").html(data.live.empty_room.room_count);
                            $("#tab_two").html(data.live.dirty_room.room_count);
                            $("#tab_three").html(data.live.living_room.room_count);
                            $("#tab_four").html(data.live.maintain_room.room_count);
                            $("#tab_five").html(data.live.arrival_room.room_count);
                            $("#tab_six").html(data.live.personal_use_room.room_count);

                            //房号填充
                            $("#one").html(tmpltext_a(data.live.empty_room.room_list));
                            $("#two").html(tmpltext_b(data.live.dirty_room.room_list));
                            $("#three").html(tmpltext_c(data.live.living_room.room_list));
                            $("#four").html(tmpltext_d(data.live.maintain_room.room_list));
                            $("#five").html(tmpltext_e(data.live.arrival_room.room_list));
                            $("#six").html(tmpltext_f(data.live.personal_use_room.room_list));
                        } else {
                            alert(data.errmsg);
                        }
                    }
                });
            }
        </script>
</body>
</html>