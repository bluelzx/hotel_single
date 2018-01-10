<?php
use yii\helpers\Url;

?>
<div class="page-content">
    <!-- /.page-header -->
    <!-- PAGE CONTENT BEGINS -->

    <div class="row">
        <div class="col-xs-12">
            <div class="row">

<!--                <ul class="nav nav-tabs" id="myTab">
                    <li id="order_88" class="active">
                        <a  href="#">
                            <i class="green icon-home bigger-110"></i>
                            模型管理
                        </a>
                    </li>

                    <li id="order_0">
                        <a  href="<?php /*echo Url::to(['category/add']) */?>">
                            <i class="green icon-edit bigger-110"></i>
                            添加模型
                        </a>
                    </li>
                </ul>-->
                <div class="tab-content">
                    <div  class="tab-pane in active">
                        <div class="table-responsive">
                            <table id="sample-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">模型名称</th>
                                    <th>模型描述</th>
                                    <th>属性数</th>
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
                    "mData" : "name",
                    "sClass" : "center"
                },
                {"mData" : "desc",bSortable:false,"sWidth" : "15%"},
                {"mData" : "count",bSortable:false,"sWidth" : "15%"},
                {
                    bSortable:false,
                    "sWidth" : "20%",
                    "sClass" : "center",
                    "mData" : "id",
                    "mRender" : function (data,type,full) {
                        var listurl = "<?php echo Url::to(['category/attr-list']) ?>&id=" + data;
                        var editurl = "<?php echo Url::to(['category/modify']) ?>&id=" + data;
                        var res = "<div class='hidden-sm hidden-xs action-buttons'>";
                        res += '<a class="btn btn-primary btn-xs" href="'+listurl+'" >属性列表</a>';
                        res += '<a class="btn btn-primary btn-xs" href="'+editurl+'" >编辑</a>';
                        res += '</div>';
                        return res;
                    }
                }
            ],
            //与服务器端传输数据
            "bServerSide" : true,//服务端处理分页
            "sAjaxSource" : "<?php echo Url::to(['category/index']); ?>",
            "sServerMethod" : "POST"

        });
    });
</script>
<!--<include file="Public/footer"/>-->
