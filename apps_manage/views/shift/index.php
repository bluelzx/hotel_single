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

    <div data-role="content" class="shift guest">

        <div class="house" style=" text-align:right; font-weight:bold">本月上缴合计：<?php echo $sj_total['sj'] ?>元</div>

        <div class="ui-grid-b  t1">
            <div class="ui-block-a">
                班次
            </div>
            <div class="ui-block-b">
                上缴
            </div>
            <div class="ui-block-c">
                下放
            </div>

        </div>

        <?php foreach ($list as $v): ?>
            <div class="ui-grid-b  t2">
                <div class="ui-block-a">
                    <?php echo $v['cdate'] ?>
                </div>
                <div class="ui-block-b">
                    <?php echo $v['sj'] ?>
                </div>
                <div class="ui-block-c">
                    <?php echo $v['xf'] ?>
                </div>
            </div>
            <?php foreach ($v['items'] as $item) : ?>
                <a href="<?php echo \yii\helpers\Url::to(['shift/detail', 'id' => $item['id']]) ?>" style="color:#333"
                   target="_top">
                    <div class="ui-grid-b ">
                        <div class="ui-block-a">
                            <?php echo $item['class_name'] ?>
                        </div>
                        <div class="ui-block-b">
                            <?php echo $item['sj'] ?>
                        </div>
                        <div class="ui-block-c">
                            <?php echo $item['xf'] ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endforeach; ?>
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