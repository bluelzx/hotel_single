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
                                    <th class="center">房型</th>
                                    <th>房号</th>
                                    <th>是否特价</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <?php foreach($rows as $k => $val) { echo "<tr>";
                                    echo "<td>"; echo  $val['name']; echo "</td>";
                                    echo "<td>"; echo  $val['room_no']; echo "</td>";
                                    echo "<td>"; echo  $val['is_special']; echo "</td>";
                                    echo "<td>"; echo  $val['status']; echo "</td>";
                                    echo "<td>";
                                    echo "<div class='hidden-sm hidden-xs action-buttons'>";
                                    echo "<a class='green' href='".Url::to(['room/update','id'=>$val['id']])."' title='修改'>";
                                    echo '<i class="ace-icon fa fa-pencil bigger-130"></i></a>';
                                    if(1 == $val['status']) {
                                        echo "<input type='checkbox' class='ace' id='".$val['id']."' checked/>";
                                    } else {
                                        echo "<input type='checkbox' class='ace' id='".$val['id']."' />";
                                    }
                                    echo '<span class="lbl"></span>';
                                    echo "<a class='red del'  href='".Url::to(['room/del','id'=>$val['id']])."'";
                                    echo 'title="删除"> ';
                                    echo '<i class="ace-icon fa fa-trash-o bigger-130"></i></a></div>';
                                    echo "</td>";
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


<script type="text/javascript">
    seajs.use(['admin-common','$','dataTables',"dataTables-bootstrap"],function(admin,$){
        //删除信息事件
        $(document).on('click', 'a.del', function () {
            var ob = $(this);
            if ( confirm("确定要删除该信息吗？") ) {
                $.ajax({
                    url : ob.attr("href"),
                    success : function (data) {
                        if ( data.status > 0 ) {
                            history.go(0);
                            bootbox.alert(data.info, function () {
                                //oTable.fnDraw();
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
                                //oTable.fnDraw();
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
                                //oTable.fnDraw();
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