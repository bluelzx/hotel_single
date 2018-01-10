<?php
use yii\helpers\Url;

?>


<?php ?>
<form class="form-horizontal" method="post"
	action="<?php echo Url::to(['login/updatedo']); ?>"
	enctype="multipart/form-data" onsubmit="checkpost();">
	<div class="page-content">


		<div class="page-header">
			<h1>密码修改</h1>
		</div>
		<!-- /.page-header -->
		<!-- PAGE CONTENT BEGINS -->

		<div class="row">
			<div class="col-sm-6">
				<!--显示外部实线框-->
				<!--<div class="widget-box">-->
				<!--显示外部实线框-->
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<!--旧密码--[start]-->
								<div class="form-group">
									<label for="hotel_name" class="col-sm-2 control-label">登录密码</label>
									<div class="col-sm-10">
										<input type="password" onblur="mima(this)" id="oldpass"
											value="" onchange="checkpost()" class="form-control"
											name="oldpass"> <span id="mima"></span>
									</div>
								</div>
								<!--旧密码--[end]-->

								<!--新密码--[start]-->
								<div class="form-group">
									<label for="integral" class="col-sm-2 control-label">新密码</label>
									<div class="col-sm-10">
										<input type="password" id="newpass" value=""
											class="form-control" name="newpass"> <span id="xintishi"></span>
									</div>

								</div>
								<!--新密码--[end]-->



								<!--确认密码--[start]-->
								<div class="form-group">
									<label for="integral" class="col-sm-2 control-label">确认密码</label>
									<div class="col-sm-10">
										<p>
											<input type="password" id="comfirmpass" value=""
												class="form-control" name="comfirmpass"> <span id="tishi"></span>
										</p>
									</div>

								</div>
								<!--确认密码--[end]-->

								<!--保存--[start]-->
								<div class="">
									<div class="col-sm-3">

										<input type="submit" value="保存" id="queren"
											onclick="return yanzheng()" disabled="disabled"
											class="btn btn-success big">
									</div>
								</div>
								<!--保存--[end]-->



							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</form>


<script type="text/javascript">
		

		var mima=function (data1){
			var httpAjax; 
			var http1=function(){   
				 
				if(window.XMLHttpRequest){ 
					httpAjax=new XMLHttpRequest();
				}else{ 
					httpAjax=new ActiveXObject("Microsoft.XMLHTTP");
				}
			}
			
			http1(); 

			var queren=document.getElementById("queren");
			var pass1=document.getElementById("newpass").value;
    		var pass2=document.getElementById("comfirmpass").value;
			


			
			httpAjax.open("GET","<?php echo Url::to(['login/ajax']) ?>&data="+data1.value,"asyncFlag");
			httpAjax.send(null);
			
			var callback=function(){	
				  if(httpAjax.responseText==1){
					  document.getElementById("mima").innerHTML="<font color='green'>*验证通过</font>";
						queren.disabled=false;	
					 
				}else if(httpAjax.responseText==2){
					document.getElementById("mima").innerHTML="<font color='red'>*密码输入错误</font>";
					queren.disabled=true;
				}
					
				
			}
			 httpAjax.onreadystatechange=callback;
		}






		 function checkpost(){
	     		var oldpass=document.getElementById("oldpass").value;
	     		var pass1=document.getElementById("newpass").value;
	     		var pass2=document.getElementById("comfirmpass").value;
	     		var queren=document.getElementById("queren");
	     		if(oldpass=="" || pass1=="" && pass2 =="" ){
							queren.disabled=true;
							//alert(queren);
	         		}else if(oldpass!=""&& pass1!="" && pass2 !="" ){
	         			//alert(1);
	             		queren.disabled=false;
	         		}
	     	}





  
  
		function mima(){
			
			var oldpass=document.getElementById("oldpass").value;
			if(oldpass==""){
    			document.getElementById("mima").innerHTML="<font color='red'>*请输入密码</font>";
    			return false;
    		}else{
    			document.getElementById("mima").innerHTML="";
    		}
                 
		}
		

		function xinyanzheng(){
			var queren=document.getElementById("queren");
			var pass1=document.getElementById("newpass").value;
			if(pass1==""){
    			//document.getElementById("xintishi").innerHTML="<font color='red'>*新密码不能为空</font>";
    			queren.disabled=true;
    		}else{
    			document.getElementById("xintishi").innerHTML="";
    		}
               
		}




  
          function  yanzheng(){
        	  	var queren=document.getElementById("queren");
        		var pass1=document.getElementById("newpass").value;
        		var pass2=document.getElementById("comfirmpass").value;
        		if(pass1=="" || pass2==""){
        			alert("新密码或确认密码不能为空！");
        			return false;
        		}else{
        		if(pass1==pass2){
        			//document.getElementById("tishi").innerHTML="<font color='green'>*两次输入密码一致</font>";
        			}else{
            			alert("两次输入密码不一致！");
            			//queren.disabled=true;
            			return false;
					
            			
        			/* document.getElementById("tishi").innerHTML="<font color='red'>*两次输入密码不一致</font>";
        			queren.disabled=true; */
        				}
        		
        		}
                       
          }

      
          </script>




