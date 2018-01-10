<?php
use yii\helpers\Url;

?>
<?php // var_dump($OrderNo);die;?>
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
          <?php if(!empty($rows)){?>  
             <ul class="nav nav-tabs" id="myTab">
                        <li id="order_88">
                            <a  href="<?php echo Url::to(['index']); ?>">
                                <i class="green icon-home bigger-110"></i>
                                全部订单
                            </a>
                        </li>

                        <li id="order_0">
                            <a  href="<?php echo Url::to(['index','refund_status' => 0]); ?>">
                                <i class="green icon-edit bigger-110"></i>
                                未处理
                            </a>
                        </li>

                        <li id="order_1">
                            <a  href="<?php echo Url::to(['index','refund_status' => 1]); ?>">
                                <i class="green icon-edit bigger-110"></i>
                              已处理
                            </a>
                        </li>

                        <li id="order_2">
                            <a  href="<?php echo Url::to(['index','refund_status' => 2]); ?>">
                                <i class="green icon-edit bigger-110"></i>
                              已完成
                            </a>
                        </li>

                        <li id="order_3">
                            <a  href="<?php echo Url::to(['index','refund_status' => 3]); ?>">
                                <i class="green icon-edit bigger-110"></i>
                                已关闭
                            </a>
                        </li>

             
                    </ul>
                    &nbsp;
                    &nbsp;
                    <div>
                    <form method="post" action="<?php echo Url::to(['search']); ?>">
                        <div class="boxsee">
                            订单号：<input name="order_no" value="<?php echo  $OrderNo;?>">
   
           
                            <button type="submit" id="submit" class="btn btn-warning btn-xs">查询</button>
                        </div>
                    </form>
                    </div>
            
                <div class="tab-content">
                
                
                
                
                
                    <div  class="tab-pane in active">
                    
                    
                    
                    
                    
                        <div class="table-responsive">
                            <table id="sample-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                 
                                <tr >
                                    <th style="text-align: center"><font color="#337ab7">订单号</font></th>
                                    <th style="text-align: center"><font color="#337ab7">房型</font></th>
                                    <th style="text-align: center"><font color="#337ab7">姓名</font></th>
                                    <th style="text-align: center"><font color="#337ab7">电话</font></th>
                                    <th style="text-align: center"><font color="#337ab7">付款金额</font></th>
                                    <th style="text-align: center"><font color="#337ab7">退款金额</font></th>
                                    <th style="text-align: center"><font color="#337ab7">退订房数</font></th>
                                    <th style="text-align: center"><font color="#337ab7">退房原因</font></th>
                                    <th style="text-align: center"><font color="#337ab7">当前状态</font></th>
                                    <th style="text-align: center"><font color="#337ab7">下单/退款时间</font></th>
                                    <th style="text-align: center" ><font color="#337ab7">操作</font></th>
                                </tr>
                                </thead>
                               
                                        
                                <?php foreach($rows as $k => $val) { echo "<tr>";
                                    echo "<td style='text-align: center'>"; echo  $val['order_no']; echo "</td>";
                                    echo "<td style='text-align: center'>"; echo  $val['goods_name']; echo "</td>";
                                    echo "<td style='text-align: center'>"; echo  $val['real_name']; echo "</td>";
                                    echo "<td style='text-align: center'>"; echo  $val['phone']; echo "</td>";
                                    echo "<td style='text-align: center'>"; echo  $val['totalc_price']; echo "</td>";
                                    echo "<td style='text-align: center'>"; echo  $val['amount']; echo "</td>";
                                    echo "<td style='text-align: center'>"; echo  $val['room_count']; echo "</td>";
                                    echo "<td style='text-align: center'>"; echo  $val['reason_content']; echo "</td>";
                                    echo "<td style='text-align: center'>";
                                        switch($val['refund_status']) {
                                            case 0 : echo '<span class="badge badge-pink">未处理</span>';break;
                                            case 1 : echo '<span class="badge badge-green">已处理</span>';break;
                                            case 2 : echo '<span class="badge badge-success">已完成</span>';break;
                                            case 3 : echo '<span class="badge badge-purple">已关闭</span>';break;
                                        }
                                    echo "</td>";

                                    echo "<td style='text-align: center'>"; echo    date("Y-m-d H:i:s",$val['order_time']);  echo "/";echo "<br/>";  echo    date("Y-m-d H:i:s",$val['created_time']);   echo "</td>";
                                    echo "<td style='text-align: center'>"; echo '<a href="#myModal"   role="button" class="btn btn-primary btn-xs" data-toggle="modal">订单处理</a>'; echo "</td>";
                                        
                                    echo "</tr>"; } ?>
                                 
                                   <?php }else{ ?>
                                        <?php echo "<td>";echo "您搜索的数据不存在请返回重新搜索"; echo "</td>" ;echo "</tr>"; echo exit(); } ?>
                                
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
        
        
        
        
         <!--手动处理订单--[start]-->
   <form  method="post" action="<?php echo Url::to(['searchhandle','order_no'=>$val['order_no']]); ?>" enctype="multipart/form-data">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">退款订单手动处理</h4>
					</div>
					<div class="modal-body">
						<h4>处理状态：</h4>
                               <select  name="handle">
                                    <option value="未处理">未处理</option>
                                    <option value="已处理">已处理</option>
                                    <option value="已完成">已完成</option>
                                    <option value="已关闭">已关闭</option>
                               </select>
                              
					</div>
					<div class="modal-footer">
                        <input type="submit" value="确定" class="btn btn-primary">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</form>
    
    
 <style>
.fa-handle{
	width:100%;
	height:900px;
	background:darkgray;
	border:1px solid ;
 	position:fixed;
	margin-top:-600px;
	z-index: 9999;
	opacity: 0.8;
	display:none; 
}
.handle{
	width:600px;
	height:300px;
	margin:0 auto;
	margin-top:300px;
	background:white;
}
.box-ok{
		display: inline-block;
	    width: 100px;
	    height: 38px;
	    line-height: 38px;
	    border: 1px solid #bbb;
	    background-color: rgba(250,250,250,0.03);
	    font-size: 16px;
	    margin: 0 7.5px;
			text-decoration: none;
	    white-space: nowrap;
		text-align: center;	
		}
		
		.box-cancel{
		display: inline-block;
	    width: 100px;
	    height: 38px;
	    line-height: 38px;
			text-decoration: none;
	    border: 1px solid #bbb;
	    background-color: rgba(250,250,250,0.03);
	    font-size: 16px;
	    margin: 0 7.5px;
	    white-space: nowrap;
		text-align: center;	
		}
</style>   

<script type="text/javascript">
	function showdiv(){
		
		//alert(fieldname);
		
		var cancel1=document.getElementById("cancel1");
		var div=document.getElementById("fa-handle");
			div.style.display="block";
		cancel1.onclick=function(){
			div.style.display="none";
		}
	}

</script>



















