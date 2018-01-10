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
                                房间管理
                            </a>
                        </li>

                        <li>
                            <a  href="<?php echo Url::to(['room/add']) ?>">
                                <i class="green icon-edit bigger-110"></i>
                                添加房间
                            </a>
                        </li>
                    </ul>
                    &nbsp;
                    &nbsp;
                    <div>

                        <div class="boxsee">
                            房型：<select name="room_type" id="room_type">
                                <option value="">--房型查询--</option>
                                <?php foreach($rooms as $room) {
                                    echo "<option value='".$room['name']."'>".$room['name']."</option>";
                                } ?>
                            </select>
                            房号：<input name="room_no" id="room_no"  style="border:1px solid #ccc; height:30px;"> <button type="submit" id="submit"  class="btn btn-warning btn-xs">查询</button>
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
                                        <th class="center">房型</th>
                                        <th>房号</th>
                                        <th>是否特价</th>
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


<script type="text/javascript">
    seajs.use(['admin-common','$','dataTables',"dataTables-bootstrap"],function(admin,$){
        $("#submit").on("click",function() {
            if(!$("#room_no").val() && !$("#room_type").val()) {
                alert("请选择或填写查询条件！");
                return false;
            }
            var regular_mobile = /^[0-9]*$/;
            if(!regular_mobile.test($("#room_no").val())) {
                alert("房间号只能为数字");
                return false;
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
                    "mData" : "name",
                    "sClass" : "center"
                },
                {"mData" : "room_no",bSortable:false,"sWidth" : "15%"},
                {"mData" : "is_special",
                    bSortable:false,
                    "sWidth" : "15%",
                    "mRender":function(data) {
                        if(1 == data)
                            return '<span class="label label-sm label-success">是</span>';
                        else
                            return '<span class="label label-sm label-warning">否</span>';
                    }
                },
                {
                    "mData" : "status",
                    "sClass" : "center",
                    bSortable:false,
                    "sWidth" : "15%",
                    "mRender":function(data) {
                        if(1 == data)
                            return '<span class="label label-sm label-success">显示</span>';
                        else
                            return '<span class="label label-sm label-warning">隐藏</span>';
                    }
                },
                {
                    bSortable:false,
                    "sWidth" : "10%",
                    "sClass" : "center",
                    "mData" : "id",
                    "mRender" : function (data,type,full) {
                        var editurl = "<?php echo Url::to(['room/update']) ?>&id=" + data;
                        var delturl = "<?php echo Url::to(['room/del']) ?>&id=" + data;
                        var res = "<div class='hidden-sm hidden-xs action-buttons'>";
                        res += '<a class="green" href="'+editurl+'" title="修改">';
                        res += '<i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                        if(1 == full['status']) {
                            res += "<input type='checkbox' class='ace' id='"+data+"' checked/>";
                        } else {
                            res += "<input type='checkbox' class='ace' id='"+data+"' />";
                        }
                        res += '<span class="lbl"></span>'
                        res += "<a class='red del'  href='" + delturl + "'";
                        res += 'title="删除"> ';
                        //res += 'onclick="return confirm(&quot;确定要删除此信息吗？&quot;)">';
                        res += '<i class="ace-icon fa fa-trash-o bigger-130"></i></a></div>';
                        return res;
                    }
                }
            ],
            //与服务器端传输数据
            "bServerSide" : true,//服务端处理分页
            "sAjaxSource" : "<?php echo Url::to(['room/index']) ?>",
            "fnServerParams": function (aoData) {  //查询条件
                aoData.push({"name": "room_type", "value": $("#room_type").val()});
                aoData.push({"name":"room_no","value":$("#room_no").val()});
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
                "sSearch" : "搜索",
                "oPaginate" : {
                    "sFirst" : "首页",
                    "sPrevious" : "上一页",
                    "sNext" : "下一页",
                    "sLast" : "末页"
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
                _url = "<?php echo Url::to(['room/show']); ?>&id="+id+"&c="+c;
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
                _url = "<?php echo Url::to(['room/show']); ?>&id="+id+"&c="+c;
                console.log("<?php echo Url::to(['room/show']); ?>&id="+id+"&c="+c);
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