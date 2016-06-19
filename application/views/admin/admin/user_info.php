<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>个人信息</title>
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
                        	<li class="active"><a href="<?=site_url('user/index')?>">个人信息</a></li>
                            <li><a href="<?=site_url('user/editInfo')?>">信息修改</a></li>
                      	</ul>
                        <div class="content-box">
                        	<dl class="detail-part userinfo-part">
                            	<dd class="form-row">
                                	<label>用户名：</label>
                                    <div class="form-value"><p><?=$user['uname']?></p></div>
                                </dd>
                                <dd class="form-row">
                                    <label>电话：</label>
                                    <div class="form-value"><p><?=$user['tel']?></p></div>
                                </dd>
                                <dd class="form-row">
                                    <label>邮箱：</label>
                                    <div class="form-value"><p><?=$user['email']?></p></div>
                                </dd>
                                <dd class="form-row">
                                    <label>包月过期：</label>
                                    <div class="form-value"><p><?=$user['expire']?></p></div>
                                </dd>
                                <dd class="form-row">
                                    <label>包月价格：</label>
                                    <div class="form-value"><p><?=$user['mon_pirce']?></p></div>
                                </dd>
                                <dd class="form-row">
                                    <label>日额度：</label>
                                    <div class="form-value"><p><?=$user['oneday_count']?></p></div>
                                </dd>
                                <dd class="form-row">
                                    <label>购买单价：</label>
                                    <div class="form-value"><p><?=$user['one_pirce']?></p></div>
                                </dd>
                                <dd class="form-row">
                                    <label>注册时间：</label>
                                    <div class="form-value"><p><?=date("Y-m-d H:i:s", $user['regdate'])?></p></div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
</body>
</html>
