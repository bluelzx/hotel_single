<?php
use yii\helpers\Url;

$baseUrl = Yii::$app->request->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>Dashboard - Ace Admin</title>

    <meta name="description" content="overview &amp; stats"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>


    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/libs/font-awesome/css/font-awesome.css"/>

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace-fonts.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace.css"
          class="ace-main-stylesheet" id="main-ace-style"/>
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/site.css"/>
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace-part2.css"
          class="ace-main-stylesheet"/>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace-skins.css"/>
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace-rtl.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace-ie.css"/>
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?php echo $baseUrl ?>/libs/html5shiv/dist/html5shiv.min.js"></script>
    <script src="<?php echo $baseUrl ?>/libs/respond/dest/respond.min.js"></script>
    <![endif]-->
    <script>
        hotel = {};
        hotel.seajsBase = "<?php echo $baseUrl ?>/js/";
    </script>
    <script src="<?php echo $baseUrl ?>/js/libs/seajs-3.0.0/dist/sea.js" type="text/javascript"></script>
    <script src="<?php echo $baseUrl ?>/js/admin/config.js" type="text/javascript"></script>
</head>

<body class="no-skin">
<?php $this->beginBody() ?>
<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default          ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <!-- #section:basics/sidebar.mobile.toggle -->
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <!-- /section:basics/sidebar.mobile.toggle -->
        <div class="navbar-header pull-left">
            <!-- #section:basics/navbar.layout.brand -->
            <a href="#" class="navbar-brand">
                <small class="logo">

                    微信酒店订房后台 -- <?php echo $_SESSION['wx_account']; ?>
                </small>
            </a>

            <!-- /section:basics/navbar.layout.brand -->

            <!-- #section:basics/navbar.toggle -->

            <!-- /section:basics/navbar.toggle -->
        </div>

        <!-- #section:basics/navbar.dropdown -->
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <!-- #section:basics/navbar.user_menu -->
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<small>欢迎光临,</small>
                                    <?php echo $_SESSION['username']; ?>
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="<?php echo Url::to(['login/update']) ?>">
                                <i class="ace-icon fa fa-cog"></i>
                                修改密码
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="<?php echo Url::to(['login/logout']) ?>">
                                <i class="ace-icon fa fa-power-off"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- /section:basics/navbar.user_menu -->
            </ul>
        </div>

        <!-- /section:basics/navbar.dropdown -->
    </div><!-- /.navbar-container -->
</div>

