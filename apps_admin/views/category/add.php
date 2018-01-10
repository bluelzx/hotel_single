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
                    <li id="order_88" >
                        <a  href="<?php echo Url::to(['category/index']); ?>">
                            <i class="green icon-home bigger-110"></i>
                            模型管理
                        </a>
                    </li>

                    <li id="order_0" class="active">
                        <a  href="#">
                            <i class="green icon-edit bigger-110"></i>
                            添加模型
                        </a>
                    </li>
                </ul>
 <div class="tab-content">
                <form class="form-horizontal" method="post" action="<?php echo Url::to(['category/add']); ?>">
                <div class="row">
                    <div class="col-sm-10">
                        <!--显示外部实线框-->
                        <!--<div class="widget-box">-->
                        <!--显示外部实线框-->
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <!--酒店名称--[start]-->
                                        <div class="form-group">
                                            <label for="hotel_name" class="col-sm-2 control-label">模型名称</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="model_name" name="model_name">
                                                <span id="tips" style="color: red"></span>
                                            </div>
                                        </div>
                                        <!--酒店名称--[end]-->

                                        <!--描述--[start]-->
                                        <div class="form-group">
                                            <label for="traffic" class="col-sm-2 control-label">描述</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="3" name="desc" id="desc"></textarea>
                                            </div>
                                        </div>
                                        <!--描述--[end]-->

                                        <!--保存--[start]-->
                                     
                                        <div  style="margin-top:20px; clear:both">
                                            <div class="col-sm-3">
                                                <button class="btn btn-success big" type="submit" id="submit">保存</button>
                                            </div>
                                  
                                        <!--保存--[end]-->
                                        <!--返回--[start]-->
                         
                                            <div class="col-sm-3">
                                                <button class="btn btn-danger big" onclick="javascript:history.go(-1);">返回</button>
                                            </div>
                                        </div>
                                        <!--返回--[end]-->


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
    <!-- PAGE CONTENT END -->
</div>
<!--酒店设置--[end]-->


<script type="text/javascript">
    seajs.use(['admin-common','$','dataTables',"dataTables-bootstrap"],function(admin,$){
        var check = 0;
        $('#submit').on("click",function() {
            if(check) {
                alert("该模型名称已经存在，请重新修改");
                return false;
            } else {
                var regular_email = /^(\s)/g;
                if(!$('#model_name').val() || regular_email.test($('#model_name').val())) {
                    alert("模型名称不能为空，不能以空格开头，请填写模型名称！");
                    return false;
                }
            }

        });

        //检测模型名称
        $("#model_name").on("keyup",function() {
            checkModelName();
        });
        function checkModelName() {
            $.ajax({
                url : "<?php echo Url::to(['category/modelname']); ?>",
                data:{model_name:$("#model_name").val()},
                type: "POST",
                dataType:"json",
                success: function(data) {
                    if(data) {
                        check = 1;
                        $("#tips").html("该模型名称已经存在，请重新修改");
                    } else {
                        check = 0;
                        $("#tips").html("");
                    }
                }
            });
        }
    });
</script>
<!--<include file="Public/footer"/>-->
