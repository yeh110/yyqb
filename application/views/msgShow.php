<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>操作提示</title>
<?php
if($url=='-1' || $url=='-2' || $url=='-3')
{
$urllink='javascript:history.go('.$url.')';
?>
<script type="text/javascript">
    setTimeout('history.go(<?=$url?>)', <?=$time?>);
</script>
<?php
}elseif($url=='-8'){$urllink='javascript:void(0)';}else{
    $urllink=$url;
?>
<meta http-equiv="refresh" content="<?=$time/1000?>;url=<?=$urllink?>">
<?php
}
?>
<style type="text/css">
.msgbox{ margin:-110px auto 0 auto; width:480px;box-shadow: 0 1px 3px #ccc; background:#fff;border: 1px solid #e2e1e1;font-size:14px; font-family:"微软雅黑";position: fixed;top: 50%;left: 0;right: 0;}
.msgbox .msg-head{height: 44px;border-bottom: 1px solid #e2e1e1;background: #f4f4f4;color: #333;}
.msgbox .msg-head .pull-left{line-height:22px; height:22px; display:block; float:left; padding:11px 15px;}
.msgbox .msg-head .pull-right{height:22px; display:block; float:right; padding:12px 12px 10px 0;}
.msgbox .msg-head .pull-right a{ line-height:20px; height:20px; display:block;padding: 0 5px;font-size: 12px;border-radius: 3px;color: #fff;background-color: #428bca;border: 1px solid  #357ebd; text-decoration:none;}
.msgbox .msg-head .pull-right a:hover{background-color: #3071a9;border-color: #285e8e;}
.msgbox .msg-con{ padding:50px 15px 70px 15px; line-height:22px; text-align:center; color:#333;}
.msgbox .msg-con .skip a{ color:#999;}
.msgbox .msg-con .skip a:hover{ color:#3695D5}
</style>
</head>

<body>
<div class="msgbox">
	<div class="msg-head">
    	<span class="pull-left">操作提示：</span>
        <span class="pull-right">
        	
            <?php if($url!='-8'){?>
            <a href="<?=$urllink?>">快速进入</a>
            <?php }else{ ?>
            <a href="javascript:window.close();">关闭页面</a>
            <?php } ?>
        </span>
    </div>
    <div class="msg-con">
    	<div class="text"><?=$msg?></div>
        <?php if($url!='-8'){?>
        <div class="skip"><a href="<?=$urllink?>">如果你的浏览器没反应，请点击这里...</a></div>
        <?php } ?>
    </div>
</div>
</body>
</html>
