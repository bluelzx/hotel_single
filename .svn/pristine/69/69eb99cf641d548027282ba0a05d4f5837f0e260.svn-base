<?php
use yii\helpers\Url;

?>
<form class="form-horizontal" method="post" action="<?php echo Url::to(['room-type/update','id'=>$id]); ?>" enctype="multipart/form-data">
<div class="page-content">
    <!-- /.page-header -->
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <div class="row">

                    <ul class="nav nav-tabs" id="myTab">
                        <li>
                            <a  href="<?php echo Url::to(['room-type/index']) ?>">
                                <i class="green icon-home bigger-110"></i>
                                房型管理
                            </a>
                        </li>

                        <li  class="active">
                            <a  href="<?php echo Url::to(['room-type/update']) ?>">
                                <i class="green icon-edit bigger-110"></i>
                                修改房型
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="row">
                            <div class="col-sm-10">
                                <!--显示外部实线框-->
                                <!--<div class="widget-box">-->
                                <!--显示外部实线框-->
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-xs-12">

                                                <!--房型--[start]-->
                                                <div class="form-group">
                                                    <label for="integral" class="col-sm-2 control-label">房型</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="room_name" name="room_name" autocomplete="off">
                                                        <span id="tips" style="color: red"></span>
                                                    </div>
                                                </div>
                                                <!--房型--[end]-->

                                                <!--缩略图--[start]-->
                                                  <div class="form-group">
                            <label for="thumb"  class="col-sm-2 control-label">缩略图</label>
                               <div class="col-sm-8">
                                  <input class="form-control" type="" id="thumb_val" readonly>
                                   </div>
                            <div class="col-sm-2">
                            <span class="btn btn-info btn-sm fileinput-button">
                                    
                                        <span>+ 浏览图片</span>
                                        <input type="file" id="thumb" name="thumb">
                                    </span>
                                    </div>
                                   </div>
                                                <!--缩略图--[end]-->

                                                <!--房间参数--[start]-->
                                                <div class="form-group">
                                                    <div class="form-group" id="room_detail">
                                                    <label for="form-field-select-1" class="col-sm-2 control-label" id="room_par">房间参数</label>
                                                    </div>
                                                <!--房间参数--[end]-->

                                                <!--房间数量--[start]-->
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">房间数量</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="room_count" name="room_count">
                                                    </div>
                                                </div>
                                                <!--房间数量--[end]-->

                                                <!--促销信息--[start]-->
                                                <!--<div class="form-group">
                                                    <label for="description" class="col-sm-2 control-label">促销信息</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" name="sales" id="sales"></textarea>
                                                        <span class="help-block">房间的促销信息（选填）</span>
                                                    </div>
                                                </div>-->
                                                <!--促销信息--[end]-->

                                                <!--其他说明--[start]-->
                                                <!--<div class="form-group">
                                                    <label for="description" class="col-sm-2 control-label">其他说明</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" rows="3" name="other" id="other"></textarea>
                                                        <span class="help-block">房间的特别说明（选填）</span>
                                                    </div>
                                                </div>-->
                                                <!--其他说明--[end]-->

                                                <!--排序--[start]-->
                                                <div class="form-group">
                                                    <label for="hotel_phone" class="col-sm-2 control-label">排序</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="display_order" name="display_order">
                                                    </div>
                                                </div>
                                                <!--排序--[end]-->

                                                <!--状态--[start]-->
                                                <div class="form-group">
                                                    <div class="col-sm-2">
                                                        <!--Radio--[start]-->
                                                        <label class="radio-inline">
                                                            状态
                                                        </label></div>
                                                              <div class="col-sm-10">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="Radio1_status" value="1"> 显示
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" id="Radio2_status" value="0"> 隐藏
                                                        </label></div>
                                                        <!--Radio--[end]-->
                                                        <span class="help-block">手机前台是否显示</span>
                                                    </div>
                                                </div>
                                                <!--状态--[end]-->

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
                                                        <button class="btn btn-danger big" onclick="javascript:history.go(-1);return false;">返回</button>
                                                    </div>
                                                </div>
                                                <!--返回--[end]-->
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
    <!-- PAGE CONTENT END -->
</div>
<!--酒店设置--[end]-->
</form>



