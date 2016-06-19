<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>网站设置</title>
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
                            <li class="active"><a href="<?=admin_site('system/edit')?>">网站设置</a></li>
                      	</ul>
                        <div class="content-box">
                            <form id="myform" method="post">
                        	<dl class="detail-part">
                            	<dd class="form-row">
                                	<label>网站名称：</label>
                                    <div class="form-value">
                                    	<input type="text" class="form-control" name="webname" value="<?=$field['webname']?>" style="width:550px">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>关键词：</label>
                                    <div class="form-value">
                                        <input type="text" class="form-control" name="keywords" value="<?=$field['keywords']?>" style="width:550px" placeholder="多个关键词用,英文逗号隔开">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>网站描述：</label>
                                    <div class="form-value">
                                        <textarea class="form-control" rows="6" name="description" style="width:550px;"><?=$field['description']?></textarea>
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>统计代码：</label>
                                    <div class="form-value">
                                        <textarea class="form-control" rows="6" name="tongji" style="width:550px;"><?=$field['tongji']?></textarea>
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>其他代码：</label>
                                    <div class="form-value">
                                        <textarea class="form-control" rows="6" name="otherjs" style="width:550px;"><?=$field['otherjs']?></textarea>
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
        if($('input[name="webname"]').val() == ''){
            layerMsg('网站名称不能为空');
            $('input[name="webname"]').select();
        }else{
            yh_ajax_post('<?=admin_site('system/editAjax')?>', $(this).serialize(), function(data){
                if(data.errNum===0){
                    layerMsg(data.retMsg, 1, 1500, function(){location.reload();});
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
