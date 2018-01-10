<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            系统设置
        </h1>
    </div>
    <!-- /.page-header -->
    <!-- PAGE CONTENT BEGINS -->
    <!--页面设置--[start]-->
    <form class="form-horizontal" role="form" id="dataform">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title">页面设置</h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-xs-12">
                                    <!--Radio--[start]-->
                                    <label class="radio-inline">
                                        是否开启到店付款
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="toshop" id="Radio1_toshop" value="1"> 是
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="toshop" id="Radio2_toshop" value="0"> 否
                                    </label>
                                    <!--Radio--[end]-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
        
        <!--页面设置--[end]-->

        <!--管理员信息提醒设置--[start]-->
        <div class="row">
            <div class="col-sm-12">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title">管理员信息提醒设置</h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-xs-12">
                                    <!--Radio--[start]-->
                                    <label class="radio-inline">
                                        是否信息提醒
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="notice" id="Radio1_notice" value="1"> 是
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="notice" id="Radio2_notice" value="0"> 否
                                    </label>
                                    <!--Radio--[end]-->

                                    <!--通知用户OPENID--[start]-->
                                    <div class="form-group">
                                        <label for="user_openid" class="col-sm-2 control-label">通知用户OPENID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="user_openid" name="user_openid">
                                            <span class="help-block">请填写微信编号。系统根据微信编号获取对应公众号的openid,多个管理员请用,分离</span>
                                        </div>
                                    </div>
                                    <!--通知用户OPENID--[end]-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--管理员信息提醒设置--[end]-->


        <!--模板消息通知--[start]-->
        <div class="row">
            <div class="col-sm-12">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title">模板消息通知</h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-xs-12">
                                    <!--Radio--[start]-->
                                    <label class="radio-inline">
                                        是否开启
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                        <input type="radio" name="tpl_notice" id="tpl_notice0" value="1"> 是
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="tpl_notice" id="tpl_notice1" value="0"> 否
                                    </label>
                                    <!--Radio--[end]-->

                                    <!--管理员新订单通知提醒模板ID--[start]-->
                                    <div class="form-group">
                                        <label for="booking" class="col-sm-2 control-label">管理员新订单通知提醒模板ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="booking" name="booking">
                                            <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                        </div>
                                    </div>
                                    <!--管理员新订单通知提醒模板ID--[end]-->

                                    <!--管理员酒店退房/退款通知提醒模板ID--[start]-->
                                    <div class="form-group">
                                        <label for="unsubscribe" class="col-sm-2 control-label">管理员酒店退房/退款通知提醒模板ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="unsubscribe" name="unsubscribe">
                                            <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                        </div>
                                    </div>
                                    <!--管理员酒店退房/退款通知提醒模板ID--[end]-->

                                    <!--等待付款通知提醒模板ID--[start]-->
                                    <div class="form-group">
                                        <label for="waiting" class="col-sm-2 control-label">等待付款通知提醒模板ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="waiting" name="waiting">
                                            <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                        </div>
                                    </div>
                                    <!--等待付款通知提醒模板ID--[end]-->

                                    <!--酒店预订成功通知提醒模板ID--[start]-->
                                    <div class="form-group">
                                        <label for="book_success" class="col-sm-2 control-label">酒店预订成功通知提醒模板ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="book_success" name="book_success">
                                            <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                        </div>
                                    </div>
                                    <!--酒店预订成功通知提醒模板ID--[end]-->

                                    <!--酒店退订成功通知提醒模板ID--[start]-->
                                    <div class="form-group">
                                        <label for="unsubscribe_success" class="col-sm-2 control-label">酒店退订成功通知提醒模板ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="unsubscribe_success" name="unsubscribe_success">
                                            <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                        </div>
                                    </div>
                                    <!--酒店退订成功通知提醒模板ID--[end]-->

                                    <!--订单退款处理通知提醒模板ID--[start]-->
                                    <div class="form-group">
                                        <label for="unsubscribe_handle" class="col-sm-2 control-label">订单退款处理通知提醒模板ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="unsubscribe_handle" name="unsubscribe_handle">
                                            <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                        </div>
                                    </div>
                                    <!--订单退款处理通知提醒模板ID--[end]-->

                                    <!--保存--[start]-->
                                    <div class="col-sm-3">
                                     
                                            <button class="btn btn-success big" type="button" id="submit">保 存</button>
                                      
                                    </div>
                                    <!--保存--[end]-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--模板消息通知--[end]-->
        <?php $form = ActiveForm::end(); ?>
    </form>
    <!-- PAGE CONTENT END -->
</div>
</div>
</div>

<script type="text/javascript">
    var submit = 0;
    var first = 1;
    seajs.use('$',function($){
        $("#submit").on("click",function() {
            submit = 1;
            if(!$("input:radio[name='toshop']:checked").val()) {
                alert("请选择是否开启到店付款");
                return false;
            }
            if(!$("input:radio[name='notice']:checked").val()) {
                alert("请选择是否信息提醒");
                return false;
            }
            if(!$("input:radio[name='tpl_notice']:checked").val()) {
                alert("请选择是否开启模板消息通知");
                return false;
            }
            //console.log(submit);
            ajaxSubmit(submit,0);
        });
        //首次打开页面进行页面数据初始化
        ajaxSubmit(0,first);

    });

    function ajaxSubmit(_param1, _param2) {
        if(1 == _param1 || 1 == _param2) {
            //console.log($("#dataform").serialize());
            $.ajax({
                url : "<?php echo Url::to(['basic/index']); ?>",
                type: "POST",
                dataType:"json",
                data: (1 == _param2)? "" : $("#dataform").serialize(),
                success: function(data) {
                    if(data!='' && data!=null && data!=undefined) {
                        //是否开启到店付
                        data['is_toshop']==1 ? $("#Radio1_toshop").attr('checked','checked') : $("#Radio2_toshop").attr('checked','checked');
                        //是否信息提醒
                        data['is_notice']==1 ? $("#Radio1_notice").attr('checked','checked') : $("#Radio2_notice").attr('checked','checked');
                        //用户id
                        $("#user_openid").val(data['tpl_user']);
                        //是否开启模板消息通知
                        data['is_tpl_notice']==1 ? $("#tpl_notice0").attr('checked','checked') : $("#tpl_notice1").attr('checked','checked');
                        //管理员新订单通知
                        $('#booking').val(data['tpl_booking']);
                        //管理员酒店退房退款通知
                        $('#unsubscribe').val(data['tpl_unsubscribe']);
                        //等待付款通知提醒
                        $('#waiting').val(data['tpl_waiting']);
                        //酒店预订成功
                        $('#book_success').val(data['tpl_book_success']);
                        //酒店退订成功
                        $('#unsubscribe_success').val(data['tpl_unsubscribe_success']);
                        //
                        $('#unsubscribe_handle').val(data['tpl_unsubscribe_handle']);
                        if(!_param2) {
                            alert("数据保存成功");
                        }
                    }

                }
            });//end of ajax
        }
    }


</script>
<!--<include file="Public/footer"/>-->
