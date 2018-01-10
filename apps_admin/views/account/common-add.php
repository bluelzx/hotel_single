<?php
use yii\helpers\Url;

?>
<form class="form-horizontal" method="post" action="<?php echo Url::to(['account/common-add']); ?>">
    <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="row">

                    <ul class="nav nav-tabs" id="myTab">
                        <li>
                            <a  href="<?php echo Url::to(['account/common-manage']) ?>">
                                <i class="green icon-home bigger-110"></i>
                                账户管理
                            </a>
                        </li>

                        <li  class="active">
                            <a  href="#">
                                <i class="green icon-edit bigger-110"></i>
                                添加账户
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <!--显示外部实线框-->
                                <!--<div class="widget-box">-->
                                <!--显示外部实线框-->
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-xs-12">

                                                <!--公众号--[start]-->
                                                <div class="form-group">
                                                    <label for="hotel_level" class="col-sm-2 control-label">公众号</label>
                                                  <div class="col-sm-10">   <input class="form-control" name="admin" id="admin" readonly> </div>
                                                </div>
                                                <!--公众号--[end]-->

                                                <!--用户名--[start]-->
                                                <div class="form-group">
                                                    <label for="integral" class="col-sm-2 control-label">用户名</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="accountname" name="accountname">
                                                        <span id="tips" style="color: red"></span>
                                                    </div>
                                                </div>
                                                <!--用户名--[end]-->

                                                <!--密码--[start]-->
                                                <div class="form-group">
                                                    <label for="integral" class="col-sm-2 control-label">密码</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="pwd" name="pwd">
                                                    </div>
                                                </div>
                                                <!--密码--[end]-->

                                                <!--确认密码--[start]-->
                                                <div class="form-group">
                                                    <label for="integral" class="col-sm-2 control-label">确认密码</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd">
                                                        <span id="tips1" style="color: red"></span>
                                                    </div>
                                                </div>
                                                <!--确认密码--[end]-->

                                                <!--保存--[start]-->
                                                <div class="">
                                                    <div class="col-sm-3">
                                                        <button class="btn btn-success big" type="submit" id="submit">保存</button>
                                                    </div>
                                                </div>
                                                <!--保存--[end]-->
                                                <!--返回--[start]-->
                                                <div class="">
                                                    <div class="col-sm-3">
                                                        <button class="btn btn-danger big" onclick="javascript:history.go(-1);">返回</button>
                                                    </div>
                                                </div>
                                                <!--返回--[end]-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- PAGE CONTENT END -->
    </div>
    <!--酒店设置--[end]-->
</form>





<script type="text/javascript">

    var submit = 0;
    var first = 1;
    var check_name = 0;
    var check_pwd = 0;
    seajs.use(['$','sel'],function($,sel){
        //页面加载完成执行
        $(document).ready(function() {
            //首次打开页面进行页面数据初始化
            ajaxSubmit(0,first,sel);
        });

        $("#accountname").on("keyup",function() {
            $.ajax({
                url: "<?php echo Url::to(['account/check-name']); ?>",
                type: "POST",
                data:{accountname:$("#accountname").val()},
                dataType: "json",
                success: function(data) {
                    if(!data) {
                        check_name = 0;
                        $("#tips").html("");
                    } else {
                        check_name = 1;
                        $("#tips").html("该用户已经存在");
                    }
                }
            });
        });

        $("#confirm_pwd").on("keyup",function() {
            $.ajax({
                url: "<?php echo Url::to(['account/check-pwd']); ?>",
                type: "POST",
                data:{confirm_pwd:$("#confirm_pwd").val(),pwd:$("#pwd").val()},
                dataType: "json",
                success: function(data) {
                    if(data) {
                        check_pwd = 0;
                        $("#tips1").html("");
                    } else {
                        check_pwd = 1;
                        $("#tips1").html("两次密码不一致");
                    }
                }
            });
        });

        function ajaxSubmit(_param1, _param2,sel) {
            if(1 == _param1 || 1 == _param2) {
                $.ajax({
                    url : "<?php echo Url::to(['account/common-add']); ?>",
                    type: "GET",
                    dataType:"json",
                    success: function(data) {
                        $("#admin").val(data.name);
                    }
                });//end of ajax
            }
        }

        $('#submit').on('click', function () {
            /*            if(0 == $('#wechat').val()) {
             alert('请选择公众号！');
             return false;
             }*/
            if(!check_name && !check_pwd) {
                if('' == $('#accountname').val()) {
                    alert('填写用户名！');
                    return false;
                }
                if('' == $('#pwd').val()) {
                    alert('请填写密码！');
                    return false;
                }
                if('' == $('#confirm_pwd').val()) {
                    alert('请确认密码！');
                    return false;
                }
            } else {
                alert('用户名已存在或两次密码不一致！');
                return false;
            }
        });
    });
</script>
<!--<include file="Public/footer"/>-->
