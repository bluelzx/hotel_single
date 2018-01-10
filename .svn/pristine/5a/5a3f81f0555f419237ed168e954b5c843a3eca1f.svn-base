<?php
use yii\helpers\Url;

?>

<div class="page-content">
    <form class="form-horizontal" method="post" action="<?php echo Url::to(['hotel/index']); ?>" enctype="multipart/form-data">
    <div class="page-header">
        <h1>
            酒店设置
        </h1>
    </div>
    <!-- /.page-header -->
    <!-- PAGE CONTENT BEGINS -->
        <!--酒店设置--[start]-->
        <div class="row">
            <div class="col-sm-12">
                    <!--显示外部实线框-->
                    <!--<div class="widget-box">-->
                    <!--显示外部实线框-->
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-xs-10">
                                    <!--酒店名称--[start]-->
                                    <div class="form-group">
                                        <label for="hotel_name" class="col-sm-2 control-label">酒店名称</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="hotel_name" name="hotel_name">
                                        </div>
                                    </div>
                                    <!--酒店名称--[end]-->

                                    <!--消费赠送积分--[start]-->
<!--                                    <div class="form-group">
                                        <label for="integral" class="col-sm-2 control-label">消费赠送积分</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="integral" name="integral">
                                            <span class="help-block">注意：消费一元所赠送的积分</span>
                                        </div>

                                    </div>-->
                                    <!--消费赠送积分--[end]-->
                                   
          
            

                                    <!--缩略图--[start]--> 
                                     <div class="form-group">
                            <label for="thumb"  class="col-sm-2 control-label">缩略图</label>
                               <div class="col-sm-7">
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

                                    <!--其他图片--[start]-->
                                       <div class="form-group" id="other_pic">
                         <label for="hotel_thumbs"  class="col-sm-2 control-label">其他图片</label>

                               <div>
                               <div class="col-sm-7">
                                  <input class="form-control" type="" readonly id="hotel_thumbs_val">
                                   </div>
                            <div class="col-sm-3">

                            <span class="btn btn-info btn-sm fileinput-button">
                                    
                                        <span>其它图片</span>
                                         <input type="file" id="hotel_thumbs" name="hotel_thumbs[]">
                                    </span>
                                <span class="btn btn-info btn-sm fileinput-button add_sub" id="add">
                                        <span>添加</span>
                                    </span>
                                    </div>
                                </div>


                                   </div>
                                        <div id="image_path">
                                        </div>
                                   
                                    <!--其他图片--[end]-->

                                    <!--酒店星级--[start]-->
                                    <div class="form-group" style="margin-top:1em">
                                        <label for="hotel_level" class="col-sm-2 control-label">酒店星级</label>
                                             <div class="col-sm-10">
                                               <select class="control-label col-sm-4" id="hotel_level" name="hotel_level">
                                            <option value="0" id="start0">--请选择酒店星级--</option>
                                            <option value="1" id="start1">一星级</option>
                                            <option value="2" id="start2">二星级</option>
                                            <option value="3" id="start3">三星级</option>
                                            <option value="4" id="start4">四星级</option>
                                            <option value="5" id="start5">五星级</option>
                                            <option value="6" id="start6">六星级</option>
                                        </select>
                                    </div></div>
                                    <!--酒店星级--[end]-->

                                    <!--酒店设施--[start]-->
                                    <div class="form-group" >
                                        <label for="form-field-select-1" class="col-sm-2 control-label">酒店设施</label>
                                     
                                            <div class="col-sm-8 " style="background:#f9fbfc; border:1px solid #c2e2fa;margin-left:12px "  >
                                                <div  style="margin-top:15px" class="col-xs-12 " id="device_ele">
                                                    <!--餐厅--[start]-->
                                                    <div class="col-xs-12 col-sm-6 form-group" style="display: block;">
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><input type="checkbox" class="btn btn-default dev_class" name="cantin" value="option1" id="10"></div>
                                                            <input type="text" class="form-control search-query hotel_device" value="餐厅" readonly id="cantin" />
                                                        </div>
                                                    </div>
                                                    <!--餐厅--[end]-->

                                                    <!--wifi--[start]-->
                                                    <div class="col-xs-12 col-sm-6 form-group" style="display: block;">
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><input type="checkbox" class="btn btn-default dev_class" name="wifi" value="option1" id="11"></div>
                                                            <input type="text" class="form-control search-query hotel_device" value="wifi" readonly id="wifi" />
                                                        </div>
                                                    </div>
                                                    <!--wifi--[end]-->

                                                    <!--停车位--[start]-->
                                                    <div class="col-xs-12 col-sm-6 form-group" style="display: block;">
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><input type="checkbox" class="btn btn-default dev_class" name="tinchewei" value="option1" id="12"></div>
                                                            <input type="text" class="form-control search-query hotel_device" value="停车位" readonly id="tinchewei" />
                                                        </div>
                                                    </div>
                                                    <!--停车位--[end]-->

                                                    <!--热水--[start]-->
                                                    <div class="col-xs-12 col-sm-6 form-group" style="display: block;">
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><input type="checkbox" class="btn btn-default dev_class" name="reshui" value="option1" id="13"></div>
                                                            <input type="text" class="form-control search-query hotel_device" value="热水" readonly id="reshui" />
                                                        </div>
                                                    </div>
                                                    <!--热水--[end]-->

                                                    <!--空调--[start]-->
                                                    <div class="col-xs-12 col-sm-6 form-group" style="display: block;">
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><input type="checkbox" class="btn btn-default dev_class" name="kongtiao" value="option1" id="14"></div>
                                                            <input type="text" class="form-control search-query hotel_device" value="空调" readonly id="kongtiao" />
                                                        </div>
                                                    </div>
                                                    <!--空调--[end]-->

                                                    <!--休闲服务--[start]-->
                                                    <div class="col-xs-12 col-sm-6 form-group" style="display: block;">
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><input type="checkbox" class="btn btn-default dev_class" name="xiuxian" value="option1" id="15"></div>
                                                            <input type="text" class="form-control search-query hotel_device" value="休闲服务" readonly id="xiuxian" />
                                                        </div>
                                                    </div>
                                                    <!--休闲服务--[end]-->

                                                    <!--洗漱用品--[start]-->
                                                    <div class="col-xs-12 col-sm-6 form-group" style="display: block;">
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><input type="checkbox" class="btn btn-default dev_class" name="xishu" value="option1" id="16"></div>
                                                            <input type="text" class="form-control search-query hotel_device" value="洗漱用品" readonly id="xishu" />
                                                        </div>
                                                    </div>
                                                    <!--洗漱用品--[end]-->

                                                </div>
                                        </div>

                                    </div>
                                    <!--酒店设施--[end]-->

                                    <!--酒店电话--[start]-->
                                    <div class="form-group">
                                        <label for="hotel_phone" class="col-sm-2 control-label">酒店电话</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="hotel_phone" name="hotel_phone">
                                        </div>
                                    </div>
                                    <!--酒店电话--[end]-->

                                    <!--酒店地址--[start]-->
                                    <div class="form-group">
                                        <label for="hotel_addr" class="col-sm-2 control-label">酒店地址</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="hotel_addr" name="hotel_addr">
                                        </div>
                                    </div>
                                    <!--酒店地址--[end]-->

                                    <!--所在地区--[start]-->
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">所在地区</label>
                                        <div class="col-sm-10" id="city">
                                                <select class="prov" name="province" id="province"></select>
                                                <select class="city" name="city" disabled="disabled" id="city"></select>
                                                <select class="dist" name="area" disabled="disabled" id="area"></select>
                                        </div>
                                    </div>
                                    <!--所在地区--[end]-->

                                    <!--酒店坐标--[start]-->
                                    <div class="form-group">
                                        <label for="hotel_lng" class="col-sm-2 control-label">酒店坐标</label>
                                        <div class="col-sm-3">
                                            <span style="display: inline">经度:</span><input type="text" class="form-control" id="hotel_lng" name="hotel_lng" value="" placeholder="经度" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <span style="display: inline">纬度:</span><input type="text" class="form-control" id="hotel_lat" name="hotel_lat" value="" placeholder="纬度" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-info btn-sm" id="map">选择坐标</button>
                                        </div>
                                    </div>
                                    <!--酒店坐标--[end]-->

                                    <!--酒店介绍--[start]-->
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label">酒店介绍</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                                            <span class="help-block">用于正文内的详情</span>
                                        </div>
                                    </div>
                                    <!--酒店介绍--[end]-->

                                    <!--酒店公告--[start]-->
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label">酒店公告</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="3" name="notice" id="notice"></textarea>
                                            <span class="help-block">酒店公告</span>
                                        </div>
                                    </div>
                                    <!--酒店公告--[end]-->

                                    <!--订房说明--[start]-->
 <!--                                   <div class="form-group">
                                        <label for="content" class="col-sm-2 control-label">订房说明</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                                            <span class="help-block">酒店订房说明(选填)</span>
                                        </div>
                                    </div>-->
                                    <!--订房说明--[end]-->

                                    <!--交通位置--[start]-->
