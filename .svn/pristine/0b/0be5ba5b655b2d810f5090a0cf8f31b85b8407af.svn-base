<?php
use yii\helpers\Url;

?>
    <div class="page-content">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="row">

                    <ul class="nav nav-tabs" id="myTab">
                        <li id="order_88">
                            <a  href="<?php echo Url::to(['order/index','order_type' => 88]); ?>">
                                <i class="green icon-home bigger-110"></i>
                                全部订单
                            </a>
                        </li>

<!--                        <li id="order_0">
                            <a  href="<?php /*echo Url::to(['order/index','order_type' => 0]); */?>">
                                <i class="green icon-edit bigger-110"></i>
                                待付款订单
                            </a>
                        </li>

                        <li id="order_1">
                            <a  href="<?php /*echo Url::to(['order/index','order_type' => 1]); */?>">
                                <i class="green icon-edit bigger-110"></i>
                                进店付款订单
                            </a>
                        </li>-->

<!--                        <li id="order_2">
                            <a  href="<?php /*echo Url::to(['order/index','order_type' => 2]); */?>">
                                <i class="green icon-edit bigger-110"></i>
                                已支付订单
                            </a>
                        </li>-->

                        <li id="order_2">
                            <a  href="<?php echo Url::to(['order/index','order_type' => 2]); ?>">
                                <i class="green icon-edit bigger-110"></i>
                                已支付未入住
                            </a>
                        </li>

                        <li id="order_3">
                            <a  href="<?php echo Url::to(['order/index','order_type' => 3]); ?>">
                                <i class="green icon-edit bigger-110"></i>
                                已入住订单
                            </a>
                        </li>

<!--                        <li id="order_4">
                            <a  href="<?php /*echo Url::to(['order/index','order_type' => 4]); */?>">
                                <i class="green icon-edit bigger-110"></i>
                                已完成订单
                            </a>
                        </li>

                        <li id="order_5">
                            <a  href="<?php /*echo Url::to(['order/index','order_type' => 5]); */?>">
                                <i class="green icon-edit bigger-110"></i>
                                已取消订单
                            </a>
                        </li>-->

                        <li id="order_6">
                            <a  href="<?php echo Url::to(['order/index','order_type' => 6]); ?>">
                                <i class="green icon-edit bigger-110"></i>
                                申请退款
                            </a>
                        </li>

                        <li id="order_7">
                            <a  href="<?php echo Url::to(['order/index','order_type' => 7]); ?>">
                                <i class="green icon-edit bigger-110"></i>
                                退款完成
                            </a>
                        </li>
                    </ul>
                    &nbsp;
                    &nbsp;
                    <div>

                        <div class="boxsee">
                            订单号：<input name="order_no" value="" id="order_no">
                            订单时间：<input style="border:1px solid #ccc" class="laydate-icon" name="order_time_from" id="order_time_start" readonly> 至 <input style="border:1px solid #ccc" class="laydate-icon" name="order_time_to" readonly id="order_time_end">  <!--使用日期插件选择日期-->
                            <button type="submit" id="submit" class="btn btn-warning btn-xs">查询</button>
                        </div>

                    </div>
                    &nbsp;
                    &nbsp;
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
                                        <th>入住时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
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




<script src="/js/admin/js/datetime/laydate.js"></script>
<script>
    ;!function(){

        laydate.skin('molv');

        laydate({
            elem: '#order_time_start'   //created_time_to
        })

        laydate({
            elem: '#order_time_end'   //created_time_to
        })

    }();
