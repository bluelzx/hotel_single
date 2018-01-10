<?php
use yii\helpers\Url;

?>

<div class="page-content">
    <form class="form-horizontal" method="post" action="<?php echo Url::to(['category/add-attr','type_id'=>$type_id]); ?>">
        <!-- /.page-header -->
        <!-- PAGE CONTENT BEGINS -->
        <!--酒店设置--[start]-->
            <div class="row">
                <div class="col-sm-12">
                    <!--显示外部实线框-->
                    <!--<div class="widget-box">-->
                    <!--显示外部实线框-->
                    <div class="widget-body">
                        <ul class="nav nav-tabs" id="myTab">
                            <li>
                                <a  href="#" onclick="javascript:history.go(-1);">
                                    <i class="green icon-home bigger-110"></i>
                                    属性管理
                                </a>
                            </li>

                            <li class="active">
                                <a  href="">
                                    <i class="green icon-edit bigger-110"></i>
                                    添加属性
                                </a>
                            </li>
                        </ul>       
                        <div class="widget-main">
                  
                            <div class="row">
                                <div class="col-xs-12">
                                    <!--属性名称--[start]-->
                                    <div class="form-group">
                                        <label for="hotel_name" class="col-sm-2 control-label">属性名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attr_name" name="attr_name">
                                        </div>
                                    </div>
                                    <!--属性名称--[end]-->

                                    <!--属性可选值--[start]-->
                                    <div class="form-group">
                                        <label for="traffic" class="col-sm-2 control-label">属性可选值</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="3" name="attr_value" id="attr_value"></textarea>
                                            <span class="help-block">一行代表一个可选择</span>
                                        </div>
                                    </div>
                                    <!--属性可选值--[end]-->

                                    <!--属性类型--[start]-->
                                   <div class="form-group">
                                            <!--Radio--[start]-->
                                            <label class="control-label col-sm-2 ">
                                                属性类型
                                            </label>
                                              <div class="col-sm-10">
                                            <label class="radio-inline">
                                                <input type="radio" name="type" id="Radio1_toshop" value="0"> 手动填写
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="type" id="Radio2_toshop" value="1"> 单选
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="type" id="Radio3_toshop" value="2"> 复选
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="type" id="Radio4_toshop" value="3"> 下拉列表
                                            </label>
                                            </div>
                                            <!--Radio--[end]-->
                                        </div>
                                  
                                    <!--属性类型--[end]-->

                                    <!--属性名称--[start]-->
                                    <div class="form-group">
                                        <label for="hotel_name" class="col-sm-2 control-label">后缀描述</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="attr_suffix_text" name="attr_suffix_text">
                                        </div>
                                    </div>
                                    <!--属性名称--[end]-->

                                    <!--保存--[start]-->
                                    <div class="">
                                        <div class="col-sm-3">
                                            <button class="btn btn-success big" type="submit" id="submit">保存</button>
                                        </div>
                                    </div>
                                    <!--保存--[end]-->
                                    <!--返回--[start]-->
                                    <div class="">
                                        <div class="col-sm-3">
                                            <button class="btn btn-danger big" onclick="javascript:history.go(-1);">返回</button>
                                        </div>
                                    </div>
                                    <!--返回--[end]-->


                                
                            </div>
                        </div>
                    </div>
                </div>
            </div> </div>

        </form>
</div>




<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
<script type="text/javascript">

    var submit = 0;
    var first = 1;
    seajs.use(['$','sel'],function($,sel){
        $("#submit").on("click",function() {
            var regular_email = /^(\s)/g;
            if(!$('#attr_name').val()  || regular_email.test($('#attr_name').val())) {
                alert("属性名称不能为空！");
                return false;
            }
            if(!$("#attr_value").val() || regular_email.test($('#attr_value').val())) {
                alert("属性值不能为空！");
                return false;
            }
            var v = $("input:radio[name='type']:checked").val();
            if(v == null) {
                alert("请选属性类型");
                return false;
            }
        });
    });

    function ajaxSubmit(_param1, _param2,sel) {
        if(1 == _param1 || 1 == _param2) {
            $.ajax({
                url : "<?php echo Url::to(['hotel/index']); ?>",
                type: "GET",
                dataType:"json",
                success: function(data) {
                }
            });//end of ajax
        }
    }
</script>
<!--<include file="Public/footer"/>-->
