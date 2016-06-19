<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>通用后台首页</title>
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
                        	<li class="active"><a href="<?=site_url('item/index')?>">项目管理</a></li>
                            <li><a href="<?=site_url('item/add')?>">项目添加</a></li>
                      	</ul>
                        <div class="table-warp">
                            <form id="myform" action="" method="post">
                        	<table class="table table-hover">
                            	<thead>
                                	<tr>
                                    	<th width="20"><input type="checkbox" class="select_all"></th>
                                        <th width="80">编号</th>
                                        <th>项目名称</th>
                                        <th width="100">数量</th>
                                        <th width="100">状态</th>
                                        <th width="180">创建时间</th>
                                        <th width="250">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php if($listData){foreach ($listData as $row): ?>
                                	<tr>
                                    	<td><input type="checkbox" name="iid[]" value="<?=$row['iid']?>"></td>
                                        <td><?=$row['iid']?></td>
                                        <td><a href="<?=site_url('mobile/index')?>?iid=<?=$row['iid']?>"><?=$row['item_name']?></a></td>
                                        <td><?=$row['obnums']?></td>
                                        <td><?=$row['status']==1 ? '<span class="text-green">正常运行</span>' : '<span class="text-danger">暂停中</span>'?></td>
                                        <td><?=date('Y-m-d H:i:s', $row['senddate'])?></td>
                                        <td>
                                        	<a href="<?=site_url('mobile/index')?>?iid=<?=$row['iid']?>">查看数据</a>
                                            <a href="<?=site_url('item/getcode')?>?iid=<?=$row['iid']?>">获取代码</a>
                                            <a href="<?=site_url('item/edit/'.$row['iid'])?>">修改</a>
                                            <a id="<?=$row['iid']?>" class="item_del" href="javascript:;">删除</a>
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
                                                	<button class="btn btn-default delete_more" type="button">删除所选</button> 
                                                    <button class="btn btn-default editstatus_more" type="button" data-action="stop">停止所选</button> 
                                                    <button class="btn btn-default editstatus_more" type="button" data-action="start">启用所选</button>
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
        var iid = $(this).attr('id');
        var layer_confirm_index = layer.confirm('你确定要删除该项目？不可恢复！', {
            btn: ['确定','取消'] //按钮
        }, function(){
            layer.close(layer_confirm_index);
            yh_ajax_get("<?=site_url('item/delone')?>?iid="+iid+"&t=" + Math.random());
        });
    })
    //批量删除多条
    $('.delete_more').click(function(){
        var layer_confirm_index = layer.confirm('你确定要删除该项目？不可恢复！', {
            btn: ['确定','取消'] //按钮
        }, function(){
            layer.close(layer_confirm_index);
            yh_ajax_post('<?=site_url('item/delete')?>', $('#myform').serialize(), function(data){
                if(data.errNum===0){
                    layer.msg(data.retMsg, {icon: 1}, function(){
                        location.reload();
                    });
                }else{
                    layer.msg(data.retMsg, {icon: 2});
                }
            });
        });
    })
    //状态批量更新
    $('.editstatus_more').click(function(){
        var action = $(this).attr('data-action');
        yh_ajax_post('<?=site_url('item/editStatus')?>?action='+action, $('#myform').serialize(), function(data){
            if(data.errNum===0){
                layer.msg(data.retMsg, {icon: 1}, function(){
                    location.reload();
                });
            }else{
                layer.msg(data.retMsg, {icon: 2});
            }
        });
    })
    //单条状态更新
    $('.item_disable').click(function(){
        var iid = $(this).attr('id');
        var layer_confirm_index = layer.confirm('你确定要删除该项目？不可恢复！', {
            btn: ['确定','取消'] //按钮
        }, function(){
            layer.close(layer_confirm_index);
            yh_ajax_get("<?=site_url('item/delone')?>?iid="+iid+"&t=" + Math.random());
        });
    })

})
</script>
</body>
</html>