<!--隐藏元素--[start]-->
<div class="col-xs-12 col-sm-5" style="display: none" id="clone">
    <div class="input-group">
		<span class="input-group-addon">
			<span id="room_acr">房间面积</span>
		</span>

        <input type="text" class="form-control" name="area" id="area"/>
			<span class="input-group-btn" id="btn">
				<button type="button" class="btn btn-purple btn-sm">
                    <span class=" fa  icon-on-right bigger-110 suffix">平方米</span>
                </button>
			</span>
    </div>
</div>

<div class="col-xs-12 col-sm-5" style="display: none" id="cradio">
    <div class="input-group" id="cdiv">
        <span class="input-group-addon">
            <span id="room_rad">是否开启到店付款</span>
        </span>

    </div>
</div>

<label class="radio-inline" id="rad" style="display: none" >
    <input type="radio" name="toshop" id="Radio1_toshop" value="1"> <span>是</span>
</label>


<div id="sel" style="display: none"  class="col-xs-12 col-sm-5" >
  <span class="input-group-addon">   
    <label for="hotel_level" class=" control-label" id="la">酒店星级</label>
    <select class="control-label " id="hotel_level" name="hotel_level">
        <option value="0" id="start0">--请选择--</option>
    </select>
    </span>
</div>

<!--隐藏元素--[end]-->



<link rel='stylesheet' type='text/css' href='/js/admin/css/jquery.fileupload-ui.css' /> 


