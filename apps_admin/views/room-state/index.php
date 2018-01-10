<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>酒店管理系统</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="酒店管理系统" />
	<meta name="author" content="The Red Team" />
	<style>
	.red{ color:red}
	.width_room ul {
        width:175px;min-height:90px;_height:130px;border:1px solid #e2b881;float:left;margin:5px; border-radius: 10px;box-shadow: 0px 1px 4px rgba(0, 105, 214, 0.25);padding:5px; position:relative
   }
.width_room  ul li{clear:both;width:100%; font-family: Microsoft YaHei,Segoe UI,Tahoma,Arial,Verdana,sans-serif;font-size:12px;margin:1px 0px ; list-style:none}
.width_room  ul li span{width:75px; text-align:right;display:inline-block;margin-right:10px}
.se{ position:absolute; right:0; bottom:5px;z-index:1}
.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-8{ padding:0px}
.mian_choose{ margin-bottom:10px}
.mian_choose .main,.mian_choose .intro {margin-left:15px;	font-size:12px;}
.mian_choose .main {	height:30px;	overflow:hidden;	line-height:22px;}
.mian_choose .intro {	padding:3px 0 0;	color:#036;	line-height:18px;	border-top:1px solid #ccc;}
.mian_choose .key {	float:right;	margin-top:-20px;	color:#900;	cursor:pointer;}
.btn-green {
    color: #fff;
    background-color: #16a085 !important;
    border-color: #16a085;
}
	
.alert-cor1 {
    background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #3c763d;
}

.alert-cor2 {
	
	
	background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
	
	
	
	
   
}
.alert-cor3 {
    background-color: #d9edf7;
    border-color: #bce8f1;
    color: #31708f;
}
.alert-cor4{
  background-color: #fcf8e3;
  border-color: #faebcc;
  color: #8a6d3b;
}
.alert-cor5{
  background-color: #fcf8e3;
  border-color: #faebcc;
  color: #8a6d3b;
}
.alert-cor6 {
    background-color: #fcd7fc;
    border-color: #bce8f1;
    color: #ac2aaa;
}
.alert-cor7 {
  background-color: #cfd1ff;
  border-color: #faebcc;
  color: #2a31ac;
}
	    	</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>
	
<div class="tabs_index">
				  <div class="panel-heading " style=" background:none; border:none">
						<h4>
							<ul class="nav nav-tabs" style="height:35px">
				             <li class="<?php if(!isset($_GET['room_type'])){echo 'active';}?>"><a onclick='location.href="<?php echo  Url::to(['index']) ?>"'   data-toggle="tab">全部</a></li>
				             <?php foreach ($roomtype as $k => $type ){?>
				               <li class="<?php if(isset($_GET['room_type'])){if($_GET['room_type']==$type['room_type']){echo 'active';}}?>"><a onclick='location.href="<?php echo  Url::to(['index', 'room_type'=>$type['room_type']   ]) ?>"'      data-toggle="tab"><?php echo $type['room_type']?>(<?php echo $type['room_type_count'] ?>)</a></li>				              
				
				              <?php }?>
				              
                        
				            </ul>
				        </h4>
				  	<div class="options"></div>
				  </div>
				  <br />
				  <div class="panel-body" style=" border:none; background:none; ">
				  	<div class="tab-content" style=" border:none; background:none; margin-top:-60px">
						<div class="tab-pane active" id="d0">
                            <div class="row width_room">				
                                <?php  foreach ($rooms as $value){?> 
                                <?php if($value['status']==0){?>                               
                                    <ul class="alert-cor1"> 
                                <?php }?>  
                                <?php if($value['status']==1){?>                               
                                    <ul class=" alert-cor2"> 
                                <?php }?>   
                                <?php if($value['status']==2){?>                               
                                    <ul class=" alert-cor3"> 
                                <?php }?>  
                                <?php if($value['status']==3){?>                               
                                    <ul class=" alert-cor4"> 
                                <?php }?>  
                                <?php if($value['status']==4){?>                               
                                    <ul class=" alert-cor5"> 
                                <?php }?>  
                                <?php if($value['status']==5){?>                               
                                    <ul class=" alert-cor6"> 
                                <?php }?>  
                                <?php if($value['status']==6){?>                               
                                    <ul class="alert-cor7"> 
                                <?php }?>              
                                    <li><span>房间名称：</span><b class="yellow"><?php echo $value['room_no'] ; ?></b></li>
                                    <li><span>价格：</span><?php echo $value['room_price'] ; ?></li>
                                    <li><span>类型：</span><?php echo $value['room_type'] ; ?></li>
                                   <li><span>状态：</span><?php if($value['status']==0){echo "空房";}elseif ($value['status']==1){echo "脏房";}elseif ($value['status']==2){echo "住人";}elseif ($value['status']==3){echo "维修";}elseif ($value['status']==4){echo "预抵";}elseif ($value['status']==5){echo "非当天预抵";}elseif ($value['status']==6){echo "自用";} ?></li>
                                </ul>
                                 <?php }?>
                        </div>
                      </div>
                        
                      </div>
                        
                      </div>         
                

</div>
</body>
</html>