<!--                                    <div class="form-group">
                                        <label for="traffic" class="col-sm-2 control-label">交通位置</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="3" name="traffic" id="traffic"></textarea>
                                            <span class="help-block">酒店位置交通说明(选填)</span>
                                        </div>
                                    </div>-->
                                    <!--交通位置--[end]-->

                                    <!--促销信息--[start]-->
<!--                                    <div class="form-group">
                                        <label for="sales" class="col-sm-2 control-label">促销信息</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="3" id="sales" name="sales"></textarea>
                                        </div>
                                    </div>-->
                                    <!--促销信息--[end]-->

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
             
          
     
        <!--酒店设置--[end]-->
    </form>
    <!-- PAGE CONTENT END -->
</div>
</div>
</div>


<!--隐藏元素-->
<div class="col-xs-12 col-sm-6 form-group" id="clone">
    <div class="input-group">
        <div class="input-group-addon"><input type="checkbox" class="btn btn-default dev_class" value="option1" id="10"></div>
        <input type="text" class="form-control search-query hotel_device" placeholder="添加酒店设施"  id="100" />
        <span class="input-group-btn">
            <button type="button" class="btn btn-purple btn-sm" id="dev_del">
                <span class="">删除</span>
            </button>
        </span>
    </div>
</div>


<div id="div_clone" style="display: none; clear:both; padding-top:10px ">
  <div class="col-sm-2"></div>
    <div class="col-sm-7">
        <input class="form-control" type="" readonly id="hotel_thumbs_val">
    </div>
    <div class="col-sm-3" >

                            <span class="btn btn-info btn-sm fileinput-button">

                                        <span>其它图片</span>
                                         <input type="file" id="hotel_thumbs" name="hotel_thumbs[]">
                                    </span>
                                <span class="btn btn-info btn-sm fileinput-button add_sub"  id="sub">
                                        <span class="sub_text">添加</span>
                                    </span>
    </div>
