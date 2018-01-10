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
                            <a  href="#">
                                <i class="green icon-home bigger-110"></i>
                                账户管理
                            </a>
                        </li>

                        <li>
                            <a  href="<?php echo Url::to(['account/add']) ?>">
                                <i class="green icon-edit bigger-110"></i>
                                添加账户
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div  class="tab-pane in active">
                            <div class="table-responsive">
                                <table id="sample-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">微信公众号</th>
                                        <th>用户名</th>
                                        <th>最后登录时间</th>
                                        <th>最后登录IP</th>
                                        <th>状态</th>
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
    seajs.use(['admin-common','$','dataTables',"dataTables-bootstrap"],function(admin,$){
        var oTable = $('#sample-table').dataTable({
            "bAutoWidth" : false,//是否自适应宽度
            "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],//每页显示数据量
            "aoColumns" : [ //列操作
                {
                    bSortable:false,
                    "sWidth" : "10%",
                    "mData" : "name",
                    "sClass" : "center"
                },
                {"mData" : "username",bSortable:false,"sWidth" : "15%"},
                {"mData" : "last_login_time",bSortable:false,"sWidth" : "15%"},
                {
                    "mData" : "last_login_ip",
                    "sClass" : "center",
                    bSortable:false,
                    "sWidth" : "15%"
                },
                {
                    bSortable:false,
                    "sWidth" : "10%",
                    "sClass" : "center",
                    "mData" : "status",
                    "mRender" : function (data) {
                        if(1 == data) {
                            return "正常";
                        }
                        if(2 == data) {
                            return "关闭";
                        }
                        return res;
                    }
                },
                {
                    bSortable:false,
                    "sWidth" : "10%",
                    "sClass" : "center",
                    "mData" : "acid",
                    "mRender" : function (data,type,full) {
                        var editurl = "<?php echo Url::to(['account/disable']) ?>&acid=" + data + "&sta=" + full['status'];
                        var delurl = "<?php echo Url::to(['account/delete']) ?>&id=" + full['id'];

                        var res = "<div class='hidden-sm hidden-xs action-buttons'>";
                        if(1 == full['status']) {
                            res += '<a class="btn btn-primary btn-xs" href="'+editurl+'">禁用</a>';
                        } else {
                            res += '<a class="btn btn-primaryt btn-xs" href="'+editurl+'">启用</a>';
                        }
                        res += '<span class="lbl"></span>'
                        res += "<a class='red del'  href='" + delurl + "'";
                        res += 'title="删除"> ';
                        //res += 'onclick="return confirm(&quot;确定要删除此信息吗？&quot;)">';
                        res += '<i class="ace-icon fa fa-trash-o bigger-130"></i></a></div>';
                        return res;
                    }
                }
            ],
            //与服务器端传输数据
            "bServerSide" : true,//服务端处理分页
            "sAjaxSource" : "<?php echo Url::to(['account/manage']) ?>",
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
                "sSearch" : "搜索",
                "oPaginate" : {
                    "sFirst" : "首页",
                    "sPrevious" : "上一页",
                    "sNext" : "下一页",
                    "sLast" : "末页"
                }
            }
        });


        //删除信息事件
        $(document).on('click', 'a.del', function () {
            var ob = $(this);
            console.log('pp');
            if ( confirm("确定要删除该信息吗？") ) {
                $.ajax({
                    url : ob.attr("href"),
                    success : function (data) {
                        if ( data.status > 0 ) {
                            bootbox.alert(data.info, function () {
                                oTable.fnDraw();
                            });
                        } else {
                            bootbox.alert({
                                message : data.info,
                                title : "提示信息"
                            });
                            return false;
                        }
                    }
                })
            }
            return false;
        })

        //显示隐藏事件
        $(document).on('click', 'input.ace', function () {
            var ob = $(this);
            var id = ob.attr('id');
            var c;
            var _url;
            if(ob.is(':checked')) {
                c = 1;
                _url = "<?php echo Url::to(['room-type/show']); ?>&id="+id+"&c="+c;
                console.log("<?php echo Url::to(['room-type/show']); ?>&id="+id+"&c="+c);
                $.ajax({
                    url : _url,
                    success : function (data) {
                        if ( data.status > 0 ) {
                            bootbox.alert(data.info, function () {
                                oTable.fnDraw();
                            });
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
                c = 0;
                _url = "<?php echo Url::to(['room-type/show']); ?>&id="+id+"&c="+c;
                console.log("<?php echo Url::to(['room-type/show']); ?>&id="+id+"&c="+c);
                $.ajax({
                    url : _url,
                    success : function (data) {
                        if ( data.status > 0 ) {
                            bootbox.alert(data.info, function () {
                                oTable.fnDraw();
                            });
                        } else {
                            bootbox.alert({
                                message : data.info,
                                title : "提示信息"
                            });
                            return false;
                        }
                    }
                })
            }


        })

    });
</script>
<!--<include file="Public/footer"/>-->