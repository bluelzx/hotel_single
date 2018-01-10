<?php
use yii\helpers\Url;

?>

<div class="gongzong">
    <a  href="<?php echo Url::to(['account/accadd']); ?>" class="btn_add">+ 添加公众号</a>
    <form method="post" action="<?php echo Url::to(['account/search']); ?>">
    <div class="research"><input name="search" type="text" class="se" /><input type="submit" value="搜 索" class="sebtn" /></div>
    </form>
</div>
<?php foreach($d as $v) { ?>
<div class="list_tab">
    <div class="top">授权地址：<?php echo $h.$v['acid']; ?> <span class="r"> <img src="/js/admin/images/config.png"> <a href="<?php echo Url::to(['hotel/index',"acid" => $v['acid']]); ?>">管理公众号</a></span></div>
    <div class="company"><img src="<?php echo "http://hotelsingle.img.szgrows.com".$v['avatar']; ?>" width="auto" height="50px"><?php echo $v['name']; ?>
        <span class="r">
            <?php if($v['status']) {?>
                <img src="/js/admin/images/check.png">
            <?php } else { ?>
                <img src="/js/admin/images/del1.png">
            <?php } ?>
        </span></div>
    <div class="bottom"><div class="l">创建日期：<?php echo date("Y-m-d H:i:s",$v['created_at']); ?></div>   <div class="r"><img src="/js/admin/images/edit.png">  <a href="<?php echo Url::to(['account/accmanage',"id" => $v['acid']]); ?>">编辑</a> <img src="/js/admin/images/del.png">
            <?php if($v['status']) {?>
                <a href="<?php echo Url::to(['account/accdel',"id" => $v['acid']]); ?>" class="del">删除</a>
            <?php } else { ?>
                <a href="<?php echo Url::to(['account/accrec',"id" => $v['acid']]); ?>" class="rec">恢复</a>
            <?php } ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php } ?>

<script type="text/javascript">
    seajs.use(['$','sel'],function($,sel){
        //删除信息事件
        $(".del").on('click', function () {
            if (! confirm("确定要删除该公众号？") ) {
                return false;
            }
        })

        //恢复公众号
        $(".rec").on('click', function () {
            if (! confirm("确定要恢复该公众号？") ) {
                return false;
            }
        })
    });
</script>