<!-- /section:basics/navbar.layout -->
<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        seajs.use(["ace-extra"], function (ace) {
            try {
                ace.settings.loadState('main-container')
            } catch (e) {
            }
        })
    </script>

    <!-- #section:basics/sidebar -->
    <?php if (isset($_SESSION['s_acid']) || $_SESSION['acid']) { ?>
        <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
            <script type="text/javascript">
                seajs.use(["ace-extra"], function (ace) {
                    try {
                        ace.settings.loadState('sidebar')
                    } catch (e) {
                    }
                })
            </script>


            <ul class="nav nav-list">
                <li class="open">
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <i class="menu-icon fa fa-tag"></i>
                        <span class="menu-text"> 酒店管理 </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                    <!--            --><?php /*if(isset($_SESSION['acid']) && !$_SESSION['acid']){*/ ?>
                    <!--                <ul class="submenu">
                    <li class="">
                        <a href="" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>
                            公众号维护
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="">
                                <a href="<?php /*echo Url::to(['account/acclist']) */ ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    公众号列表
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                </ul>-->
                    <!--            --><?php /*} if(isset($_SESSION['s_acid']) || $_SESSION['acid']) { */ ?>
                    <ul class="submenu">
                        <!--<li class="">
                        <a href="<?php /*echo Url::to(['basic/index']) */ ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            系统设置
                        </a>

                        <b class="arrow"></b>
                    </li>-->

                        <li class="">
                            <a href="<?php echo Url::to(['hotel/index']) ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                酒店设置
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?php echo Url::to(['room-type/index']) ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                房型管理
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?php echo Url::to(['room-price/index']) ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                房价管理
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <!--<li class="">
                            <a href="<?php /*echo Url::to(['room/index']) */ ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                房间管理
                            </a>
                            <b class="arrow"></b>
                        </li>-->

                        <!--<li class="">
                        <a href="<?php /*echo Url::to(['room-state/index']) */ ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
            房态图
                        </a>

                        <b class="arrow"></b>
                    </li>-->

                        <li class="">
                            <a href="<?php echo Url::to(['room-state/statistics']) ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                房态统计
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?php echo Url::to(['category/index']); ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                模型管理
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-desktop"></i>
                        <span class="menu-text"> 订单管理 </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="">
                            <a href="<?php echo Url::to(['order/index', 'order_type' => 88]) ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                所有订单
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?php echo Url::to(['order-refund/index']) ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                订单退款
                            </a>

                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <i class="menu-icon fa fa-list"></i>
                        <span class="menu-text"> 账户管理 </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>
                    <?php if (!$_SESSION['acid']) {
                        $url = Url::to(['account/manage']);
                    } else {
                        $url = Url::to(['account/common-manage']);
                    } ?>
                    <ul class="submenu">
                        <li class="">
                            <a href="<?php echo $url; ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                账户管理
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <?php if (!$_SESSION['acid']) { ?>
                            <li class="">
                                <a href="<?php echo Url::to(['api-daily/index']) ?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    api日志
                                </a>

                                <b class="arrow"></b>
                            </li>
                        <?php } ?>

                    </ul>
                </li>
                </li>

                <li class="">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-desktop"></i>
                        <span class="menu-text"> 公众号设置 </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="">
                            <a href="<?php echo Url::to(['wx-menu/index']) ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                菜单管理
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?php echo Url::to(['wx-menu-click/index']) ?>">
                                <i class="menu-icon fa fa-caret-right"></i>
                                素材管理
                            </a>

                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
            </ul><!-- /.nav-list -->

            <!-- #section:basics/sidebar.layout.minimize -->
            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
                   data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>

            <!-- /section:basics/sidebar.layout.minimize -->
        </div>
    <?php } ?>

    <!-- /section:basics/sidebar -->
    <div class="main-content">
        <?= $content ?>
    </div><!-- /.main-content -->

    <div class="footer">
        <div class="footer-inner">
            <?php $flag = isset($_SESSION['s_acid']) || $_SESSION['acid'] ?>
            <?php if ($flag) { ?>
                <span id="mp3box"></span>
                <span id="mp3box1"></span>
            <?php } ?>
            <!-- #section:basics/footer -->
            <div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder"></span>
							Copyright © 深圳市领先智能科技有限公司 版权所有
						</span>


            </div>
            <script>
                seajs.use(['admin-common', 'ace-sidebar', 'bootstrap', 'ace-min'])

                seajs.use(['$'], function ($) {
                    var vflag = '<?php echo $flag ?>';
                    if (vflag == "1") {
                        var acid = '<?php if (0 == $_SESSION['acid']) {
                            $acid = isset($_SESSION['s_acid']) ? $_SESSION['s_acid'] : 0;
                        } else {
                            $acid = Yii::$app->user->identity->acid;
                        } echo $acid; ?>';


                        $(function () {
                            function orderTip() {
                                $.ajax({
                                    type: 'post',
                                    url: '<?php echo Url::to(['index/new-order']) ?>',
                                    data: {'acid': acid},
                                    success: function (data) {
                                        if (data.status > 0) {
                                            $("#mp3box").html('<audio id="idaudio" src="<?php echo $baseUrl . '/js/admin/voice/tip.mp3' ?>" autoplay="autoplay"></audio>');
                                        } else {
                                            $("#mp3box").html('');
                                        }
                                    }
                                })
                            }

                            orderTip();
                            var t = self.setInterval(orderTip, 60000);

                            function orderRTip() {
                                $.ajax({
                                    type: 'post',
                                    url: '<?php echo Url::to(['index/refund-order']) ?>',
                                    data: {'acid': acid},
                                    success: function (data) {
                                        if (data.status > 0) {
                                            $("#mp3box1").html('<audio id="idaudio" src="<?php echo $baseUrl . '/js/admin/voice/rtip.mp3' ?>" autoplay="autoplay"></audio>');
                                        } else {
                                            $("#mp3box1").html('');
                                        }
                                    }
                                })
                            }

                            setTimeout(orderRTip, 20000);
                            var tr = self.setInterval(orderRTip, 60000);
                        });
                    }

                });
            </script>


            <!-- /section:basics/footer -->
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
    <?php $this->endBody() ?>
</div><!-- /.main-container -->
</body>
</html>
<?php $this->endPage() ?>
