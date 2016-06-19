<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>管理员密码修改</title>
<link rel="shortcut icon" href="/favicon.ico">
<link href="<?=static_admin('css/base.css')?>" rel="stylesheet" type="text/css">
<script src="<?=static_admin('js/jquery.min.js')?>"></script>
<script src="<?=static_admin('js/layer/layer.js')?>"></script>
<script src="<?=static_admin('js/base.js')?>"></script>
<script>window.onresize = window.onload = function(){$("#content-wrap").height($(window).height()-51);}</script>
<script type="text/javascript">
var G= {
    nowUrl : '<?=current_url()?>',
    loginUrl : '<?=admin_site('login')?>'
}
</script>
</head>

<body>
<div id="main-body">
	<div class="page-wrapper">
<?php $this->load->view('admin/flmenu.inc.php');?>
        <div class="main-content">
<?php $this->load->view('admin/head.inc.php');?>
            <div id="content-wrap" class="content-wrap">
            	<div class="major-main">
               	  	<div class="detail-content">
                    	<ul class="ui-tab-navigator">
                            <li class="active"><a href="<?=admin_site('user/editPass')?>">密码修改</a></li>
                      	</ul>
                        <div class="content-box">
                            <form id="myform" method="post">
                        	<dl class="detail-part">
                            	<dd class="form-row">
                                	<label>旧密码：</label>
                                    <div class="form-value">
                                    	<input type="password" class="form-control" name="oldpass" style="width:350px">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>新密码：</label>
                                    <div class="form-value">
                                        <input type="password" class="form-control" name="pass" style="width:350px">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>重复密码：</label>
                                    <div class="form-value">
                                        <input type="password" class="form-control fl" name="pass2" style="width:350px;">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                	<label></label>
                                    <div class="form-value">
                                    	<button class="btn btn-primary" type="submit">确定修改</button> 
                                    </div>
                                </dd>
                            </dl>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
$(function () {
    $('#myform').submit(function(){
        if($('input[name="oldpass"]').val() == ''){
            layerMsg('旧密码不能为空');
            $('input[name="oldpass"]').select();
        }else if($('input[name="pass"]').val() == ''){
            layerMsg('新密码不能为空');
            $('input[name="pass"]').select();
        }else if($('input[name="pass"]').val().length < 6){
            layerMsg('新密码长度最少为6个字符');
            $('input[name="pass"]').select();
        }else if($('input[name="pass2"]').val() != $('input[name="pass"]').val()){
            layerMsg('两次输入的密码不一样');
            $('input[name="pass2"]').select();
        }else{
            yh_ajax_post('<?=admin_site('user/editPassAjax')?>', $(this).serialize(), function(data){
                if(data.errNum===0){
                    layerMsg(data.retMsg, 1, 1500, function(){yh_skip(G.loginUrl);});
                }else{
                    layerMsg(data.retMsg);
                }
            });
        }
        return false;
    })
})
</script>
</body>
</html>
