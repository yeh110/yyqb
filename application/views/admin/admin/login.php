<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理系统登陆</title>
<link href="<?=static_url('default/css/base.css')?>" rel="stylesheet" type="text/css">
<link href="<?=static_url('default/css/user.css')?>" rel="stylesheet" type="text/css">
<script src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
<script src="<?=static_url('default/js/layer/layer.js')?>"></script>
<script src="<?=static_url('default/js/base.js')?>"></script>
</head>

<body>
<div class="user_header">
	<div class="wp">
    	<div class="wp-logo">
        	数据管理系统
        </div>
    	<div class="wp-fr">
        	<a href="#">首页</a>
            <a href="#">使用帮助</a>
        </div>
    </div>
</div>
<div class="user_main clearfix">
	<div class="formbox">
   	  <div class="fb_hd">
      	<h3>帐号登录</h3>
      </div>
      <div class="fb_con">
        <div class="loginfrom">
        <form id="myform" method="post">
            <div class="login_err_panel" id="err"></div>
            <div class="login_input">
                <i class="login-icon un"></i>
                <input type="text" placeholder="请输入您的账号" name="uname" id="uname">
            </div>
            <div class="login_input">
                <i class="login-icon pwd"></i>
                <input type="password" placeholder="请输入您的密码" name="pass" id="pass">
            </div>
            <div class="login_input" style="display:none">
                <i class="login-icon yz"></i>
                <input type="text" placeholder="请输入验证码" class="input-verifycode" name="verifycode" id="verifycode">
                <span class="verifyImg"><img id="verifyImg" src="http://sem.ityun.me/plus/verifycode" height="45px" onclick="this.src='http://sem.ityun.me/plus/verifycode?'+Math.random()" alt="点击更换验证码"></span>
                <span class="verifyChange"><a href="javascript:fleshVerify()">换一张</a></span>
            </div>
            <div class="login_btn_panel">
                <button type="submit" class="login_btn">登陆</button>
                <span class="notlogin"><a href="#">无法登录？</a></span>
            </div>
        </form>
        </div>
      </div>
    </div>
</div>
<div class="user_foot">
	<p>© 2016 Ityun.me, Inc. All rights reserved.</p>
</div>
<script type="text/javascript">
$('#myform').submit(function(){
    if($('input[name="uname"]').val()==''){
        layer.msg('帐号不能为空', {shift: 6});
        $('input[name="uname"]').select();
    }else if($('textarea[name="pass"]').val()==''){
        layer.msg('密码不能为空', {shift: 6});
        $('textarea[name="pass"]').select();
    }else{
        yh_ajax_post('<?=site_url('user/loginAjax')?>', $(this).serialize(), function(data){
            if(data.errNum==0){
                layer.msg(data.retMsg, {icon: 1}, function(){
                    yh_skip('<?=$redirectUrl?>');
                });
            }else{
                layer.msg(data.retMsg, {icon: 2});
            }
        });
    }
    return false;
})

</script>
</body>
</html>
