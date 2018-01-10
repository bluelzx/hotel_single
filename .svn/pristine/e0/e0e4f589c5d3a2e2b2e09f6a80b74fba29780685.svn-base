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
                        <a href="<?php echo Url::to(['index']); ?>">
                            <i class="green icon-home bigger-110"></i>
                            全部订单
                        </a>
                    </li>

                    <li id="order_0">
                        <a href="<?php echo Url::to(['index', 'refund_status' => 0]); ?>">
                            <i class="green icon-edit bigger-110"></i>
                            未处理
                        </a>
                    </li>

                   <!-- <li id="order_1">
                        <a href="<?php /*echo Url::to(['index', 'refund_status' => 1]); */?>">
                            <i class="green icon-edit bigger-110"></i>
                            已处理
                        </a>
                    </li>-->

                    <li id="order_2">
                        <a href="<?php echo Url::to(['index', 'refund_status' => 2]); ?>">
                            <i class="green icon-edit bigger-110"></i>
                            已完成
                        </a>
                    </li>

                   <!-- <li id="order_3">
                        <a href="<?php /*echo Url::to(['index', 'refund_status' => 3]); */?>">
                            <i class="green icon-edit bigger-110"></i>
                            已关闭
                        </a>
                    </li>-->


                </ul>
                &nbsp;
                &nbsp;
                <div>

                    <div class="boxsee">
                        订单号：<input name="order_no" id="order_no">

                        退款时间：<input style="border:1px solid #ccc" name="order_time_from" id="order_time_from" readonly>
                        至 <input style="border:1px solid #ccc" name="order_time_to" id="order_time_to" readonly>
                        <button type="submit" id="submit" class="btn btn-warning btn-xs">查询</button>
                    </div>

                </div>
                &nbsp;
                &nbsp;
                <div class="tab-content">
                    <div class="tab-pane in active">
                        <div class="table-responsive">
                            <table id="sample-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr role="row">
                                    <th>订单号</th>
                                    <th>房型</th>
                                    <th>姓名</th>
                                    <th>电话</th>
                                    <th>付款金额</th>
                                    <th>退款金额</th>
                                    <th>退订房数</th>
                                    <th>退房原因</th>
                                    <th>当前状态</th>
                                    <th>下单/退款时间</th>
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


<!--手动处理订单--[start]-->


<form id="ajaxForm1" method="post" action="<?php echo Url::to(['refund']); ?>">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">退款订单手动处理</h4>
                </div>
                <div class="modal-body">
                    <h4>订单金额：<span id="total1" style="color:green"></span></h4>
                    <br/>
                    <h4>退款金额：<span id="total2" style="color:red"></span></h4>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="order_on" name="order_on" value="">
                    <input type="submit" value="申请退款" class="btn btn-primary">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>

<div class="modal fade" id="queryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">微信退款实际到账查询</h4>
            </div>
            <div class="modal-body">
                <h4>当前实际退款状态：<span id="order_status" style="color:red"></span></h4>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="order_on" name="order_on" value="">
                <input type="submit" value="申请退款" class="btn btn-primary">
                <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="/js/admin/js/datetime/laydate.js"></script>
<script>
    ;
    !function () {

        laydate.skin('molv');

        laydate({
            elem: '#order_time_from'   //created_time_to
        })

        laydate({
            elem: '#order_time_to'   //created_time_to
        })

    }();
