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
        <a href="#" data-role="button" class="ui-btn-left" data-iconpos="notext" data-icon="bars">栏目</a>

    </div>

    <div data-role="content" class="shift guest">

        <div class="rows3"><a href="<?php echo \yii\helpers\Url::to(['check/index', '#' => $_GET['type']]) ?>"
                              data-role="button" data-icon="back" data-rel="back" data-inline="true"
                              class="left" target="_top">返回</a>
            <span class="right"> 入住明细</span>
            <div class="clear"></div>
        </div>


        <div class="ui-grid-a t5">
            <div class="ui-block-a">
                房号： <?php echo $model['room_no'] ?>
            </div>
        </div>

        <div class="ui-grid-a t5">
            <div class="ui-block-a">
                房型：<?php echo $model['room_type'] ?>
            </div>
        </div>

        <div class="ui-grid-a t5">
            <div class="ui-block-a">
                姓名：<?php echo $model['name'] ?>
            </div>
        </div>

        <div class="ui-grid-a t5">
            <div class="ui-block-a">
                房价方案：<?php echo $model['price_plan'] ?>
            </div>
        </div>


        <div class="ui-grid-a t5">
            <div class="ui-block-a">
                房价：<?php echo $model['real_price'] ?>
            </div>
        </div>

        <div class="ui-grid-a t5">
            <div class="ui-block-a">
                入住时间：<?php echo date('Y-m-d H:i:s', $model['checkin_time']) ?>
            </div>
        </div>

        <div class="ui-grid-a t5">
            <div class="ui-block-a">
                预离时间：<?php echo date('Y-m-d H:i:s', $model['checkout_time']) ?>
            </div>
        </div>

        <?php if ($type == 'two' || $type == 'three'): ?>
            <div class="ui-grid-a t5">
                <div class="ui-block-a">
                    间夜：<?php echo $model['night_count'] ?>
                </div>
            </div>
            <div class="ui-grid-a t5">
                <div class="ui-block-a">
                    总消费：<?php echo $model['total_amount'] ?>
                </div>
            </div>
        <?php endif; ?>


    </div>

    <div data-role="footer" data-position="fixed" data-id="footernav" data-tap-toggle="false">
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


</body>
</html>