<?php
use yii\helpers\Url;

?>
<div class="page-content">
    <!-- /.page-header -->
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                            <a  href="#">
                                <i class="green icon-home bigger-110"></i>
                                api日志
                            </a>
                        </li>

                      
                    </ul>
                    &nbsp;
                    &nbsp;
                    <?php  //var_dump($arr) ;die;?>
                  <div>
                    
                        <div class="boxsee" style="min-width:820px;">
                            公众号：<select name="acid" id="acid" value="">
                            <?php foreach ($arr as $key =>$value){?>
                                                <option value="<?php echo $value['acid']  ?>" ><?php echo $value['name']?></option>
                                    <?php }?>
                                        </select>
    
    
    
    <?php 
    
    //求出最近一条操作的条件语句
    $connection= \Yii::$app->db;
    $sql = "SELECT created_time FROM  zdh_mg_api_logs order by  created_time  DESC limit 1";
    $command = $connection->createCommand($sql);
    $arr=$command->queryAll();
    $TO= time();//当前时间戳
    $FROM= time()-(3600*24*7);//最后操作时间减去7天 
     $date1=date("Y-m-d",$TO);
     $date2=date("Y-m-d",$FROM);
    
    ?>
    

           操作时间：<input style="border:1px solid #ccc" class="laydate-icon" id="created_time_from" name="created_time_from"  placeholder="<?php echo $date2;?>" readonly> 至 <input style="border:1px solid #ccc" class="laydate-icon" id="created_time_to" name="created_time_to" onClick="new Calendar().show(this);" placeholder="<?php echo $date1;?>" readonly>
                            接口类型：<select name="api_type" id="api_type">
                                                    <option value="全部">全部</option>
                                                    <option value="房间实况">房间实况</option>
                                                    <option value="营收">营收</option>
                                                    <option value="更改房态">更改房态</option>
                                                    <option value="客人入住\离店">客人入住\离店</option>
                                                    <option value="交班">交班</option>
                                            </select> <button type="submit" id="submit" class="btn btn-warning btn-xs">查询</button>
                       
                        </div>
                  
                    </div>
                    &nbsp;
                    &nbsp;
                    <div class="tab-content">
                        <div  class="tab-pane in active">
                            <div class="table-responsive">
                                <table id="sample-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">记录id</th>
                                        <th>域名</th>
                                        <th>URL</th>
                                        <th>IP</th>
                                        <th>操作时间</th>
                                        <th>请求数据</th>
                                        <th>明细</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE CONTENT END -->
    
    
    <!-- 弹出框开始 -->
                   
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" id="father">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<textarea id="content" ></textarea>
					
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	
	
	
</div>
    
    <!-- 弹出框结束 -->
       
  

	<style>
    #father{
    	width:500px;height:450px;
    }
	#content {
	width:100%;height:300px;
    margin:0, auto;
    resize:none;
	/* overflow:scroll; */
	}	
		
	</style>
 <script src="/js/admin/js/datetime/laydate.js"></script> 
 <script>
;!function(){

laydate.skin('molv');

laydate({
   elem: '#created_time_from'   //created_time_to
})

    laydate({
        elem: '#created_time_to'   //created_time_to
    })

}();
</script>

 <script src="/js/libs/jquery/jquery-1.8.3.min.js"></script> 
 
<script type="text/javascript">
    seajs.use(['admin-common','$','dataTables',"dataTables-bootstrap"],function(admin,$){
        
        var oTable = $('#sample-table').dataTable({
            "bAutoWidth" : false,//是否自适应宽度
            "searching":false,
            "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],//每页显示数据量
            "aoColumns" : [ //列操作
                {
                    bSortable:false,
                    "sWidth" : "5%",
                    "mData" : "id",
                    "sClass" : "center"
                },
                {"mData" : "domain",bSortable:false, "sClass" : "center","sWidth" : "15%"},
                {"mData" : "url",bSortable:false, "sClass" : "center","sWidth" : "10%"},
                {"mData" : "ip",bSortable:false, "sClass" : "center","sWidth" : "10%"},
                {"mData" : "created_at",bSortable:false, "sClass" : "center","sWidth" : "15%"},
                {"mData" : "params",bSortable:false, "sClass" : "center","sWidth" : "30%"},



                {
                    bSortable:false,
                    "sWidth" : "15%",
                    "sClass" : "center",
                    "mData" : "id",
                    "mRender" : function (data,type,full) {
                        var res = "<div class='hidden-sm hidden-xs action-buttons'>";
                         res += '<a href="#myModal"  onclick="showdiv('+full['id']+')"  id="validate"  role="button" class="btn btn-primary btn-xs" data-toggle="modal">详情</a>'; 
                        res += '</div>';
                        return res;
                    }
                } 	
            ],
            //与服务器端传输数据
            "bServerSide" : true,//服务端处理分页
            "sAjaxSource" : "<?php echo Url::to(['index']) ?>",
            "sServerMethod" : "POST",
            "fnServerParams": function (aoData) {  //查询条件
                aoData.push({"name": "acid", "value": $("#acid").val()});
                aoData.push({"name": "created_time_from", "value": $("#created_time_from").val()});
                aoData.push({"name": "created_time_to", "value": $("#created_time_to").val()});
                aoData.push({"name": "api_type", "value": $("#api_type").val()});
            },


            
            //"sServerMethod" : "POST",
            //"bProcessing": true,

            //多语言配置
            "oLanguage" : {
                "sProcessing" : "正在加载中......",
                "sLengthMenu" : "每页显示 _MENU_ 条记录",
                "sZeroRecords" : "对不起，查询不到相关数据！",
                "sEmptyTable" : "表中无数据存在！",
                "sInfo" : "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
                "sInfoFiltered" : "数据表中共为 _MAX_ 条记录",
                "sSearch" : "搜索",
                "oPaginate" : {
                    "sFirst" : "首页",
                    "sPrevious" : "上一页",
                    "sNext" : "下一页",
                    "sLast" : "末页"
                }
            }    
        }); 




        //多条件搜素
        $("#submit").on('click', function () {
            oTable.fnDraw();
            //alert(); 
        })
	








        



         
    });
</script>


<script>
var div=document.getElementById("content");
function showdiv(data){
	//alert(data); //查看有没有抓到ID
	  $.ajax({
	     url:"<?php echo Url::to(['api-daily/ajax'])  ?>",
	     data:{data:data},
	     dataType:"json",
	     type:"get",
	     success:function(pag){ 
	    	 //$('#content').html(pag) ;
	    	 $('#content').html(JSON.stringify($.parseJSON(pag), null, "\t") );
		     } ,
	     error:function(pag){
		   
			    
		     } 
	 })
	 }



  

	 
</script>