</script>
<script src="/js/admin/js/Calendar.js"></script>
<script type="text/javascript">
    seajs.use(['admin-common', '$', 'dataTables', "dataTables-bootstrap"], function (admin, $) {
        $(document).ready(function () {
            $id = "<?php echo $refund_status; ?>";
            $('#order_' + $id).attr('class', 'active');
            if ($id == '') {

                $('#order_88').attr('class', 'active');
            }

        });

        var oTable = $('#sample-table').dataTable({
            "bAutoWidth": false,//是否自适应宽度

            "bFilter": false,//把搜索关了

            "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],//每页显示数据量,下拉列表
            "aoColumns": [ //列操作
                {
                    bSortable: false,
                    "sWidth": "10%",
                    "mData": "order_on",
                    "sClass": "center"
                },
                {
                    "mData": "goods_name", "sClass": "center",
                    bSortable: false, "sWidth": "10%"
                },
                {"mData": "real_name", "sClass": "center", bSortable: false, "sWidth": "5%"},
                {"mData": "phone", "sClass": "center", bSortable: false, "sWidth": "10%"},
                {"mData": "totalc_price", "sClass": "center", bSortable: false, "sWidth": "5%"},
                {"mData": "amount", "sClass": "center", bSortable: false, "sWidth": "5%"},
                {"mData": "room_count", "sClass": "center", bSortable: false, "sWidth": "5%"},
                {"mData": "reason_content", "sClass": "center", bSortable: false, "sWidth": "10%"},
                {
                    "mData": "refund_status",
                    "sClass": "center",
                    bSortable: false,
                    "sWidth": "10%",
                    "mRender": function (data, type, full) {
                        if (0 == data) {
                            return '<span class="badge badge-pink">未处理</span>';
                        }
                        if (1 == data) {
                            return '<span class="badge badge-green">处理中</span>';
                        }
                        if (2 == data) {
                            return '<span class="badge badge-success">已完成</span><a href="#queryModal" role="button" data-orderno="' + full['order_on'] + '" data-acid="' + full['acid'] + '" class="badge badge-info refund" data-toggle="modal">查询</a>';
                        }
                        if (3 == data) {
                            return '<span class="badge badge-purple">已关闭</span>';
                        }

                    }
                },
                {
                    "mData": function (e) {
                        return e.order_time + '/<br />' + e.created_time;
                    },
                    "sClass": "center", bSortable: false, "sWidth": "15%"
                },
                {
                    bSortable: false,
                    "sWidth": "15%",
                    "sClass": "center",
                    "mData": "order_id",
                    "mRender": function (data, type, full) {

                        var editurl = "<?php echo Url::to(['handle']) ?>&order_id=" + data;
                        var res = "<div class='hidden-sm hidden-xs action-buttons'>";

                        if (full['refund_status'] < 2) {//状态码小于2才有弹出框才能处理
                            res += '<a href="#myModal"   onclick="showdiv(' + full['order_on'] + ',' + full['totalc_price'] + ')" role="button" id="orderhandle" class="btn btn-primary btn-xs" data-toggle="modal">订单处理</a>';
                        } else {
                            res += '<a  role="button" id="orderhandle"  class="btn btn-xs" data-toggle="modal">订单处理</a>';
                        }

                        /*  res += '<a onclick="showdiv('+full['order_on']+')" class="btn btn-primary btn-xs" >订单处理</a>'; */
                        //res += 'onclick="return confirm(&quot;确定要删除此信息吗？&quot;)">';
                        res += '</div>';
                        return res;
                    }
                }
            ],
            //与服务器端传输数据
            "bServerSide": true,//服务端处理分页
            "sAjaxSource": "<?php echo Url::to(['index', 'refund_status' => $refund_status]) ?>",
            "fnServerParams": function (aoData) {  //查询条件
                aoData.push({"name": "order_no", "value": $("#order_no").val()});
                aoData.push({"name": "order_time_from", "value": $("#order_time_from").val()});
                aoData.push({"name": "order_time_to", "value": $("#order_time_to").val()});
            },

            "sServerMethod": "POST",
            //"bProcessing": true,

            //多语言配置
            "oLanguage": {
                "sProcessing": "正在加载中......",
                "sLengthMenu": "每页显示 _MENU_ 条记录",
                "sZeroRecords": "对不起，查询不到相关数据！",
                "sEmptyTable": "表中无数据存在！",
                "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
                "sInfoFiltered": "数据表中共为 _MAX_ 条记录",
                "sSearch": "搜索",
                "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "上一页",
                    "sNext": "下一页",
                    "sLast": "末页"
                }
            }
        });


        //多条件搜素
        $("#submit").on('click', function () {
            oTable.fnDraw();
            // alert();
        })

        $(function () {
            var ajaxFrom = $('#ajaxForm1');
            ajaxFrom.ajaxForm({
                dataType: 'json',
                success: function (data) {
                    if (data.status > 0 && data.url) {
                        bootbox.confirm(data.info, function (result) {
                            if (result) {
                                window.location.href = data.url;
                                return false;
                            }
                        });
                    } else {
                        bootbox.alert({
                            message: data.info,
                            title: "提示信息",

                        });
                        return false;
                    }
                }
            })

        })

        //删除信息事件
        $(document).on('click', 'a.refund', function () {
            $("#order_status").html('');
            $.ajax({
                type: 'post',
                url: '<?php echo Url::to(['order-refund/query-refund']) ?>',
                data: {'order_no': $(this).attr('data-orderno'), 'acid': $(this).attr('data-acid')},
                success: function (data) {
                    if (data.status > 0) {
                        $("#order_status").html(data.info);
                    } else {
                        bootbox.alert({
                            message: data.info,
                            title: "提示信息"
                        });
                        return false;
                    }
                }
            })
        });

    })
    ;

    //退款订单处理  弹出层
    function showdiv(order_on, total_fee) {
        document.getElementById("order_on").value = order_on;
        document.getElementById("total1").innerText = total_fee + '元';
        document.getElementById("total2").innerText = total_fee + '元';
    }


</script>
