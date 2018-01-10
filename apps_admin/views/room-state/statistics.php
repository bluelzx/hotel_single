<?php
use yii\helpers\Url;
use yii\helpers\VarDumper;
?>
<?php
$connection2 = \Yii::$app->db;
$time = time();
$sql2 = "SELECT goods_name, sum(room_count) goods_name_count FROM  zdh_hotel_order   where acid= '{$acid}' and checkin_time<='{$time}' and  checkout_time>='{$time}' and order_status=3  GROUP BY goods_name ";
//echo $sql2;die;
$command = $connection2->createCommand($sql2);
$arr2 = $command->queryAll();
//预定时间到底是下单时候产生的预定时间还是客户要预定那天的时间的时间戳
$time3=strtotime(date('Y-m-d 00:00:00')); //获取今天的0时0分0秒（当前日期的0时0分0秒）
//echo $time3;die;
$sql3="SELECT goods_name, sum(room_count) goods_name_count FROM  zdh_hotel_order   where acid= '{$acid}' and order_time>={$time3} and order_status=2  GROUP BY goods_name";//今天预定后天住，预定时间就不会大于今天的0时0分0秒
//$sql3="SELECT goods_name, sum(room_count) goods_name_count FROM  zdh_hotel_order   where acid= '{$acid}'  and order_status=2  GROUP BY goods_name";
$command = $connection2->createCommand($sql3);
$arr3 = $command->queryAll();
 /* echo "<pre>";
print_r($arr3);//已经预定
//die;
echo "<hr/>";
    echo "<pre>";
print_r($arr2);//在住间数
echo "<hr/>";
print_r($arr); die;  */       //全部房型
/*以下是合并并处理三个数组*/
 foreach ($arr as $k=>$v){//全部
   $arr[$k]['already_selled']=0;
   $arr[$k]['ordered']=0;
    foreach ($arr2 as $value){//入住
        if ($v['name']==$value['goods_name']){
            $arr[$k]['already_selled']=$value['goods_name_count'];
        } 
    }
  foreach ($arr3 as $v3){//预定
        if ($v['name']==$v3['goods_name']){
            $arr[$k]['ordered']=$v3['goods_name_count'];
        } 
    }
}

/*  echo "<hr/>";
echo "<pre>";
print_r($arr);die;  */


?>
<div class="page-content">

	<!-- /section:settings.box -->
	<div class="page-header">
		<h1>
			房态 <small> <i class="ace-icon fa fa-angle-double-right"></i> 房态统计
			</small>
		</h1>
	</div>
	<!-- /.page-header -->
	 
                 <div>

                    <div class="boxsee">
                        预订时间：<input style="border:1px solid #ccc" name="order_time_from" id="order_time_from"  value="" >
                        
                        <button type="submit" id="submit"   onclick="search()" id="queren"  class="btn btn-warning btn-xs">查询</button>
                    </div>

                </div>
                &nbsp;
                &nbsp;

	 
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<table id="simple-table" class="table  table-bordered table-hover">
						<thead>
							<tr>

								<th class="detail-col">详情</th>
								<th>房型</th>
								<th>已入住数</th>
								
	                            <th>已预订数</th>
                                <th class="hidden-480">可预订数(当天)</th>


							</tr>
						</thead>

						<tbody id="tbody1">
						    <?php   $i=0;  foreach ($arr as $key => $value):  ?>
							<tr>
								<td class="center">
									<div class="action-buttons">
										<a   name="detail"  href="#"  abc='<?php echo $i++;?>'     class="green bigger-140 show-details-btn"
											title="Show Details"> <i
											class="ace-icon fa fa-angle-double-down"></i> <span
											class="sr-only">Details</span>
										</a>
									</div>
								</td>
								
								 <td name="room_name"  ><?php  echo $value['name']?>(<?php  echo $value['room_num']?>)</td>
								
								
								<td name="selled" ><?php  echo $value['already_selled']?></td>
								<td name="yishouchu"><?php  echo $value['ordered']?></td>
								<td class="hidden-480"  name= "shengyu"><?php  echo  ($value['room_num']-$value['already_selled']-$value['ordered']);?> </td>
								
							</tr>

							<tr class="detail-row">
								<td colspan="8">
									<div class="table-detail">
										<div class="row">

											<div class="col-xs-12 col-sm-12">
												<div class="space visible-xs"></div>

												<div class="profile-user-info profile-user-info-striped"  name="father">
													 <div class="profile-info-row">
														<div class="profile-info-value">
															<span>姓名</span>
														</div>
														<div class="profile-info-value">
															<span>电话</span>
														</div>
														<div class="profile-info-value">
															<span>入住日期</span>
														</div>
														<div class="profile-info-value">
															<span>离店日期</span>
														</div> 
													</div>
												</div>
												
												
												&nbsp;
												<div class="profile-user-info profile-user-info-striped"  name="order">
													 <div class="profile-info-row">
														<div class="profile-info-value">
															<span>姓名</span>
														</div>
														<div class="profile-info-value">
															<span>电话</span>
														</div>
														<div class="profile-info-value">
															<span>入住日期</span>
														</div>
														<div class="profile-info-value">
															<span>离店日期</span>
														</div> 
													</div>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
                    <?php endforeach; ?>
						</tbody>	
					</table>
				</div>
				<!-- /.span -->
			</div>
			<!-- /.row -->
			<!-- PAGE CONTENT ENDS -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</div>
