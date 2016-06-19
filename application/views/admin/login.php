<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>后台管理系统登陆</title>
<style type="text/css">
body{background: url("data:image/png;base64,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") #082b4f;background-attachment: fixed;background-size: contain;}
button, input, select, textarea {font-family:inherit;font-size: 100%;margin: 0;}
input:focus,button:focus,a:focus {outline:none;-moz-outline:none;} 
:focus{outline: 0!important;}
input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill{background-color:#fff;box-shadow: inset 0 0 0 1000px #fff;-moz-box-shadow: inset 0 0 0 1000px #fff;-webkit-box-shadow: inset 0 0 0 1000px #fff;}
.loginbox{ margin:-170px auto auto auto; width:420px;box-shadow:0 0 10px -1px #666;position: fixed;left: 0;right: 0;top: 50%;overflow: hidden;border-radius: 4px; background:#fff;font-size:14px; font-family:"微软雅黑";}
.loginbox .head{height: 44px;border-bottom: 1px solid #e2e1e1;background: #f4f4f4;color: #333;}
.loginbox .head .pull-left{line-height:22px; height:22px; display:block; float:left; padding:11px 15px;}
.loginbox .head .pull-right{height:22px; display:block; float:right; padding:12px 12px 10px 0;}
.loginbox .head .pull-right a{ line-height:20px; height:20px; display:block;padding: 0 5px;font-size: 12px;border-radius: 3px;color: #fff;background-color: #428bca;border: 1px solid  #357ebd; text-decoration:none;}
.loginbox .head .pull-right a:hover{background-color: #3071a9;border-color: #285e8e;}
.loginfrom{ padding:30px 30px;}
.loginfrom .login_input{ display:block;position: relative;padding: 3px 0 3px 54px;border: 1px solid #e7e7eb;margin-top: -1px;}
.login-icon{position: absolute;left: 15px;top: 50%;margin-top: -11px;width: 16px;height: 18px;vertical-align: middle;display: inline-block;}
.login-icon.un {background: url("<?=static_admin('images/login-ico.png')?>") 0 0 no-repeat;}
.login-icon.pwd {background: url("<?=static_admin('images/login-ico.png')?>") 0 -28px no-repeat;}
.login-icon.yz {background: url("<?=static_admin('images/login-ico.png')?>") 0 -135px no-repeat;}
.login_input input {border: 0;outline: 0;padding: 11px 0;vertical-align: middle;width: 100%;}
.login_input input.input-verifycode{ width:100px;}
.verifyImg{vertical-align: bottom; position:absolute; left:160px; height:47px; top:0;}
#verifyImg{ cursor: pointer;}
.verifyChange{ position:absolute; right:20px; padding:11px 0; font-size:14px;}
.verifyChange a{ color:#428BCA; text-decoration:none;}
.verifyChange a:hover{text-decoration:underline;}
.login_btn_panel{ padding-top:15px;}
.login_btn{border-radius: 3px;cursor: pointer;background-color: #44b549;border:none;color: #fff;height: 36px;width: 120px;}
.login_btn:hover {background-color: #2f9833;}
.login_err_panel{ color:#e15f63; font-size:13px; padding:0 0 8px 4px; display: none;}
</style>
<script src="<?=static_admin('js/jquery.min.js')?>"></script>
<script type="text/javascript">
    var G= {
        loginUrl : '<?=admin_site('login/userLoginAjax')?>',
        verifyImgUrl : '<?=site_url('plus/verifycode')?>',
        redirectUrl: "<?=$redirectUrl?>"
    }
    function fleshVerify(){ 
    //重载验证码
        document.getElementById('verifyImg').src = G.verifyImgUrl + '?' + Math.random();
    }
    $(document).ready(function(){
        $("#myfrom").submit(function(e){
            if($('#myfrom input[name="username"]').val()==''){
                $("#err").text('你还没有输入帐号！');
                $("#err").show();
                $('#myfrom input[name="username"]').select();
                return false;
            }else if($('#myfrom input[name="password"]').val()==''){
                $("#err").text('你还没有输入密码！');
                $("#err").show();
                $('#myfrom input[name="password"]').select();
                return false;
            }
            if(G.isVerifyImg == 'Y')
            {
                if($('#myfrom input[name="verifycode"]').val()==''){
                    $("#err").text('请输入图中的验证码');
                    $("#err").show();
                    $('#myfrom input[name="verifycode"]').select();
                    return false;
                }
            }
            var postData = $(this).serialize();
            $.ajax({
                type : "POST",
                url : G.loginUrl,
                cache : false,
                data : postData || {},
                success : function(data) {
                    if (data.substr(0, 1) == '{') {
                        var jsonData = jQuery.parseJSON(data);
                        if(jsonData.code == 10028)
                        {
                            window.location.href = G.redirectUrl;
                        }
                        else if(jsonData.code >= 10029)
                        {
                            if(jsonData.code == 10032)
                            {
                                fleshVerify();
                                $('#'+jsonData.inputId).val('');
                            }
                            $("#err").text(jsonData.msg);
                            $("#err").show();
                            $('#'+jsonData.inputId).select();
                        }
                    }else{
                        $("#err").text('系统内部错误,请联系管理员！');
                        $("#err").show();
                        $('#'+jsonData.inputId).select();
                    }
                }
            })
            return false;
        });
        
    })
</script>
</head>

<body>
<div class="loginbox">
	<div class="head">
    	<span class="pull-left">用户登陆：</span>
        <span class="pull-right">
        	<a href="<?=base_url()?>">返回首页</a>
        </span>
    </div>
    <div class="loginfrom">
    <form id="myfrom" method="post">
    	<div class="login_err_panel" id="err"></div>
    	<div class="login_input">
            <i class="login-icon un"></i>
            <input type="text" placeholder="请输入您的账号" name="username" id="username">
        </div>
        <div class="login_input">
            <i class="login-icon pwd"></i>
            <input type="password" placeholder="请输入您的密码" name="password" id="password">
        </div>
      	<div class="login_input">
            <i class="login-icon yz"></i>
            <input type="text" placeholder="请输入验证码" class="input-verifycode" name="verifycode" id="verifycode">
          	<span class="verifyImg"><img id="verifyImg" src="<?=site_url('plus/verifycode')?>" height="47px"  onclick="this.src='<?=site_url('plus/verifycode/')?>?'+Math.random()" alt="点击更换验证码"/></span>
            <span class="verifyChange"><a href="javascript:fleshVerify()">换一张</a></span>
        </div>
        <div class="login_btn_panel">
        	<button type="submit" class="login_btn">登陆</button>
        </div>
    </form>
    </div>
</div>
</body>
</html>
