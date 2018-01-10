<?php
use yii\helpers\Url;

?>

<div class="page-content">
    <form class="form-horizontal" method="post" action="<?php echo Url::to(['account/accmanage','id' => $id]); ?>" enctype="multipart/form-data">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <!--酒店设置--[start]-->
        <div class="row">
            <div class="col-sm-6">
                <!--显示外部实线框-->
                <!--<div class="widget-box">-->
                <!--显示外部实线框-->
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-xs-12">
                                <!--公众号名称--[start]-->
                                <div class="form-group">
                                    <label for="hotel_name" class="col-sm-2 control-label">公众号名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="gongz_name" name="gongz_name">
                                        <span class="help-block">填写公众账号的名称</span>
                                    </div>
                                </div>
                                <!--公众号名称--[end]-->

                                <!--描述--[start]-->
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">描述</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3" name="signature" id="signature"></textarea>
                                        <span class="help-block">用于说明此公众号的功能及用途</span>
                                    </div>
                                </div>
                                <!--描述--[end]-->

                                <!--公众号账号--[start]-->
                                <div class="form-group">
                                    <label for="hotel_phone" class="col-sm-2 control-label">公众号账号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="account" name="account">
                                        <span class="help-block">填写公众号的账号，一般为英文</span>
                                    </div>
                                </div>
                                <!--公众号账号--[end]-->

                                <!--原始ID--[start]-->
                                <div class="form-group">
                                    <label for="hotel_phone" class="col-sm-2 control-label">原始ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="original" name="original">
                                        <span class="help-block">在给粉丝发送客服消息时，原始ID不能为空，建议您完善该选项</span>
                                    </div>
                                </div>
                                <!--原始ID--[end]-->

                                <!--级别-[start]-->
                                <div class="form-group">
                                    <!--Radio--[start]-->
                                    <label class="radio-inline">
                                        级别
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="level" id="Radio1" value="1"> 普通订阅
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="level" id="Radio2" value="2"> 普通服务号
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="level" id="Radio3" value="3"> 认证订阅号
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="level" id="Radio4" value="4"> 认证服务号/认证媒体/政府订阅号
                                    </label>
                                    <!--Radio--[end]-->
                                    <span class="help-block">注意：即使公众平台显示为“未认证”，但只要【公众号设置】/【账号详情】下【认证情况】显示资质审核通过，即可认定为认证号</span>
                                </div>
                                <!--级别--[end]-->

                                <!--token--[start]-->
                                <div class="form-group">
                                    <label for="hotel_phone" class="col-sm-2 control-label">Token</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="token" name="token">
                                        <span class="help-block">请填写微信公众号Token</span>
                                    </div>
                                </div>
                                <!--token--[end]-->

                                <!--encodingaeskey--[start]-->
                                <div class="form-group">
                                    <label for="hotel_phone" class="col-sm-2 control-label">Encodingaeskey</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="encodingaeskey" name="encodingaeskey">
                                        <span class="help-block">请填写encodingaeskey</span>
                                    </div>
                                </div>
                                <!--encodingaeskey--[end]-->

                                <!--APP ID--[start]-->
                                <div class="form-group">
                                    <label for="hotel_phone" class="col-sm-2 control-label">App ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="app_id" name="app_id">
                                        <span class="help-block">请填写微信公众平台后台的 App ID</span>
                                    </div>
                                </div>
                                <!--APP ID--[end]-->


                                <!--AppSecret--[start]-->
                                <div class="form-group">
                                    <label for="hotel_phone" class="col-sm-2 control-label">AppSecret</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="app_secret" name="app_secret">
                                        <span class="help-block">请填写微信公众平台后台的 AppSecret，只有填写这两项才能管理自定义菜单</span>
                                    </div>
                                </div>
                                <!--AppSecret--[end]-->

                                <!--商户号--[start]-->
                                <div class="form-group">
                                    <label for="hotel_phone" class="col-sm-2 control-label">商户号</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pay_mchid" name="pay_mchid">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--商户号--[end]-->

                                <!--支付Key--[start]-->
                                <div class="form-group">
                                    <label for="hotel_phone" class="col-sm-2 control-label">支付Key</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pay_key" name="pay_key">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!--支付Key--[end]-->

                                <!--二维码--[start]-->
                                <div class="form-group">
                                    <label for="thumb"  class="col-sm-2 control-label">二维码</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="" id="qrcode_val" readonly>
                                    </div>
                                    <div class="col-sm-2">
                            <span class="btn btn-info btn-sm fileinput-button">

                                        <span>+ 二维码</span>
                                        <input type="file" id="qrcode_pic" name="qrcode_pic">
                                    </span>
                                    </div>
                                    <span class="help-block">只支持jpg图片</span>
                                </div>
                                <!--二维码--[end]-->

                                <!--头像--[start]-->
                                <div class="form-group">
                                    <label for="thumb"  class="col-sm-2 control-label">头像</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="" id="avatar_val" readonly>
                                    </div>
                                    <div class="col-sm-2">
                            <span class="btn btn-info btn-sm fileinput-button">

                                        <span>+ 头像</span>
                                        <input type="file" id="avatar" name="avatar">
                                    </span>
                                    </div>
                                    <span class="help-block">只支持jpg图片</span>
                                </div>
                                <!--头像--[end]-->

                                <!--保存--[start]-->
                                <div class="">
                                    <div class="col-sm-3">
                                        <button class="btn btn-success big" type="submit" id="submit">提交</button>
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
<!--酒店设置--[end]-->
</form>
<!-- PAGE CONTENT END -->
</div>
</div>
</div>
<link rel='stylesheet' type='text/css' href='/js/admin/css/jquery.fileupload-ui.css' />

<script type="text/javascript">

    var submit = 0;
    var first = 1;
    seajs.use(['$','sel'],function($,sel){
        var device_ele_count = $('.hotel_device').length;
        //页面加载完成执行
        $(document).ready(function() {
            //首次打开页面进行页面数据初始化
            ajaxSubmit();
        });
        $("#submit").on("click",function() {
            if(!$("#gongz_name").val()) {
                alert("请填写公众号名称！");
                return false;
            }
        });

        $("#qrcode_pic").on("change",function() {
            $("#qrcode_val").val($(this).val());
        })

        $("#avatar").on("change",function() {
            $("#avatar_val").val($(this).val());
        })
    });

    function ajaxSubmit() {
            $.ajax({
                url : "<?php echo Url::to(['account/accmanage','id' => $id]); ?>",
                type: "GET",
                dataType:"json",
                success: function(data) {
                    $("#gongz_name").val(data['name']);
                    $("#signature").val(data['signature']);
                    $("#account").val(data['account']);
                    $("#original").val(data['original']);
                    $("#Radio"+data['level']).attr('checked','checked');
                    $("#app_id").val(data['app_id']);
                    $("#token").val(data['token']);
                    $("#encodingaeskey").val(data['encodingaeskey']);
                    $("#app_secret").val(data['app_secret']);
                    $("#pay_mchid").val(data['pay_mchid']);
                    $("#pay_key").val(data['pay_key']);
                }
            });//end of ajax
    }

</script>
<!--<include file="Public/footer"/>-->
