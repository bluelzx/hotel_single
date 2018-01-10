<?php
use yii\helpers\Url;

?>

<div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->

        <div class="row">
            <div class="col-sm-12">
                <!--显示外部实线框-->
                <!--<div class="widget-box">-->
                <!--显示外部实线框-->
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row orderlist">
                            <div><p>订单号: &nbsp;&nbsp;&nbsp;&nbsp;<span id="order_no"></span></p></div>
                            <div><p>订单状态:&nbsp;&nbsp;&nbsp;&nbsp;  <span id="order_status" class="badge-success"></span></p></div>
                            <div><p>微信昵称:&nbsp;&nbsp;&nbsp;&nbsp;  <span id="nick_name"></span></p></div>
                            <div><p>酒店名称: &nbsp;&nbsp;&nbsp;&nbsp; <span id="hotel_title"></span></p></div>
                            <div><p>房间类型: &nbsp;&nbsp;&nbsp;&nbsp; <span id="room_type"></span></p></div>
                            <div><p>预订数量:&nbsp;&nbsp;&nbsp;&nbsp;  <span id="room_count"></span></p></div>
                            <div><p>订单金额: &nbsp;&nbsp;&nbsp;&nbsp; <span id="order_amount"></span></p></div>
                            <div><p>联系人: &nbsp;&nbsp;&nbsp;&nbsp; <span id="check_man"></span></p></div>
                            <div><p>联系方式: &nbsp;&nbsp;&nbsp;&nbsp; <span id="phone"></span></p></div>
                            <div><p>预定到店时间:&nbsp;&nbsp;&nbsp;&nbsp;  <span id="check_in"></span></p></div>
                            <div><p>预抵到店时间:&nbsp;&nbsp;&nbsp;&nbsp;  <span id="arrive_time"></span></p></div>
                            <div><p>实际到店时间:&nbsp;&nbsp;&nbsp;&nbsp;  <span id="fact_check_in"></span></p></div>
                            <div><p>预定离店时间: &nbsp;&nbsp;&nbsp;&nbsp; <span id="check_out"></span>&nbsp;&nbsp;<span id="checkout_timeset"></span></p></div>
                            <div><p>支付方式: &nbsp;&nbsp;&nbsp;&nbsp; <span id="pay_type" class="badge-success"></span></p></div>
                            <div><p>订单下单时间: &nbsp;&nbsp;&nbsp;&nbsp; <span id="order_time"></span></p></div>
                        </div>
                        
                       
                    </div> <div class="col-sm-3">
                                                            <button class="btn btn-danger big" onclick="javascript:history.go(-1);">返回列表</button>
                                                        </div>
                </div>
            </div>
        </div>
</div>


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
                    url : "<?php echo Url::to(['order/orderdetail','order_id'=>$order_id]); ?>",
                    type: "GET",
                    dataType:"json",
                    success: function(data) {
                        console.log(data['checkin_time']);
                        $('#order_no').html(data['order_on']);
                        $('#nick_name').html(data['nickname']);
                        $('#hotel_title').html(data['title']);
                        $('#room_type').html(data['goods_name']);
                        $('#room_count').html(data['room_count']);
                        $('#order_amount').html(data['totalc_price']);
                        $('#check_man').html(data['real_name']);
                        $('#phone').html(data['phone']);
                        $('#check_in').html(data['checkin_time']);
                        $('#check_out').html(data['checkout_time']);
                        $('#checkout_timeset').html(data['checkout_timeset']);
                        $('#fact_check_in').html(data['actual_arrival_time']);
                        $('#order_time').html(data['order_time']);
                        $('#arrive_time').html(data['arrival_time']);
                        if (0 == data['order_status']) {
                            $('#order_status').html("待付款");
                        }
                        if (1 == data['order_status']) {
                            $('#order_status').html("进店付款");
                        }
                        if (2 == data['order_status']) {
                            $('#order_status').html("已支付");
                        }
                        if (3 == data['order_status']) {
                            $('#order_status').html("已入住");
                        }
                        if (4 == data['order_status']) {
                            $('#order_status').html("已完成");
                        }
                        if (5 == data['order_status']) {
                            $('#order_status').html("已取消");
                        }
                        if (6 == data['order_status']) {
                            $('#order_status').html("申请退款");
                        }
                        if (7 == data['order_status']) {
                            $('#order_status').html("退款完成");
                        }
                        if (8 == data['order_status']) {
                            $('#order_status').html("订单超时");
                        }

                        if(1 == data['pay_type']) {
                            $('#pay_type').html("微信支付");
                        }
                        if(2 == data['pay_type']) {
                            $('#pay_type').html("支付宝支付");
                        }
                        if(3 == data['pay_type']) {
                            $('#pay_type').html("其他");
                        }
                    }
                });//end of ajax
            }
        }
    });
</script>