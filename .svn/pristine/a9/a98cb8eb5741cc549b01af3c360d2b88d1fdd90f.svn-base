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
                    <li id="order_88" class="active">
                        <a  href="#">
                            <i class="green icon-home bigger-110"></i>
                            属性管理
                        </a>
                    </li>

                    <li id="order_0">
                        <a  href="<?php echo Url::to(['category/add-attr','type_id' => $id]) ?>">
                            <i class="green icon-edit bigger-110"></i>
                            添加属性
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div  class="tab-pane in active">
                        <div class="table-responsive">
                            <table id="sample-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">序列</th>
                                    <th>属性名称</th>
                                    <th>属性类型</th>
                                    <th>属性可选值</th>
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


<script type="text/javascript">
    seajs.use(['admin-common','$','dataTables',"dataTables-bootstrap"],function(admin,$){
        var oTable = $('#sample-table').dataTable({
            "bAutoWidth" : false,//是否自适应宽度
            "bFilter" : false, //关闭搜索功能
            "bPaginate" : false, //关闭表格分页
            "bInfo" : false,
            "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],//每页显示数据量
            "aoColumns" : [ //列操作
                {
                    bSortable:false,
                    "sWidth" : "10%",
                    "mData" : "id",
                    "sClass" : "center"
                },
                {"mData" : "attr_name",bSortable:false,"sWidth" : "15%"},
                {
                    "mData" : "attr_type",
                    bSortable:false,"sWidth" : "15%",
                    "mRender" : function (data,type,full) {
                        if(0 == data) {
                            return '<span>手动填写</span>';
                        }
                        if(1 == data) {
                            return '<span>单选</span>';
                        }
                        if(2 == data) {
                            return '<span>复选</span>';
                        }
                        if(3 == data) {
                            return '<span>下拉框</span>';
                        }
                    }
                },
                {
                    bSortable:false,
                    "sWidth" : "20%",
                    "sClass" : "center",
                    "mData" : "attr_option_values"
                },
                {
                    bSortable:false,
                    "sWidth" : "20%",
                    "sClass" : "center",
                    "mData" : "id",
                    "mRender" : function (data,type,full) {
                        var editurl = "<?php echo Url::to(['category/edit-attr','type_id'=>$id]) ?>&id=" + data;
                        var delurl = "<?php echo Url::to(['category/delete-attr','type_id'=>$id]) ?>&id=" + data;
                        var res = "<div class='hidden-sm hidden-xs action-buttons'>";
                        res += '<a class="green" href="'+editurl+'" title="修改">';
                        res += '<i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                        res += "<a class='red del'  href='" + delurl + "'";
                        res += 'title="删除"> ';
                        res += '<i class="ace-icon fa fa-trash-o bigger-130"></i></a></div>';
                        return res;
                    }
                }
            ],
            //与服务器端传输数据
            "bServerSide" : true,//服务端处理分页
            "sAjaxSource" : "<?php echo Url::to(['category/attr-list','id'=>$id]); ?>",
            "sServerMethod" : "POST"

        });

        //删除信息事件
        $(document).on('click', 'a.del', function () {
            var ob = $(this);
            console.log('pp');
            if ( confirm("确定要删除该信息吗？") ) {
                $.ajax({
                    url : ob.attr("href"),
                    success : function (data) {
                        console.log(data);
                        if ( data) {
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
    });
</script>
<!--<include file="Public/footer"/>-->