<script src="/js/admin/js/datetime/laydate.js"></script>
<script>
    ;
    !function () {

        laydate.skin('molv');

        laydate({
            elem: '#order_time_from'   //created_time_to
        })

       

    }();
</script>
<script src="/js/admin/js/Calendar.js"></script>
<script type="text/javascript">
    seajs.use(['$'],function($){

		var active_class = 'active';
		$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){

			alert(1);

			
			var th_checked = this.checked;//checkbox inside "TH" table header
			
			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
				else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
			});
		});
		
		//select/deselect a row when the checkbox is checked/unchecked
		$('#simple-table').on('click', 'td input[type=checkbox]' , function(){

			alert(2);

			
			var $row = $(this).closest('tr');
			if($row.is('.detail-row ')) return;
			if(this.checked) $row.addClass(active_class);
			else $row.removeClass(active_class);
		});

		$('.show-details-btn').on('click', function(e) {
            var lived=document.getElementsByName("father");//入住、抓标签
            var order=document.getElementsByName("order");//入住、抓标签
		    var abc=$(this).attr('abc');//索引(因为属性在for循环里面 所以每次都不同)
		   // alert(lived);
			//alert($(this).html());
			//alert($(this).parent().html());
			//alert($(this).parent().parent().next().html());//现在弹出了房间值了
   			var room_type=$(this).parent().parent().next().html();//赋值
			//alert(room_type);





   			var order_time_from=document.getElementById("order_time_from").value;//传搜索开始时间
        	










   			
			 $.ajax({
			    url:"<?php echo Url::to(['room-state/ajax'])  ?>",
			     data:{room_type:room_type,order_time_from:order_time_from},
			     //data:{room_type:room_type},
			     dataType:"json",
			     type:"get",
			     success:function(pag){ 
			    //	alert(pag);//查看控制器里面传过来的json数据
			    	  var json=pag;
						if(json[0]!="空"){	
							lived[abc].innerHTML='<div class="tt">入住</div><div class="profile-info-row"><div class="profile-info-value td_bg" ><span>姓名</span></div><div class="profile-info-value td_bg"><span>电话</span></div><div class="profile-info-value td_bg"><span>入住日期</span></div><div class="profile-info-value td_bg"><span>离店日期</span></div></div>';
	
			    	 for(var i=0,l=json[0].length;i<l;i++){//遍历json数组
			    	 	str='<div class="profile-info-row">';
			    		    for(var key in json[0][i]){
			    		    	str+='<div class="profile-info-value" ><span>'+json[0][i][key]+'</span></div>'
			    		        //document.write(key+':'+json[i][key]+"<br/>");打印数据
			    		    }
			    		    str+='</div>';
			    		 //   lived.eq(abc).html()+=str;
				    		// alert(lived.eq(abc).html());
			    		   // alert(lived[abc].innerHTML);
			    		    lived[abc].innerHTML+=str;
			    		    
			    		 }
						}  else{
							lived[abc].innerHTML='<div class="tt">入：</div><div class="profile-info-row"><div class="profile-info-value td_bg" ><span>姓名</span></div><div class="profile-info-value td_bg"><span>电话</span></div><div class="profile-info-value td_bg"><span>入住日期</span></div><div class="profile-info-value td_bg"><span>离店日期</span></div></div>';
						}   






						if(json[1]!="空"){	
							order[abc].innerHTML='<div class="tt">预定</div><div class="profile-info-row"><div class="profile-info-value td_bg" ><span>姓名</span></div><div class="profile-info-value td_bg"><span>电话</span></div><div class="profile-info-value td_bg"><span>入住日期</span></div><div class="profile-info-value td_bg"><span>离店日期</span></div></div>';
	
			    	 for(var i=0,l=json[1].length;i<l;i++){//遍历json数组
			    	 	str='<div class="profile-info-row">';
			    		    for(var key in json[1][i]){
			    		    	str+='<div class="profile-info-value" ><span>'+json[1][i][key]+'</span></div>'
			    		        //document.write(key+':'+json[i][key]+"<br/>");打印数据
			    		    }
			    		    str+='</div>';
			    		 //   lived.eq(abc).html()+=str;
				    		// alert(lived.eq(abc).html());
			    		   // alert(lived[abc].innerHTML);
			    		    order[abc].innerHTML+=str;
			    		    
			    		 }
						}  else{
							order[abc].innerHTML='入住<div class="profile-info-row"><div class="profile-info-value td_bg" ><span>姓名</span></div><div class="profile-info-value td_bg"><span>电话</span></div><div class="profile-info-value td_bg"><span>入住日期</span></div><div class="profile-info-value td_bg"><span>离店日期</span></div></div>';
						}   







						
						
				     } ,
			     error:function(pag){
				   alert("shibai");
					    
				     } 
			 })
			e.preventDefault();
			$(this).closest('tr').next().toggleClass('open');
			$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
		});
		
		


    });









    	function search(){
        	var order_time_from=document.getElementById("order_time_from").value;//传搜索开始时间
        	//alert(order_time_from);

                  	

        	
        	/*获取查找框里日期的格式并转换为时间戳  */
        	var str=order_time_from.replace(/-/g,'/');//替换日期格式中的-
           var timestamp=Date.parse(new Date(str));//解析值
           timestamp=timestamp/1000;//上面获取到的是毫秒数所以除以1000
			//alert(timestamp);

            /* 获取每天0时0分0秒的时间戳 */
			var myDate = new Date();    
			str = myDate.toLocaleDateString()+' 00:00:00';
			var date = new Date(myDate.toLocaleDateString());
			var time = date.getTime()/1000;
			//alert(time);
			var queren=document.getElementById("queren");

			if(timestamp<time){
				alert("无效查询");
				//queren.disabled=true;
			}
			
        	
            var selled=document.getElementsByName("selled");
            var yishouchu=document.getElementsByName("yishouchu");
            var shengyu=document.getElementsByName("shengyu");
    	  $.ajax({
    	     url:"<?php echo Url::to(['room-state/search'])  ?>",
    	     data:{order_time_from:order_time_from},
    	     dataType:"json",
    	     type:"post",
    	     success:function(pag){//pag即为控制器里面穿过来的 json_encode($Raw[0]['params']) 
				//	alert(pag);//弹返回值
      		     //alert(pag[2].name)  //抓name
    	    	 for(var i=0;i<pag.length;i++){//遍历json数组
     	 			selled[i].innerHTML=pag[i].already_selled;
     	 			yishouchu[i].innerHTML=pag[i].ordered;
     	 			 shengyu[i].innerHTML=(pag[i].room_num-pag[i].already_selled-pag[i].ordered);		    		
     	 			    		    }
     	       		    
    			    
    		     } ,
    	     error:function(pag){
    		    // alert(pag);
    			    
    		     } 
    	 })
    	
    	}








    
</script>





