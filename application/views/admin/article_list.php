<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>内容管理</title>
<link href="<?=static_admin('css/base.css')?>" rel="stylesheet" type="text/css">
<script src="<?=static_admin('js/jquery.min.js')?>"></script>
<script src="<?=static_admin('js/layer/layer.js')?>"></script>
<script src="<?=static_admin('js/base.js')?>"></script>
<script>window.onresize = window.onload = function(){$("#content-wrap").height($(window).height()-51);}</script>
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
                            <li class="active"><a href="<?=admin_site('article/index')?>">内容管理</a></li>
                            <li><a href="<?=admin_site('article/add')?>">内容添加</a></li>
                      	</ul>
                        <div class="where-warp">
                            <form action="<?=admin_site('article/index')?>" method="get">
                            <span class="where-sel">
                                <select class="form-control" name="tid" style="width:120px">
                                    <option value="0">选择栏目</option>
                                    <?php foreach ($arctype as $r):?>
                                     <option value="<?=$r['tid']?>"<?=$url['tid']==$r['tid'] ? ' selected' : NULL?>><?=$r['typename']?></option>
                                    <?php endforeach; unset($arctype, $r)?>
                                </select>
                            </span>
                            <span class="where-sel">
                                <select class="form-control" name="bid" style="width:120px">
                                    <option value="0">选择品牌</option>
                                    <?php foreach ($brand as $r):?>
                                     <option value="<?=$r['id']?>"<?=$url['bid']==$r['id'] ? ' selected' : NULL?>><?=$r['cnname']?></option>
                                    <?php endforeach; unset($brand, $r)?>
                                </select>
                            </span>
                            <span class="where-btn">
                                <button class="btn btn-success" type="submit">检索</button>
                            </span>
                            </form>
                        </div>
                        <div class="table-warp">
                            <form id="myform" action="" method="post">
                        	<table class="table table-hover">
                            	<thead>
                                	<tr>
                                    	<th width="20"><input type="checkbox" class="select_all"></th>
                                        <th width="80">编号</th>
                                        <th>标题</th>
                                        <th width="150">栏目</th>
                                        <th width="150">品牌</th>
                                        <th width="100">排序</th>
                                        <th width="180">添加时间</th>
                                        <th width="100">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php if($listData){foreach ($listData as $row): ?>
                                	<tr>
                                    	<td><input type="checkbox" name="id[]" value="<?=$row['id']?>"></td>
                                        <td><?=$row['id']?></td>
                                        <td><a href="<?=$row['videourl']?>" target="_blank"><?=$row['title']?></a></td>
                                        <td><?=getTypename($row['bid'])?></td>
                                        <td><?=$row['cnname']?></td>
                                        <td><?=$row['sort']?></td>
                                        <td><?=date('Y-m-d H:i:s', $row['senddate'])?></td>
                                        <td>
                                            <a href="<?=admin_site('article/edit/')?>?id=<?=$row['id']?>">修改</a>
                                            <a id="<?=$row['id']?>" class="item_del" href="javascript:;">删除</a>
                                        </td>
                                    </tr>
<?php endforeach;} ?>
                                </tbody>
                            </table>
                            <table class="table" style="margin-top:-1px;">
                            	<tfoot>
                                	<tr>
                                    	<td width="20"><span class="tfoot-input"><input type="checkbox" class="select_all"></span></td>
                                        <td colspan="7">
                                        	<div class="tfoot-box clearfix">
                                            	<div class="tfoot-plus">
                                                	<button class="btn btn-default delete_select" type="button">删除所选</button> 
                                                </div>
                                                <div class="pagination-box">
                                                    <ul class="pagination">
                                                    <?=$pagelist?>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
     //单条删除
    $('.item_del').click(function(){
        var id = $(this).attr('id');
        var layer_confirm_index = layer.confirm('你确定要删除该内容? 不可恢复！', {
            btn: ['确定','取消'] //按钮
        }, function(){
            layer.close(layer_confirm_index);
            yh_ajax_get("<?=admin_site('article/delete_one')?>?id="+id+"&t=" + Math.random());
        });
    })

    $('.delete_select').click(function(){
        var  postdata = $('#myform').serialize();
        if(!postdata){
            layerMsg('您还没有选择要删除的内容');
        }else{
            var layer_confirm_index = layer.confirm('你确定要删除所选内容? 不可恢复！', {
                btn: ['确定','取消'] //按钮
            },function(){
                layer.close(layer_confirm_index);
                yh_ajax_post('<?=admin_site('article/delete_select')?>', postdata, function(data){
                    if(data.errNum===0){
                        layerMsg(data.retMsg, 1, 1500, function(){location.reload();});
                    }else{
                        layerMsg(data.retMsg);
                    }
                });
            });
        }
        return false;
    })
})
</script>
</body>
</html>
