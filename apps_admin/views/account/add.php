<?php
use yii\helpers\Url;

?>
<form class="form-horizontal" method="post" action="<?php echo Url::to(['account/add']); ?>">
    <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="row">

                    <ul class="nav nav-tabs" id="myTab">
                        <li>
                            <a  href="<?php echo Url::to(['account/manage']) ?>">
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
                                                    <select class="control-label col-sm-8" id="wechat" name="wechat">
                                                        <option value="0" id="start0">--请选择公众号--</option>
                                                    </select>
                                                </div>
                                                <!--公众号--[end]-->

                                                <!--用户名--[start]-->
                                                <div class="form-group">
                                                    <label for="integral" class="col-sm-2 control-label">用户名</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="username" name="username">
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
    seajs.use(['$','sel'],function($,sel){
        //页面加载完成执行
        $(document).ready(function() {
            //首次打开页面进行页面数据初始化
            ajaxSubmit(0,first,sel);
        });

        function ajaxSubmit(_param1, _param2,sel) {
            if(1 == _param1 || 1 == _param2) {
                $.ajax({
                    url : "<?php echo Url::to(['account/add','id'=>1]); ?>",
                    type: "GET",
                    dataType:"json",
                    success: function(data) {
                        for(var i = 0; i < data.length; i++) {
                            $('#wechat').append('<option value="'+data[i]['acid']+'">'+data[i]['name']+'</option>');
                        }
                    }
                });//end of ajax
            }
        }

        $('#submit').on('click', function () {
/*            if(0 == $('#wechat').val()) {
                alert('请选择公众号！');
                return false;
            }*/
            if('' == $('#username').val()) {
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
        });
    });
</script>
<!--<include file="Public/footer"/>-->
