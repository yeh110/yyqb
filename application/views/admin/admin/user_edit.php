<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户信息修改</title>
<link href="<?=static_url('default/css/base.css')?>" rel="stylesheet" type="text/css">
<script src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
<script src="<?=static_url('default/js/layer/layer.js')?>"></script>
<script src="<?=static_url('default/js/base.js')?>"></script>
<script>window.onresize = window.onload = function(){$("#content-wrap").height($(window).height()-51);}</script>
</head>

<body>
<div id="main-body">
	<div class="page-wrapper">
<?php $this->load->view('flmenu.inc.php');?>
        <div class="main-content">
<?php $this->load->view('head.inc.php');?>
            <div id="content-wrap" class="content-wrap">
            	<div class="major-main">
               	  	<div class="detail-content">
                    	<ul class="ui-tab-navigator">
                            <li><a href="<?=site_url('user/index')?>">个人信息</a></li>
                            <li class="active"><a href="<?=site_url('user/editInfo')?>">信息修改</a></li>
                      	</ul>
                        <div class="content-box">
                            <form id="myform" method="post">
                        	<dl class="detail-part">
                            	<dd class="form-row">
                                	<label>用户名：</label>
                                    <div class="form-value">
                                    	<input type="text" class="form-control" style="width:350px" value="<?=$user['uname']?>" readonly>
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>手机号码：</label>
                                    <div class="form-value">
                                        <input type="text" class="form-control" name="tel" style="width:350px" value="<?=$user['tel']?>" placeholder="输入您的手机号码">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>邮箱：</label>
                                    <div class="form-value">
                                        <input type="text" class="form-control" name="email" style="width:350px" value="<?=$user['email']?>" placeholder="输入您的电子邮箱">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>新密码：</label>
                                    <div class="form-value">
                                        <input type="password" class="form-control" name="pass" style="width:350px" placeholder="不修改密码请留空">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>重复密码：</label>
                                    <div class="form-value">
                                        <input type="password" class="form-control" name="pass2" style="width:350px">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                	<label></label>
                                    <div class="form-value">
                                    	<button class="btn btn-primary" type="submit">提交修改</button> 
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
        if($('input[name="pass"]').val()!=''){
            if($('input[name="pass"]').val().length<6){
                layer.msg('密码长度最少为6位', {offset: 200, shift: 6});
                $('textarea[name="pass"]').select();
				return false;
            }else if($('input[name="pass"]').val() != $('input[name="pass2"]').val()){
                layer.msg('两次输入的密码不一样', {offset: 200, shift: 6});
                $('textarea[name="pass"]').select();
				return false;
            }
        }
		
		yh_ajax_post('<?=site_url('user/editAjax')?>', $(this).serialize(), function(data){
			if(data.errNum===0){
				layer.msg(data.retMsg, {icon: 1}, function(){
					location.reload();
				});
			}else{
				layer.msg(data.retMsg, {icon: 2});
			}
		});
        return false;
    })
})
</script>
</body>
</html>