</div>


<!--pop--[start]-->
<div id="pop" style="z-index: 9999;display: none;position: absolute;background: white; border:10px solid #ccc; padding:20px">
    <center>
        <h2>
            <div style=" margin:auto;border:2px solid gray; margin-bottom:50px;" id="container"></div>
            <div >
                <label >输入地点：</label>
                <input id="where" name="where" type="text" placeholder="请输入地址">
                <input id="but" type="button" value="地图查找" onClick="sear(document.getElementById('where').value);" style="font-size:18px" />
                <button id="map_close" style="font-size:18px" >关闭</button>
            </div>
        </h2>
    </center>
</div>
<!--pop--[end]-->


<div id="showimageid" style="display: none;"><div  class="form-group" style="margin-bottom:0em">
<div class="col-sm-2"></div>
    <div class="col-sm-7">
        <span style="display: block" ><span id="showimage"></span>&nbsp;&nbsp;&nbsp;<span class="de badge badge-info adel">删除</span></span>
</div>



</div></div>
<!--隐藏元素-->
<link rel='stylesheet' type='text/css' href='/js/admin/css/jquery.fileupload-ui.css' /> 

<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
<script type="text/javascript">

    var submit = 0;
    var first = 1;
    var as = 0;
    seajs.use(['$','sel'],function($,sel){
        var device_ele_count = $('.hotel_device').length;
        //页面加载完成执行
        $(document).ready(function() {
            $('#clone').hide();
            //首次打开页面进行页面数据初始化
            sel("#city").citySelect({
                url:"/js/admin/js/city.min.js",
                prov:"广东", //省份
                city:"深圳", //城市
                dist:"罗湖区", //区县
                nodata:"none" //当子集无数据时，隐藏select
            });
            ajaxSubmit(0,first,sel);
        });

        $("#thumb").on("change",function() {
            $("#thumb_val").val($(this).val());
        })

        $("#hotel_thumbs").on("change",function() {
            $("#hotel_thumbs_val").val($(this).val());
        });

        $("input[type='file']").on("change",function() {
            //alert($(this).val());
            $(this).parent().parent().parent().find("input[id='hotel_thumbs_val']").val($(this).val());
        });

        //添加酒店设施
/*        $("input:checkbox").on("click",function() {
            var id = $(this).parent().parent().find("input[type='text']").attr('id');
            if($(this).is(':checked')) {
                switch (id) {
                    case 'cantin' : $(this).parent().parent().find("input[type='text']").attr('name',"cantin");break;
                    case 'wifi' : $(this).parent().parent().find("input[type='text']").attr('name',"wifi");break;
                    case 'tinchewei' : $(this).parent().parent().find("input[type='text']").attr('name',"tinchewei");break;
                    case 'reshui' : $(this).parent().parent().find("input[type='text']").attr('name',"reshui");break;
                    case 'kongtiao' : $(this).parent().parent().find("input[type='text']").attr('name',"kongtiao");break;
                    case 'xiuxian' : $(this).parent().parent().find("input[type='text']").attr('name',"xiuxian");break;
                    case 'xishu' : $(this).parent().parent().find("input[type='text']").attr('name',"xishu");break;
                }
            } else {
                switch (id) {
                    case 'cantin' : $(this).parent().parent().find("input[type='text']").removeAttr('name');break;
                    case 'wifi' : $(this).parent().parent().find("input[type='text']").removeAttr('name');break;
                    case 'tinchewei' : $(this).parent().parent().find("input[type='text']").removeAttr('name');break;
                    case 'reshui' : $(this).parent().parent().find("input[type='text']").removeAttr('name');break;
                    case 'kongtiao' : $(this).parent().parent().find("input[type='text']").removeAttr('name');break;
                    case 'xiuxian' : $(this).parent().parent().find("input[type='text']").removeAttr('name');break;
                    case 'xishu' : $(this).parent().parent().find("input[type='text']").removeAttr('name');break;
                }
            }
            //alert($(this).parent().parent().find("input[type='text']").attr('id'));
        })*/

        //创建新元素
        $("#add_element").on('click',function() {
            device_ele_count = $('.hotel_device').length;
            $("#clone").clone(true).attr('id','clone'+(device_ele_count-1)).show().appendTo("#device_ele").find('.hotel_device').val('').attr({id:"dev"+(device_ele_count-1),placeholder:'添加酒店设施'}).css('display','block').parent().find('input:first').attr({value:"dev"+(device_ele_count-1),id:'c_dev_'+(device_ele_count-1)});
        });

        //删除元素
        $('#dev_del').on('click',function() {
            //判断是否是最后一个
            if(2 == $('.hotel_device').length) {
                $(this).parent().parent().find('.hotel_device').val('').parent().find('input:first').attr('checked',false);
            } else {
                $(this).parent().parent().parent().remove();
            }
        });

        //选中元素
/*        $("input[type=checkbox]").on('click',function() {
            if($(this).is(':checked')) {
                $(this).parent().parent().children('input').attr('name','hotel_device[]');
            } else {
                $(this).parent().parent().children('input').removeAttr('name');
            }
        });*/

        //酒店坐标
        $('#map').on('click',function() {
            var top = ($(window).height()-600) / 2;
            var left = ($(window).width()-500) / 2;
            $('#pop').offset({'top':top,'left':left}).find('#container').css({'height':600+'px','width':500+'px'}).parent().parent().parent().show();
            left = 0;
            top = 0;
        });

        //关闭地图
        $('#map_close').on('click', function () {
            $('#pop').offset({'top':0,'left':0})
            $('#pop').hide();
        });


        //del
        $('.sub_text').on("click",function() {
            $(this).parent().parent().parent().remove();
        })

        //add
        $("#add").on("click",function() {
            $("#div_clone").clone(true).appendTo("#other_pic").show().find(".add_sub").attr('id',"sdk").find(".sub_text").html("删除").parent().parent().parent().attr('id','div_clone'+as).find("input:first").parent().parent().find("input[type='file']").attr('id',"hotel_thumbs"+as);
            as ++;
        });

        $('#submit').on("click",function() {
            if (!$('#hotel_name').val()) {
                alert("请填写酒店名称！");
                return false;
            }
            if (null == $('#city').val()) {
                alert('请选择酒店所在城市！');
                return false;
            }
        });

        //ajax删除图片
        var image_id = 0;
        $(".adel").on("click",function() {
            image_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo Url::to(['hotel/adel']); ?>",
                type: "POST",
                data: {
                    id:$(this).attr("id"),
                    acid:$(this).attr('acid')
                },
                dataType: "json",
                success: function(data) {
                    //console.log(data);
                    $("#showimageid"+image_id).remove();
                }
            });
        });
    });

    function ajaxSubmit(_param1, _param2,sel) {
        if(1 == _param1 || 1 == _param2) {
            $.ajax({
                url : "<?php echo Url::to(['hotel/index']); ?>",
                type: "GET",
                dataType:"json",
                success: function(data) {
                    if(data!='' && data!=null && data!=undefined) {
                        //酒店名称
                        $('#hotel_name').val(data['title']);
                        //消费赠送积分
                        $('#integral').val(data['integral']);
                        //酒店星级
                        $('#hotel_level option[id=start'+data['level']+']').attr('selected','selected');
                        //酒店电话
                        $('#hotel_phone').val(data['phone']);
                        //酒店地址
                        $('#hotel_addr').val(data['address']);
                        //所在地区
                        sel("#city").citySelect({
                            url:"/js/admin/js/city.min.js",
                            prov:data['province'], //省份
                            city:data['city'], //城市
                            dist:data['district'], //区县
                            nodata:"none" //当子集无数据时，隐藏select
                        });


                        //酒店坐标-经度
                        $('#hotel_lng').val(data['lng']);
                        //酒店坐标-纬度
                        $('#hotel_lat').val(data['lat']);
                        //酒店介绍
                        $('#description').val(data['description']);
                        //酒店公告
                        $("#notice").val(data['notice']);
                        //酒店缩略图
                        $("#thumb_val").val(data['thumb']);
                        //其他图片
                        //$("#hotel_thumbs_val").val(data['thumbs']);
                        //console.log(data['thumbs'][1]);
                        for(var k = 0;k < data['thumbs'].length;k++) {
                            $("#showimageid").clone(true).appendTo("#image_path").show().attr('id','showimageid'+k).find("#showimage").html(data['thumbs'][k]).parent().find(".de").attr({"id":k,"acid":data['acid']});
                        }
                        //订房说明
                        //$('#content').val(data['content']);
                        //交通位置
                        //$('#traffic').val(data['traffic']);
                        //促销信息
                        //$('#sales').val(data['sales']);
                        //酒店设施
                        console.log(data['show_device']);

                        if(data['show_device']['cantin']) {
                            //$("#cantin").val(data['show_device']['cantin']).attr('name','cantin').parent().find("input[type='checkbox']").attr('checked','checked');
                            $("#10").attr('checked','checked');
                        }

                        if(data['show_device']['wifi']) {
                            //$("#wifi").val(data['show_device']['wifi']).attr('name','wifi').parent().find("input[type='checkbox']").attr('checked','checked');
                            $("#11").attr('checked','checked');
                        }

                        if(data['show_device']['tinchewei']) {
                            //$("#tinchewei").val(data['show_device']['tinchewei']).attr('name','tinchewei').parent().find("input[type='checkbox']").attr('checked','checked');
                            $("#12").attr('checked','checked');
                        }

                        if(data['show_device']['reshui']) {
                            //$("#reshui").val(data['show_device']['reshui']).attr('name','reshui').parent().find("input[type='checkbox']").attr('checked','checked');
                            $("#13").attr('checked','checked');
                        }

                        if(data['show_device']['kongtiao']) {
                            //$("#kongtiao").val(data['show_device']['kongtiao']).attr('name','kongtiao').parent().find("input[type='checkbox']").attr('checked','checked');
                            $("#14").attr('checked','checked');
                        }

                        if(data['show_device']['xiuxian']) {
                            //$("#xiuxian").val(data['show_device']['xiuxian']).attr('name','xiuxian').parent().find("input[type='checkbox']").attr('checked','checked');
                            $("#15").attr('checked','checked');
                        }

                        if(data['show_device']['xishu']) {
                            //$("#xishu").val(data['show_device']['xishu']).attr('name','xishu').parent().find("input[type='checkbox']").attr('checked','checked');
                            $("#16").attr('checked','checked');
                        }
/*                        if(_param2) {
                            if(!data['show_device'].length) {
                                $("#clone").clone(true).attr('id','clone0').show().appendTo("#device_ele").find('.hotel_device').attr({id:"dev"+0}).css('display','block').parent().find('input:first').attr({value:"dev"+0,id:'c_dev_'+0});
                                $('#dev'+i).val(data['show_device'][0]);
                            }
                            for(var i = 0;i < data['show_device'].length; i++) {
                                $("#clone").clone(true).attr('id','clone'+i).show().appendTo("#device_ele").find('.hotel_device').attr({id:"dev"+i,value:"dev"+i,name:"hotel_device[]"}).css('display','block').parent().find('input:first').attr({value:"dev"+i,id:'c_dev_'+i,checked:'checked'});
                                $('#dev'+i).val(data['show_device'][i]);
                            }
                        }*/
                    }
                }
            });//end of ajax
        }
    }


    /*百度地图*/
    var map = new BMap.Map("container");
    map.setDefaultCursor("crosshair");

    map.enableScrollWheelZoom();
    var point = new BMap.Point(114.176614,22.567759);
    map.centerAndZoom(point, 13);
    var gc = new BMap.Geocoder();

    map.addControl(new BMap.NavigationControl());
    map.addControl(new BMap.OverviewMapControl());
    map.addControl(new BMap.ScaleControl());
    map.addControl(new BMap.MapTypeControl());
    map.addControl(new BMap.CopyrightControl());

    var marker = new BMap.Marker(point);
    map.addOverlay(marker);

    marker.addEventListener("click", function(e)
    {
        document.getElementById("lonlat").value = e.point.lng;
        document.getElementById("lonlat2").value =e.point.lat;
    });


    marker.enableDragging();

    marker.addEventListener("dragend",function(e)
    {
        gc.getLocation(e.point, function(rs)
        {
            showLocationInfo(e.point, rs);
        });
    });


    function showLocationInfo(pt, rs)
    {
        var opts = {  width : 250, height: 150, title : "当前位置" } ;
        var addComp = rs.addressComponents;
        var addr = "当前位置：" + addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber + "<br/>";
        addr += "纬度: " + pt.lat + ", " + "经度：" + pt.lng;
        var infoWindow = new BMap.InfoWindow(addr, opts);
        marker.openInfoWindow(infoWindow);
    }

    map.addEventListener("click", function(e)
    {
        document.getElementById("hotel_lng").value = e.point.lng;
        document.getElementById("hotel_lat").value = e.point.lat;
    });


    var traffic = new BMap.TrafficLayer();
    map.addTileLayer(traffic);


    function iploac(result)
    {
        var cityName = result.name;
    }

    var myCity = new BMap.LocalCity();
    myCity.get(iploac);

    function sear(result)
    {
        var local = new BMap.LocalSearch(map, {renderOptions:{map: map} });
        local.search(result);
    }
    /*百度地图*/
</script>
<!--<include file="Public/footer"/>-->
