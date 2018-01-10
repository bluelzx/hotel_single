<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$baseUrl = Yii::$app->request->baseUrl;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Login Page - Ace Admin</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/libs/font-awesome/css/font-awesome.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace-fonts.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace-part2.css" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace-rtl.css" />
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/site.css" />
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/js/admin/css/ace-ie.css" />
    <![endif]-->

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?php echo $baseUrl ?>/js/libs/html5shiv/dist/html5shiv.min.js"></script>
    <script src="<?php echo $baseUrl ?>/js/libs/respond/dest/respond.min.js"></script>
    <![endif]-->
   
</head>

<body class="login-layout">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="">
                <div class="login-container">                   

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border" style="background:none !important">
                            <div class="widget-body" style="background:none !important">
                                <div class="widget-main">
                                <div class="login_logo"></div>
                                   

                                    <div class="space-6"></div>

                                    <?php $form = ActiveForm::begin(); ?>
                                    <fieldset>
                                        <label class="block clearfix">
                                          <span class="block input-icon input-icon-right">
                                                            <?=$form->field($model,'username')->textInput() ?>
                                              <i class="ace-icon fa fa-user"></i>
                                          </span>
                                        </label>

                                        <label class="block clearfix">
                                          <span class="block input-icon input-icon-right">
                                                            <?=$form->field($model,'password')->passwordInput() ?>
                                              <i class="ace-icon fa fa-lock"></i>
                                          </span>
                                        </label>

                                        <div class="space"></div>

                                        <div class="clearfix" style=" margin-top:38px;">
                                            <label class="inline" style="color:#333">
                                                <?=$form->field($model,'rememberMe')->checkbox() ?>
                                            </label>

                                            <?=Html::submitButton('登录',['class'=>'btn'])?>

                                        </div>

                                        <div class="space-4"></div>
                                    </fieldset>
                                    <?php $form = ActiveForm::end(); ?>


                                    <div class="space-6"></div>

                                </div><!-- /.widget-main -->

                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->


                    </div><!-- /.position-relative -->

                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->

</body>
</html>