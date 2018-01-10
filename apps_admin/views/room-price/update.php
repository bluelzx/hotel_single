<?php
use yii\helpers\Url;

?>
<form class="form-horizontal" method="post" action="<?php echo Url::to(['room-price/update','id'=>$id]); ?>">
    <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="row">

                    <ul class="nav nav-tabs" id="myTab">
                        <li>
                            <a  href="<?php echo Url::to(['room-price/index']) ?>">
                                <i class="green icon-home bigger-110"></i>
                                房价管理
                            </a>
                        </li>

                        <li  class="active">
                            <a  href="#">
                                <i class="green icon-edit bigger-110"></i>
                                修改房价
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="row">
                            <div class="col-sm-10">
                                <!--显示外部实线框-->
                                <!--<div class="widget-box">-->
                                <!--显示外部实线框-->
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-xs-12">

                                                <!--所属酒店--[start]-->
                                                <div class="form-group">
                                                    <label for="integral" class="col-sm-2 control-label">所属酒店</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="hotel_title" name="hotel_title" readonly>
                                                    </div>
                                                </div>
                                                <!--所属酒店--[end]-->

                                                <!--所属房型--[start]-->
                                                <div class="form-group">
                                                    <label for="hotel_level" class="col-sm-2 control-label">所属房型</label>
                                                    <div class="col-sm-10">   <select class="control-label col-sm-12" id="room_type" name="room_type">
                                                            <option value="" id="start0">--请选择房型--</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--所属房型--[end]-->

                                                <!--房价类型--[start]-->
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">房价类型</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="price_plan" name="price_plan" autocomplete="off">
                                                        <span id="tips" style="color: red"></span>
                                                    </div>
                                                </div>
                                                <!--房价类型--[end]-->

                                                <!--原价--[start]-->
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">原价</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="oprice" name="oprice">
                                                    </div>
                                                </div>
                                                <!--原价--[end]-->

                                                <!--优惠价--[start]-->
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">优惠价</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="cprice" name="cprice">
                                                    </div>
                                                </div>
                                                <!--优惠价--[end]-->

                                                <!--退房时间--[start]-->
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">退房时间</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="checkout_timeset" name="checkout_timeset" placeholder="时：分：秒">
                                                    </div>
                                                </div>
                                                <!--退房时间--[end]-->

                                                <!--状态--[start]-->
                                                <div class="form-group">
                                                   
                                                        <!--Radio--[start]-->
                                                        <label class="col-sm-2 control-label">
                                                            状态
                                                        </label>     <div class="col-sm-10">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="Radio1_status" value="1"> 显示
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="Radio2_status" value="0"> 隐藏
                                                        </label>
                                                        <!--Radio--[end]-->
                                                        <span class="help-block">手机前台是否显示</span>
                                                    </div>
                                                </div>
                                                <!--状态--[end]-->

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
                                                        <button class="btn btn-danger big" onclick="javascript:history.go(-1);return false;">返回</button>
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
    var check = 0;
    seajs.use(['$','sel'],function($,sel){
        //页面加载完成执行
        $(document).ready(function() {
            //首次打开页面进行页面数据初始化
            ajaxSubmit(0,first,sel);
        });

        $("#price_plan").on("keyup",function() {
            //checkPricePlan();
        });

        $('#submit').on("click",function() {
            if(!check) {
                if(!$("#room_type").val()) {
                    alert("请选择房型");
                    return false;
                }
                if(!$("#price_plan").val()) {
                    alert("请选择房价类型");
                    return false;
                }
                if(!$("#oprice").val()) {
                    alert("请填写原价");
                    return false;
                }
                if(!$("#cprice").val()) {
                    alert("请填写优惠价");
                    return false;
                }
                var v = $("input:radio[name='status']:checked").val();
                if(v == null) {
                    alert("请选状态");
                    return false;
                }

                if(!$("#checkout_timeset").val()) {
                    alert("请填写退房时间！");
                    return false;
                }
            } else {
                alert("该房价类型已经存在，请重新修改");
                return false;
            }
        });

        function checkPricePlan() {
            $.ajax({
                url : "<?php echo Url::to(['room-price/checkplan']); ?>",
                data:{price_plan:$("#price_plan").val()},
                type: "POST",
                dataType:"json",
                success: function(data) {
                    if(data) {
                        check = 1;
                        $("#tips").html("该房价类型已经存在，请重新修改");
                    } else {
                        check = 0;
                        $("#tips").html("");
                    }
                }
            });
        }

        function ajaxSubmit(_param1, _param2,sel) {
            if(1 == _param1 || 1 == _param2) {
                $.ajax({
                    url : "<?php echo Url::to(['room-price/update','id'=>$id]); ?>",
                    type: "GET",
                    dataType:"json",
                    success: function(data) {
                        console.log(data);
                        $('#hotel_title').val(data['title']); //所属酒店
                        $('#price_plan').val(data['price_plan']); //房价类型
                        $('#oprice').val(data['oprice']); //原价
                        $('#cprice').val(data['cprice']); //优惠价
                        $('#checkout_timeset').val(data['checkout_timeset']); //优惠价
                        for(var i = 0; i < data['room_type'].length; i++) {
                            if(data['room_type_id'] == data['room_type'][i]['id']) {
                                $('#room_type').append('<option selected value="'+data['room_type'][i]['id']+'">'+data['room_type'][i]['name']+'</option>');
                            } else {
                                $('#room_type').append('<option value="'+data['room_type'][i]['id']+'">'+data['room_type'][i]['name']+'</option>');
                            }
                        }
                        //状态
                        if(1 == data['status'])
                            $('#Radio1_status').attr('checked','checked');
                        else
                            $('#Radio2_status').attr('checked','checked');
                        console.log(data);
                    }
                });//end of ajax
            }
        }
    });
</script>
<!--<include file="Public/footer"/>-->
