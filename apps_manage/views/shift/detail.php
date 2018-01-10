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

    <div data-role="content" class="class">

        <div class="rows3"><a href="#" data-role="button" data-icon="back" data-rel="back" data-inline="true"
                              class="left" target="_top">返回</a>
            <span class="right"> <?php echo $model['class_name'] ?></span>
            <div class="clear"></div>
        </div>


        <div class="rows2">

            交班时间：<?php echo date('Y-m-d H:i:s', $model['class_date']) ?>


        </div>


        <div class="class1">

            <h2>接手金额：</h2>
            现金：<span><?php echo $model['class_js_xj'] ?></span><br/>
            刷卡留存：<span><?php echo $model['class_js_lc'] ?></span>


            <h2>本班收退：</h2>
            现金：<span><?php echo $model['class_bb_xj'] ?></span><br/>
            刷卡：<span><?php echo $model['class_bb_sk'] ?></span><br/>
            结帐退现金：<span><?php echo $model['class_bb_txj'] ?></span><br/>
            结帐退刷卡：<span><?php echo $model['class_bb_tsk'] ?></span>


            <h2>上缴：</h2>
            现金：<span><?php echo $model['class_sj_xj'] ?></span><br/>
            刷卡：<span><?php echo $model['class_sj_sk'] ?></span>


            <h2>下放：</h2>
            现金：<span><?php echo $model['class_xf_xj'] ?></span><br/>
            刷卡留存：<span><?php echo $model['class_xf_lc'] ?></span>


        </div>

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
                    <li><a href="<?php echo Url::to(['check/index']) ?>" data-icon="user" target="_top">客人</a></li>
                <?php endif; ?>
                <?php if (in_array(4, Yii::$app->session['rights'])): ?>
                    <li><a href="<?php echo Url::to(['shift/index']) ?>" data-icon="bullets" target="_top"
                           class="ui-btn-active ui-state-persist">交班</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>


</body>
</html>