</script>
<script type="text/javascript">
    seajs.use(['admin-common','$','dataTables',"dataTables-bootstrap"],function(admin,$){
        flag = 0;
        $(document).ready(function() {
            $id = "<?php echo $order_type; ?>";
             $('#order_'+$id).attr('class','active');
        });

        $("#submit").on("click",function() {
            var regular_email = /^(\s)/g;
            if(!$("#order_no").val() && !$("#order_time_start").val() && !$("#order_time_end").val() || regular_email.test($('#order_no').val())) {
                flag = 1;
                alert("请输入查询条件，且查询条件不能为空格！");
                return false;
            } else {
                flag = 0;
            }
        });

        var oTable = $('#sample-table').dataTable({
            "bAutoWidth" : false,//是否自适应宽度
            "bFilter":false,//把搜索关了
            "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],//每页显示数据量
            "aoColumns" : [ //列操作
                {
                    bSortable:false,
                    "sWidth" : "10%",
                    "mData" : "order_on",
                    "sClass" : "center"
                },
                {"mData" : "goods_name",bSortable:false,"sWidth" : "10%"},
                {"mData" : "real_name",bSortable:false,"sWidth" : "5%"},
                {"mData" : "phone",bSortable:false,"sWidth" : "10%"},
                {"mData" : "totalc_price", "sClass" : "center", bSortable:false,"sWidth" : "10%"},
                {"mData" : "order_status",
                    "sClass" : "center",
                    bSortable : false,
                    "sWidth" : "5%",
                    "mRender" : function(data) {
                        if (0 == data) {
                            return '<span class="badge badge-pink">待付款</span>';
                        }
                        if (1 == data) {
                            return '<span class="badge badge-pink">进店付款</span>';
                        }
                        if (2 == data) {
                            return '<span class="badge badge-success">已支付</span>';
                        }
                        if (3 == data) {
                            return '<span class="badge badge-purple">已入住</span>';
                        }
                        if (4 == data) {
                            return '<span class="badge badge-info">已完成</span>';
                        }
                        if (5 == data) {
                            return '<span class="badge">已取消</span>';
                        }
                        if (6 == data) {
                            return '<span class="badge badge-grey">申请退款</span>';
                        }
                        if (7 == data) {
                            return '<span class="badge badge-inverse">退款完成</span>';
                        }
                        if (8 == data) {
                            return '<span class="badge badge-yellow">订单超时</span>';
                        }
                    }
                },
                {"mData" : "order_time", "sClass" : "center", bSortable:false,"sWidth" : "15%"},
                {"mData" : "actual_arrival_time", "sClass" : "center", bSortable:false,"sWidth" : "15%"},
                {
                    bSortable:false,
                    "sWidth" : "20%",
                    "mData" : "order_id",
                    "mRender" : function (data,type,full) {
                        var editurl = "<?php echo Url::to(['order/orderdetail']) ?>&order_id=" + data;
                        var res = "<div class='hidden-sm hidden-xs action-buttons'>";
                        res += '<a class="btn btn-primary btn-xs" href="'+editurl+'">订单详情</a>';
                        if(2 == full['order_status']) {
                            res += '<button class="btn btn-primary btn-xs confirm" id="'+full['order_id']+'">确定入住</button>';
                        }
                        res += '</div>';
                        return res;
                    }
                }
            ],
            //与服务器端传输数据
            "bServerSide" : true,//服务端处理分页
            "sAjaxSource" : "<?php echo Url::to(['order/index','order_type' => $order_type]) ?>",
            "fnServerParams": function (aoData) {  //查询条件
                aoData.push({"name": "order_no", "value": $("#order_no").val()});
                aoData.push({"name":"order_time_from","value":$("#order_time_start").val()});
                aoData.push({"name":"order_time_to","value":$("#order_time_end").val()});
            },
            "sServerMethod" : "POST",
            //"bProcessing": true,

            //多语言配置
            "oLanguage" : {
                "sProcessing" : "正在加载中......",
                "sLengthMenu" : "每页显示 _MENU_ 条记录",
                "sZeroRecords" : "对不起，查询不到相关数据！",
                "sEmptyTable" : "表中无数据存在！",
                "sInfo" : "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
                "sInfoFiltered" : "数据表中共为 _MAX_ 条记录",
                "sSearch" : "搜索订单号",
                "oPaginate" : {
                    "sFirst" : "首页",
                    "sPrevious" : "上一页",
                    "sNext" : "下一页",
                    "sLast" : "末页"
                }
            }
        });

        $('#submit').on('click',function() {

        });

        //多条件搜素
        $("#submit").on('click', function () {
            if(flag) {
                return false;
            } else {
                oTable.fnDraw();
            }
        })


        //确定入住
        $(document).on('click', 'button.confirm', function () {
            if(confirm("确定入住？")) {
                var ob = $(this);
                var id = ob.attr('id');
                var c;
                var _url;
                c = 1;
                _url = "<?php echo Url::to(['order/confirm']); ?>&id="+id;
                $.ajax({
                    url : _url,
                    success : function (data) {
                        if ( data.status > 0 ) {
                            oTable.fnDraw();
                            /*bootbox.alert(data.info, function () {
                                oTable.fnDraw();
                            });*/
                        } else {
                            bootbox.alert({
                                message : data.info,
                                title : "提示信息"
                            });
                            return false;
                        }
                    }
                })
            } else {
                return false;
            }
        })
    });
</script>
<!--<include file="Public/footer"/>-->
