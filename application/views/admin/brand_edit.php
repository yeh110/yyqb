<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>品牌修改</title>
<link rel="shortcut icon" href="/favicon.ico">
<link href="<?=static_admin('css/base.css')?>" rel="stylesheet" type="text/css">
<link href="<?=static_admin('js/kindeditor/themes/default/default.css')?>" rel="stylesheet" type="text/css">
<script src="<?=static_admin('js/jquery.min.js')?>"></script>
<script src="<?=static_admin('js/layer/layer.js')?>"></script>
<script src="<?=static_admin('js/kindeditor/kindeditor-min.js')?>"></script>
<script src="<?=static_admin('js/kindeditor//lang/zh_CN.js')?>"></script>
<script src="<?=static_admin('js/base.js')?>"></script>
<script>window.onresize = window.onload = function(){$("#content-wrap").height($(window).height()-51);}</script>
<script type="text/javascript">
var G= {
    nowUrl : '<?=current_url()?>',
    loginUrl : '<?=admin_base('login')?>',
    backUrl : '<?=admin_site('brand/index')?>',
    uploadUrl: '<?=admin_site('upload/do_upload')?>'
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
                            <li><a href="<?=admin_site('brand/index')?>">品牌管理</a></li>
                            <li><a href="<?=admin_site('brand/add')?>">品牌添加</a></li>
                            <li class="active"><a href="<?=admin_site('brand/edit')?>?=id<?=$field['id']?>">品牌修改</a></li>
                      	</ul>
                        <div class="content-box">
                            <form id="myform" method="post">
                            <input type="hidden" name="id" value="<?=$field['id']?>">
                        	<dl class="detail-part">
                            	<dd class="form-row">
                                	<label>中文名称：</label>
                                    <div class="form-value">
                                    	<input type="text" class="form-control" name="cnname" value="<?=$field['cnname']?>" style="width:400px">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>英文名称：</label>
                                    <div class="form-value">
                                        <input type="text" class="form-control" name="enname" value="<?=$field['enname']?>" style="width:400px">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>品牌图片：</label>
                                    <div class="form-value">
                                        <input type="text" class="form-control fl" name="logofile" value="<?=$field['logofile']?>" style="width:330px;margin-right:10px;" readonly><button class="btn btn-default fl" type="button" name="uploadbtn">上传</button> 
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>排序：</label>
                                    <div class="form-value">
                                        <input type="text" class="form-control fl" name="sort" value="<?=$field['sort']?>" style="width:120px"> <span class="text-999 fl" style="line-height:30px;">（越大越靠前）</span>
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
    var editor;
    KindEditor.ready(function(K) {

        var editor = K.editor({
            uploadJson : G.uploadUrl+'?artion=litpic',
        });
        K("button[name='uploadbtn']").click(function() {
            editor.loadPlugin('image', function() {
                editor.plugin.imageDialog({
                    imageUrl : K("input[name='logofile']").val(),
                    showRemote : false,
                    clickFn : function(url, title, width, height, border, align) {
                        K("input[name='logofile']").val(url);
                        editor.hideDialog();
                    }
                });
            });
        });
    });

    $('#myform').submit(function(){
        if($('input[name="cnname"]').val()==''){
            layerMsg('中文名称不能为空');
            $('input[name="cnname"]').select();
        }else if($('input[name="enname"]').val()==''){
            layerMsg('英文名称不能为空');
            $('input[name="enname"]').select();
        }else if($('input[name="logofile"]').val()==''){
            layerMsg('请上传品牌图片');
            $('input[name="logofile"]').select();
        }else{
            yh_ajax_post('<?=admin_site('brand/editAjax')?>', $(this).serialize(), function(data){
                if(data.errNum===0){
                    layerMsg(data.retMsg, 1, 1500, function(){yh_skip(G.backUrl);});
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
