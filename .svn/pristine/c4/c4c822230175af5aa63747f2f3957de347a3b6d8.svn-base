<?php
use yii\helpers\Url;

?>
<form id="ajaxForm1" class="form-horizontal" method="post" action="<?php echo Url::to(['wx-menu-click/add']); ?>"
      enctype="multipart/form-data">

    <input type="hidden" name="id"
           value="<?php echo isset($model['id']) ? $model['id'] : ''; ?>"/>
    <input type="hidden" name="acid"
           value="<?php echo !empty($acid) ? $acid : ''; ?>"/>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">

                    <ul class="nav nav-tabs" id="myTab">
                        <li>
                            <a href="<?php echo Url::to(['wx-menu-click/index']) ?>">
                                <i class="green icon-home bigger-110"></i>
                                素材列表
                            </a>
                        </li>

                        <li class="active">
                            <a href="#">
                                <i class="green icon-edit bigger-110"></i>
                                <?php echo Yii::$app->controller->action->id == 'add' ? '添加素材' : '修改素材' ?>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">素材标题</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control"
                                                               name="title">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">
                                                        消息类型
                                                    </label>
                                                    <div class="col-sm-10">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="type"
                                                                   id="type" id="Radio1_status"
                                                                   value="1" checked> 文本
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="type"
                                                                   id="Radio2_status"
                                                                   value="2"> 图片
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="type"
                                                                   id="Radio3_status"
                                                                   value="3"> 图文
                                                        </label></div>
                                                </div>
                                                <div class="form-group" id="div_text">
                                                    <label for="description" class="col-sm-2 control-label">文本消息</label>
                                                    <div class="col-sm-10">
                                                    <textarea class="form-control" rows="7" cols="15"
                                                              name="content"
                                                              id="content"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="div_pic" style="display: none">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">图片地址</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="content_pic"
                                                               name="content_pic">
                                                    </div>
                                                </div>
                                                <div id="div_pic_text" style="display: none">
                                                    <div id="div_content">
                                                        <div class="form-group">
                                                            <label for="hotel_phone"
                                                                   class="col-sm-2 control-label">标题</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control atext"
                                                                       name="text_title[]">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="hotel_phone"
                                                                   class="col-sm-2 control-label">图片地址</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control atext"
                                                                       name="pic_url[]">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="hotel_phone"
                                                                   class="col-sm-2 control-label">文章地址</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control atext"
                                                                       name="text_url[]">
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <button type="button" class="btn btn-info btn-sm"
                                                                        id="add_element">[+]
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <hr style="border: solid 1px rosybrown">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">排列序号</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control"
                                                               name="sort" value="0">
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="col-sm-3">
                                                        <button class="btn btn-success big" type="submit" id="submit">
                                                            保存
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="col-sm-3">
                                                        <button class="btn btn-danger big" type="button"
                                                                onclick="javascript:history.go(-1);">返回
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</form>


<script type="text/javascript">
    seajs.use(['$', 'form-ajax', 'bootbox'], function ($) {

        var selType = 1;

        $(":radio").on('click', function () {
            if ($(this).val() == "1") {
                $("#div_text").show();
                $("#div_pic").hide();
                $("#div_pic_text").hide();
                selType = 1
            }
            if ($(this).val() == "2") {
                $("#div_text").hide();
                $("#div_pic").show();
                $("#div_pic_text").hide();
                selType = 2;
            }
            if ($(this).val() == "3") {
                $("#div_text").hide();
                $("#div_pic").hide();
                $("#div_pic_text").show();
                selType = 3;
            }
        })

        $("#add_element").on('click', function () {
            var div_content = $(this).parent().parent().parent();

            if ($.trim($(this).text()) == '[+]') {
                var newLayer = div_content.clone(true);
                //清空input
                $.each(newLayer.find("input"), function (i, v) {
                    $(v).val('');
                });
                // +变-
                newLayer.find("button").text("[-]");
                $("#div_pic_text").append(newLayer);
            }
            else
                div_content.remove();


        });

        $(function () {
            var ajaxFrom = $('#ajaxForm1');
            ajaxFrom.ajaxForm({
                dataType: 'json',
                beforeSubmit: function (formData, jqForm, options) {
                    if (selType == 1) {
                        if ($.trim($("#content").val()) == "") {
                            bootbox.alert({
                                message: '文本消息不能为空!',
                                title: "提示信息",

                            });
                            return false;
                        }
                    }
                    if (selType == 2) {
                        if ($.trim($("#content_pic").val()) == "") {
                            bootbox.alert({
                                message: '图片地址不能为空!',
                                title: "提示信息",

                            });
                            return false;
                        }
                    }
                    if (selType == 3) {
                        var check_flag = true;
                        $.each($(".atext"), function (i, v) {
                            if ($.trim($(v).val()) == "") {
                                check_flag = false;
                            }
                        });
                        if (!check_flag) {
                            bootbox.alert({
                                message: '图文输入不能为空!',
                                title: "提示信息",

                            });
                            return false;
                        }
                    }
                    return true;
                },
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

    });

</script>
