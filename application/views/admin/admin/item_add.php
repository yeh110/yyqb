<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>项目添加</title>
<link rel="shortcut icon" href="/favicon.ico">
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
                        	<li><a href="<?=site_url('item/index')?>">项目管理</a></li>
                            <li class="active"><a href="<?=site_url('item/add')?>">项目添加</a></li>
                      	</ul>
                        <div class="content-box">
                            <form id="myfrom" method="post">
                        	<dl class="detail-part">
                            	<dd class="form-row">
                                	<label>项目名称：</label>
                                    <div class="form-value">
                                    	<input type="text" class="form-control" name="item_name" placeholder="您的项目名称1-20个字符" style="width:350px">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                	<label>绑定域名：</label>
                                    <div class="form-value">
                                    	<textarea class="form-control" rows="6" name="domains" style="width:350px"  placeholder="您要绑定的域名，一行一个，如：img.youdomain.com"></textarea>
                                    </div>
                                </dd>
                                <dd class="form-row">
                                	<label></label>
                                    <div class="form-value">
                                    	<button class="btn btn-primary" type="submit">确定开通</button> 
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
    $('#myfrom').submit(function(){
        if($('input[name="item_name"]').val()==''){
            layer.msg('项目名称不能为空', {offset: 200, shift: 6});
            $('input[name="item_name"]').select();
        }else if($('textarea[name="domains"]').val()==''){
            layer.msg('绑定的域名不能为空', {offset: 200, shift: 6});
            $('textarea[name="domains"]').select();
        }else{
            yh_ajax_post('<?=site_url('item/addAjax')?>', $(this).serialize(), function(data){
                if(data.errNum===0){
                    layer.msg(data.retMsg, {icon: 1}, function(){
                        yh_skip(G.backUrl);
                    });
                }else{
                    layer.msg(data.retMsg, {icon: 2});
                }
            });
        }
        return false;
    })

})
</script>
</body>
</html>
