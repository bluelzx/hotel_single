<?php
use yii\helpers\Url;

?>
<div class="page-content">
    <!-- /.page-header -->
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                            <a href="<?php echo Url::to(['wx-menu-click/index']) ?>">
                                <i class="green icon-home bigger-110"></i>
                                素材列表
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo Url::to(['wx-menu-click/add']) ?>">
                                <i class="green icon-edit bigger-110"></i>
                                添加素材
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane in active">
                            <div class="table-responsive">
                                <table id="sample-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>素材名称</th>
                                        <th>类型</th>
                                        <th>创建时间</th>
                                        <th>排序</th>
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
    </div>
    <!-- PAGE CONTENT END -->
</div>
</div>
</div>

<script type="text/javascript">
    seajs.use(['admin-common', '$', 'dataTables', "dataTables-bootstrap"], function (admin, $) {
        var oTable = $('#sample-table').dataTable({
            "aaSorting": [[0, "desc"]], //默认的排序方式，第1列，降序排列
            "bAutoWidth": false,//是否自适应宽度
            "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],//每页显示数据量
            "bFilter": false,
            "aoColumns": [ //列操作
                {"mData": "title", "bSortable": false, "sWidth": "15%"},
                {
                    "mData": "type",
                    "bSortable": false,
                    "sWidth": "15%",
                    "mRender": function (data) {
                        if (data == '1')
                            return '文本素材';
                        else if (data == '2')
                            return '图片素材';
                        else
                            return '图文素材';
                    }
                },
                {"mData": "created_at", "bSortable": false, "sWidth": "20%"},
                {"mData": "sort", "bSortable": false, "sClass": "center", "sWidth": "5%"},
                {
                    "bSortable": false,
                    "sWidth": "20%",
                    "sClass": "center",
                    "mData": "id",
                    "mRender": function (data) {
                        var editurl = "<?php echo Url::to(['wx-menu-click/update']) ?>&id=" + data;
                        var delturl = "<?php echo Url::to(['wx-menu-click/del']) ?>&id=" + data;

                        var res = "<div class='hidden-sm hidden-xs action-buttons'>";
                        res += '<a class="green" href="' + editurl + '" title="修改">';
                        res += '<i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                        res += "<a class='red del'  href='" + delturl + "'";
                        res += 'title="删除"> ';
                        //res += 'onclick="return confirm(&quot;确定要删除此信息吗？&quot;)">';
                        res += '<i class="ace-icon fa fa-trash-o bigger-130"></i></a></div>';
                        return res;
                    }
                }
            ],
            //与服务器端传输数据
            "bServerSide": true,//服务端处理分页
            "sAjaxSource": "<?php echo Url::to(['wx-menu-click/index']) ?>",
            "fnServerParams": function (aoData) {  //查询条件
                aoData.push({"name": "title", "value": $("#title").val()});
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
                //"sSearch": "搜索",
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
        })

        //删除信息事件
        $(document).on('click', 'a.del', function () {
            var ob = $(this);
            if (confirm("确定要删除该信息吗？")) {
                $.ajax({
                    url: ob.attr("href"),
                    success: function (data) {
                        if (data.status > 0) {
                            bootbox.alert(data.info, function () {
                                oTable.fnDraw();
                            });
                        } else {
                            bootbox.alert({
                                message: data.info,
                                title: "提示信息"
                            });
                            return false;
                        }
                    }
                })
            }
            return false;
        })

    });
</script>
<!--<include file="Public/footer"/>-->
