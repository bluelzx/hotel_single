<?php
use apps_wechat\assets\AppAsset;
use yii\helpers\Url;

AppAsset::addCss($this, '@web/static/js/libs/mobiscroll/css/mobiscroll.core-2.5.2.css');
AppAsset::addCss($this, '@web/static/js/libs/mobiscroll/css/mobiscroll.animation-2.5.2.css');
AppAsset::addCss($this, '@web/static/js/libs/mobiscroll/css/mobiscroll.android-ics-2.5.2.css');

AppAsset::addScript($this, '@web/static/js/libs/mobiscroll/mobiscroll.android-ics-2.5.2.js');
AppAsset::addScript($this, '@web/static/js/libs/mobiscroll/mobiscroll.core-2.5.2.js');
AppAsset::addScript($this, '@web/static/js/libs/mobiscroll/mobiscroll.core-2.5.2-zh.js');
AppAsset::addScript($this, '@web/static/js/libs/mobiscroll/mobiscroll.datetime-2.5.1.js');
AppAsset::addScript($this, '@web/static/js/libs/mobiscroll/mobiscroll.datetime-2.5.1-zh.js');

?>

<div data-role="page">
    <div data-role="header" data-position="fixed" data-tap-toggle="false">
        <h1>酒店预定</h1>
        <a href="#" data-role="button" class="ui-btn-left" data-iconpos="notext" data-icon="back" data-rel="back">返回</a>
        <a href="home.html" data-role="button" class="ui-btn-right" data-iconpos="notext" data-icon="home"
           target="_top">主页</a>
    </div>
    <form id="createOrder" action="<?php echo Url::to(['order/create-order']) ?>" method="POST">
        <input type="hidden" name="room_type_id" value="<?php echo $room_type_id ?>">
        <div data-role="content">
            <img src="img/4.jpg" style="width:100%; height:10em">
            <div class="pay">
                <ul data-role="listview" class="wd">
                    <li>
                        <h2><?php echo $model['name'] ?></h2>
                        入住 <?php echo Yii::$app->session['check_in_time'] ?>
                        离店 <?php echo Yii::$app->session['check_out_time'] ?> (<span
                            class="blue">住<?php echo \apps_wechat\components\Common::diffBetweenTwoDays(Yii::$app->session['check_out_time'], Yii::$app->session['check_in_time']) ?>
                            晚</span>)
                    </li>
                </ul>
                <ul data-role="listview" class="wd">
                    <li><a href="#"><span class="wid3">房间数</span>
                            <select name="room_count" id="room_count" class="blue" onclick="changeSelect(this)">
                                <option value="1">1间</option>
                                <option value="2">2间</option>
                                <option value="3">3间</option>
                            </select>
                        </a></li>
                    <li><span class="wid3">预抵时间</span> <span class="wid4"><input type="text" name="arrival_time"
                                                                                 id="arrival_time"
                                                                                 readonly=""
                                                                                 placeholder="请选择"></span>
                    </li>
                    <li><span class="wid3">联系人</span> <span class="wid4"><input value="小明" type="text"
                                                                                id="real_name" name="real_name"></span>
                    </li>
                    <li><span class="wid3">手机号 </span> <span class="wid4"><input value="18678787653" type="text"
                                                                                 id="phone" name="phone"></span>
                    </li>
                    <li><span class="wid3">身份证</span><span class="wid4"><input value="" type="text"
                                                                               name="id_card"></span>
                    </li>
                    <li><a href="#"><span class="wid3">门市价</span> ￥<span
                                id="ms"><?php echo intval($model['roomTypes']['oprice']) ?></span></a></li>
                    <li><a href="#"><span class="wid3">门市会员价 </span> ￥<span
                                id="unit"><?php echo intval($model['roomTypes']['cprice']) ?> </span></a>
                    </li>
                    <li><a href="#"><span class="wid3">预定价</span> <span id="op"
                                                                        class="red "> ￥<?php echo intval($model['roomTypes']['cprice']) ?></span>
                        </a></li>
                    <li><a href="#"><span class="wid3">为你节省</span> <span id="yh"
                                                                         class="green ">￥<?php echo (intval($model['roomTypes']['oprice']) - intval($model['roomTypes']['cprice'])) ?></span>
                        </a></li>
                    <li><span class="wid3">其它要求</span>
                        <span class="wid4"><input placeholder="请在此处填写您的特殊要求" value="" type="text"
                                                  data-role="none"></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="fix">
            <div class="text"> 总价：￥<span id="priceSum"><?php echo intval($model['roomTypes']['cprice']) ?></span></div>
            <a href="#" class="btn3 right" onclick="createOrder()">提交订单</a>
        </div>
    </form>
</div>

<script type="text/javascript">

    //获得SELECT的值changeSelect
    function changeSelect(obj) {
        var unit = '<?php echo $model['roomTypes']['cprice'] ?>';//单价
        var ms = '<?php echo $model['roomTypes']['oprice'] ?>';
        var op = '<?php echo $model['roomTypes']['cprice'] ?>';
        var num = parseInt(obj.options[obj.selectedIndex].text);
        $("#ms").html(ms * num);
        $("#op").html("￥" + op * num);
        $("#yh").html("￥" + (ms - op) * num);
        $("#priceSum").html(unit * num);
    }


    var flag = 0;
    function createOrder() {
        if (flag == 1) {
            return false;
        }
        var name = document.getElementById("real_name").value.replace(/[ ]/g, "");
        var mobile = document.getElementById("phone").value.replace(/[ ]/g, "");

        if (name == "") {
            alert("名字不能为空！");
            return false;
        }

        if (mobile == "") {
            alert("手机号不能为空！");
            return false;
        }

        var re = new RegExp(/^(13[0-9]|15[0123456789]|18[0123456789]|14[57]|17[0678])[0-9]{8}$/);

        if (!re.test(mobile)) {
            alert("手机格式不正确！");
            return false;
        }
        flag = 1;
        document.getElementById("createOrder").submit();
    }

    //日历控件设置
    $(function () {
        var currYear = (new Date()).getFullYear();
        var opt = {};
        opt.date = {preset: 'date'};
        //opt.datetime = { preset : 'datetime', minDate: new Date(2012,3,10,9,22), maxDate: new Date(2014,7,30,15,44), stepMinute: 5  };
        opt.datetime = {preset: 'datetime'};
        opt.time = {preset: 'time'};
        opt.default = {
            theme: 'android-ics light', //皮肤样式
            display: 'modal', //显示方式
            mode: 'scroller', //日期选择模式
            lang: 'zh',
            startYear: currYear, //开始年份
            endYear: currYear + 10 //结束年份
        };

        //$("#appTime").mobiscroll(optTime).time(optTime);

        $("#arrival_time").val("12:00").scroller('destroy').scroller($.extend(opt['time'], opt['default']));//预抵时间
        //$("#outTime").val("12:00").scroller('destroy').scroller($.extend(opt['time'], opt['default']));//预离时间

        //$("#appDate01").val(GetDateStr(1)).scroller('destroy').scroller($.extend(opt['date'], opt['default']));//离店日期
        //var optDateTime = $.extend(opt['datetime'], opt['default']);
        //var optTime = $.extend(opt['time'], opt['default']);
    });


</script>