<script type="text/javascript">

    var submit = 0;
    var first = 1;
    var check = 0;
    seajs.use(['$','sel'],function($,sel){
        var device_ele_count = $('.hotel_device').length;
        //页面加载完成执行
        $(document).ready(function() {
            //首次打开页面进行页面数据初始化
            ajaxSubmit(0,first,sel);
        });

        $("#room_name").on("keyup",function() {
            checkRoomName();
        });

        $("#thumb").on("change",function() {
            $("#thumb_val").val($(this).val());
        })

        $('#submit').on("click",function() {
            if(!check) {
                var regular_email = /^(\s)/g;
                if(!$('#room_name').val()  || regular_email.test($('#room_name').val())) {
                    alert("请填写房间类型，且不能以空格开头！");
                    return false;
                }
                if(!$('#room_count').val()) {
                    alert("请填写房间数量!");
                    return false;
                }
                var v = $("input:radio[name='status']:checked").val();
                if(v == null) {
                    alert("请选状态");
                    return false;
                }
            } else {
                alert("该房型名称已经存在，请重新修改");
                return false;
            }
        });

        function checkRoomName() {
            $.ajax({
                url : "<?php echo Url::to(['room-type/checkroom']); ?>",
                data:{room_name:$("#room_name").val()},
                type: "POST",
                dataType:"json",
                success: function(data) {
                    if(data) {
                        check = 1;
                        $("#tips").html("该房型名称已经存在，请重新修改");
                    } else {
                        check = 0;
                        $("#tips").html("");
                    }
                }
            });
        }

        function ajaxSubmit(_param1, _param2,sel) {
            if(1 == _param1 || 1 == _param2) {
                $.ajax({
                    url : "<?php echo Url::to(['room-type/update','id'=>$id]); ?>",
                    type: "GET",
                    dataType:"json",
                    success: function(data) {
                        //console.log(data);
                        //房型
                        $('#room_name').val(data['name']);
                        //房间数量
                        $('#room_count').val(data['room_num']);
                        //促销信息
                        $('#sales').val(data['sales']);
                        //其他说明
                        $('#other').val(data['other']);
                        //缩略图
                        $("#thumb_val").val(data['thumb']);
                        //房间排序
                        $('#display_order').val(data['display_order']);
                        //状态
                        if(1 == data['status'])
                            $('#Radio1_status').attr('checked','checked');
                        else
                            $('#Radio2_status').attr('checked','checked');

                        //房间参数
                        for(var i = 0; i < data['room_detail'].length; i++) {
                            //手动填写
                            if(0 == data['room_detail'][i]['attr_type']) {
                                if(!data['room_detail'][i]['attr_suffix_text']) {
                                    $('#clone').clone().attr('id','clone'+i).show().appendTo('#room_detail').find('#btn').hide().parent().find('input').attr({id:data['room_detail'][i]['id'],name:data['room_detail'][i]['id']}).val(data['room_detail'][i]['attr_option_values']).parent().find('#room_acr').html(data['room_detail'][i]['attr_name']);
                                } else {
                                    $('#clone').clone().attr('id','clone'+i).show().appendTo('#room_detail').find('input').attr({id:data['room_detail'][i]['id'],name:data['room_detail'][i]['id']}).val(data['room_detail'][i]['attr_option_values']).parent().find('#room_acr').html(data['room_detail'][i]['attr_name']).parent().parent().find('.suffix').html(data['room_detail'][i]['attr_suffix_text']);
                                }
                            }

                            //单选
                            if(1 == data['room_detail'][i]['attr_type']) {
                                $('#cradio').clone().attr('id','clone'+i).show().appendTo('#room_detail').find('#room_rad').html(data['room_detail'][i]['attr_name']).attr('id','room_rad'+i);
                                var arr = data['room_detail'][i]['attr_option_values'].split('\n');
                                for(var j = 0; j < arr.length; j++) {
                                    arr[j] = arr[j].replace(/[\r\n]/g,"");
                                    $('#rad').clone().attr('id','rad' + i + j).show().appendTo('#room_rad'+i).find('input').attr({name:data['room_detail'][i]['id'],value:arr[j],type:"radio"}).parent().find('span').html(arr[j]);
                                }
                            }

                            //多选
                            if(2 == data['room_detail'][i]['attr_type']) {
                                $('#cradio').clone().attr('id','clone'+i).show().appendTo('#room_detail').find('#room_rad').html(data['room_detail'][i]['attr_name']).attr('id','room_rad'+i);
                                var arr = data['room_detail'][i]['attr_option_values'].split('\n');
                                for(var j = 0; j < arr.length; j++) {
                                    arr[j] = arr[j].replace(/[\r\n]/g,"");
                                    $('#rad').clone().attr('id','rad' + i + j).show().appendTo('#room_rad'+i).find('input').attr({name:data['room_detail'][i]['id']+"[]",id:data['room_detail'][i]['id']+"_"+j,value:arr[j],type:'checkbox'}).parent().find('span').html(arr[j]);
                                }

                            }

                            //下拉
                            if(3 == data['room_detail'][i]['attr_type']) {
                                $('#sel').clone().attr('id','clone'+i).show().appendTo('#room_detail').find('#la').html(data['room_detail'][i]['attr_name']).parent().find('select').attr({id:data['room_detail'][i]['id'],name:data['room_detail'][i]['id']});
                                var arr = data['room_detail'][i]['attr_option_values'].split('\n');
                                for(var j = 0; j < arr.length; j++) {
                                    var id = String(arr[j]);
                                    $('#' + data['room_detail'][i]['id']).append('<option id="'+id+'" value="'+arr[j]+'">'+arr[j]+'</option>');
                                }
                            }
                        }

                        for(var i = 0; i < data['attrs'].length; i++) {
                            if(0 == data['attrs'][i]['id']) {
                                $('#' + data['attrs'][i]['attr_id']).val(data['attrs'][i]['attr_value']);
                            }

                            if(1 == data['attrs'][i]['id']) {
                                if($(":radio[value='"+data['attrs'][i]['attr_value']+"']").val() == data['attrs'][i]['attr_value']) {
                                    $(":radio[value='"+data['attrs'][i]['attr_value']+"']").attr('checked','checked');
                                }
                            }

                            if(2 == data['attrs'][i]['id']) {
                                if($(":checkbox[value='"+data['attrs'][i]['attr_value']+"']").val() == data['attrs'][i]['attr_value']) {
                                    $(":checkbox[value='"+data['attrs'][i]['attr_value']+"']").attr("checked","checked");
                                }
                            }

                            if(3 == data['attrs'][i]['id']) {
                                $("select[name="+data['attrs'][i]['attr_id']+"] option").each(function() {
                                    var com = $(this).attr('value').replace(/[\r\n]/g,"");
                                    if(com == data['attrs'][i]['attr_value']) {
                                        $(this).attr("selected","selected");
                                    }
                                });
                            }
                        }


                    }
                });//end of ajax
            }
        }
    });
</script>
<!--<include file="Public/footer"/>-->
