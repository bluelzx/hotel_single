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
        <a href="<?php echo Url::to(['live/index1']) ?>" data-role="button" class="ui-btn-right" data-iconpos="notext"
           data-icon="refresh">刷新</a>
    </div>

    <div data-role="content" class="live">


        <div class="house">
            <div class="totals"><a href="<?php echo Url::to(['live/index1'], true) ?>" target="_top">
                    <span>房号</span></a>
                <a href="<?php echo Url::to(['live/index2'], true) ?>"
                   target="_top"
                   style="color:#999">房型</a>
            </div>
            今日入住率：<?php echo $live['ruzhu_rate'] ?> 房费：<?php echo $live['total_amount'] ?>元
        </div>


        <div data-role="tabs" id="tabs">
            <div class="">
                <ul class="ui-grid-b">
                    <li class="ui-block-a" style="display:none"><a href="#seven" data-ajax="false" data-role="button"
                                                                   class="grey">空房<br/><?php echo $live['empty_room']['room_count'] ?>
                    <li class="ui-block-a"><a href="#one" data-ajax="false" data-role="button"
                                              class="grey">空房<br/><?php echo $live['empty_room']['room_count'] ?>
                            (间)</a></li>
                    <li class="ui-block-b "><a href="#two" data-ajax="false" data-role="button"
                                               class="black">脏房<br/><?php echo $live['dirty_room']['room_count'] ?>
                            (间)</a></li>
                    <li class="ui-block-c"><a href="#three" data-ajax="false" data-role="button"
                                              class="green">住人<br/><?php echo $live['living_room']['room_count'] ?>
                            (间) </a></li>
                    <li class="ui-block-a"><a href="#four" data-ajax="false" data-role="button"
                                              class="yellow">维修<br/><?php echo $live['maintain_room']['room_count'] ?>
                            (间)</a></li>
                    <li class="ui-block-b"><a href="#five" data-ajax="false" data-role="button"
                                              class="purple">预抵<br/><?php echo $live['arrival_room']['room_count'] ?>
                            (间)</a></li>
                    <li class="ui-block-c"><a href="#six" data-ajax="false" data-role="button"
                                              class="alls">自用<br/><?php echo $live['personal_use_room']['room_count'] ?>
                            (间)</a></li>
                </ul>
            </div>

            <div id="seven">
                <div class="ui-grid-d lives">
                    <?php if (!empty($all)): ?>
                        <?php foreach ($all as $v): ?>
                            <a href="desc.html" data-role="button" target="_top"
                               class="<?php echo $v['color'] ?>"><?php echo $v['room_no'] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div id="one">
                <div class="ui-grid-d lives">
                    <?php if (!empty($live) && $live['empty_room']['room_count'] != '0'): ?>
                        <?php foreach ($live['empty_room']['room_list'] as $v): ?>
                            <a href="desc.html" data-role="button" target="_top"
                               class="grey"><?php echo $v['room_no'] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div id="two">
                <div class="ui-grid-d lives">
                    <?php if (!empty($live) && $live['dirty_room']['room_count'] != '0'): ?>
                        <?php foreach ($live['dirty_room']['room_list'] as $v): ?>
                            <a href="desc.html" data-role="button" target="_top"
                               class="black"><?php echo $v['room_no'] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div id="three">
                <div class="ui-grid-d lives">
                    <?php if (!empty($live) && $live['living_room']['room_count'] != '0'): ?>
                        <?php foreach ($live['living_room']['room_list'] as $v): ?>
                            <a href="desc.html" data-role="button" target="_top"
                               class="green"><?php echo $v['room_no'] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div id="four">
                <div class="ui-grid-d lives">
                    <?php if (!empty($live) && $live['maintain_room']['room_count'] != '0'): ?>
                        <?php foreach ($live['maintain_room']['room_list'] as $v): ?>
                            <a href="desc.html" data-role="button" target="_top"
                               class="yellow"><?php echo $v['room_no'] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div id="five">
                <div class="ui-grid-d lives">
                    <?php if (!empty($live) && $live['arrival_room']['room_count'] != '0'): ?>
                        <?php foreach ($live['arrival_room']['room_list'] as $v): ?>
                            <a href="desc.html" data-role="button" target="_top"
                               class="purple"><?php echo $v['room_no'] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div id="six">
                <div class="ui-grid-d lives">
                    <?php if (!empty($live) && $live['personal_use_room']['room_count'] != '0'): ?>
                        <?php foreach ($live['personal_use_room']['room_list'] as $v): ?>
                            <a href="desc.html" data-role="button" target="_top"
                               class="alls"><?php echo $v['room_no'] ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
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
                        <li><a href="<?php echo Url::to(['live/index1']) ?>" data-icon="home" target="_top"
                               class="ui-btn-active ui-state-persist">实况</a></li>
                    <?php endif; ?>
                    <?php if (in_array(3, Yii::$app->session['rights'])): ?>
                        <li><a href="<?php echo Url::to(['check/index']) ?>" data-icon="user" target="_top">客人</a></li>
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