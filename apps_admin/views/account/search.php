<?php
use yii\helpers\Url;

?>

<?php foreach($d as $v) { ?>
    <div class="list_tab">
        <div class="top">排序：<img src="pen.png"> <img src="star.png"> <span class="r"> <img src="config.png"> <a href="<?php echo Url::to(['basic/index',"acid" => $v['acid']]); ?>">管理公众号</a></span></div>
        <div class="company"><img src="<img src='<?php echo "http://127.0.0.1:8097".$v['avatar']; ?>' width='50px' height='50px'>" width="auto" height="50px"><?php echo $v['name']; ?><span class="r"><img src="check.png"></span></div>
        <div class="bottom"><div class="l">服务有效期：<?php echo date("Y-m-d H:i:s",$v['created_at']); ?></div>   <div class="r"><img src="user.png"> 操作管理员 <img src="edit.png">  <a href="<?php echo Url::to(['account/accmanage',"id" => $v['acid']]); ?>">编辑</a> <img src="del.png"> 删除</div>
            <div class="clear"></div>
        </div>
    </div>
<?php } ?>

