<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>内容添加</title>
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
    backUrl : '<?=admin_site('article/index')?>',
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
                            <li><a href="<?=admin_site('article/index')?>">内容管理</a></li>
                            <li class="active"><a href="<?=admin_site('article/add')?>">内容添加</a></li>
                      	</ul>
                        <div class="content-box">
                            <form id="myform" method="post">
                        	<dl class="detail-part">
                            	<dd class="form-row">
                                	<label>内容标题：</label>
                                    <div class="form-value">
                                    	<input type="text" class="form-control" name="title" style="width:400px">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>视频地址：</label>
                                    <div class="form-value">
                                        <input type="text" class="form-control" name="videourl" style="width:400px">
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>视频图片：</label>
                                    <div class="form-value">
                                        <input type="text" class="form-control fl" name="litpic" style="width:330px;margin-right:10px;" readonly><button class="btn btn-default fl" type="button" name="uploadbtn">上传</button> 
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>所属栏目：</label>
                                    <div class="form-value">
                                        <select class="form-control" name="tid" style="width:400px">
                                            <option value="0">-请选择-</option>
                                            <?php foreach ($arctype as $r):?>
                                             <option value="<?=$r['tid']?>"><?=$r['typename']?></option>
                                            <?php endforeach; unset($arctype, $r)?>
                                        </select>
                                    </div>
                                </dd>

                                <dd class="form-row">
                                    <label>所属品牌：</label>
                                    <div class="form-value">
                                        <select class="form-control" name="bid" style="width:400px">
                                            <option value="0">-请选择-</option>
                                            <?php foreach ($brand as $r):?>
                                             <option value="<?=$r['id']?>"><?=$r['cnname']?></option>
                                            <?php endforeach; unset($brand, $r)?>
                                        </select>
                                    </div>
                                </dd>
                                <dd class="form-row">
                                    <label>排序：</label>
                                    <div class="form-value">
                                        <input type="text" class="form-control fl" name="sort" value="100" style="width:120px"> <span class="text-999 fl" style="line-height:30px;">（越大越靠前）</span>
                                    </div>
                                </dd>
                                <dd class="form-row">
                                	<label></label>
                                    <div class="form-value">
                                    	<button class="btn btn-primary" type="submit">确定添加</button> 
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
                    imageUrl : K("input[name='litpic']").val(),
                    showRemote : false,
                    clickFn : function(url, title, width, height, border, align) {
                        K("input[name='litpic']").val(url);
                        editor.hideDialog();
                    }
                });
            });
        });
    });

    $('#myform').submit(function(){
        if($('input[name="title"]').val()==''){
            layerMsg('内容标题不能为空');
            $('input[name="title"]').select();
        }else if($('input[name="videourl"]').val()==''){
            layerMsg('视频地址不能为空');
            $('input[name="videourl"]').select();
        }else if($('input[name="litpic"]').val()==''){
            layerMsg('请上传品牌图片');
        }else if($('select[name="tid"]').val()=='0'){
            layerMsg('请选择所属栏目');
        }else if($('select[name="bid"]').val()=='0'){
            layerMsg('请选择所属品牌');
        }else{
            yh_ajax_post('<?=admin_site('article/addAjax')?>', $(this).serialize(), function(data){
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
