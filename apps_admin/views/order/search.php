<?php
use yii\helpers\Url;

?>
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="tab-content">
                    <div  class="tab-pane in active">
                        <div class="table-responsive">
                            <table id="sample-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">订单号</th>
                                    <th>酒店房间套餐</th>
                                    <th>姓名</th>
                                    <th>电话</th>
                                    <th>金额</th>
                                    <th>订单状态</th>
                                    <th>订单时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <?php foreach($rows as $k => $val) { echo "<tr>";
                                    echo "<td>"; echo  $val['order_on']; echo "</td>";
                                    echo "<td>"; echo  $val['goods_name']; echo "</td>";
                                    echo "<td>"; echo  $val['real_name']; echo "</td>";
                                    echo "<td>"; echo  $val['phone']; echo "</td>";
                                    echo "<td>"; echo  $val['totalc_price']; echo "</td>";

                                    echo "<td>";
                                        switch($val['order_status']) {
                                            case 0 : echo '<span class="badge badge-pink">待付款</span>';break;
                                            case 1 : echo '<span class="badge badge-pink">进店付款</span>';break;
                                            case 2 : echo '<span class="badge badge-success">已支付</span>';break;
                                            case 3 : echo '<span class="badge badge-purple">已入住</span>';break;
                                            case 4 : echo '<span class="badge badge-info">已完成</span>';break;
                                            case 5 : echo '<span class="badge badge">已取消</span>';break;
                                            case 6 : echo '<span class="badge badge-grey">申请退款</span>';break;
                                            case 7 : echo '<span class="badge badge-inverse">退款完成</span>';break;
                                            case 8 : echo '<span class="badge badge-yellow">订单超时</span>';break;
                                        }
                                    echo "</td>";

                                    echo "<td>"; echo  date("Y-m-d H:i:s",$val['order_time']); echo "</td>";
                                    echo "<td>"; echo '<button><a class="blue" href="'. Url::to(['order/orderdetail','order_id' => $val['order_id']]).'">订单详情</a></button>'; echo "</td>";
                                 echo "</tr>"; } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE CONTENT END -->
</div>
<!--酒店设置--[end]-->
