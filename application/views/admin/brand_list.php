<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>品牌管理</title>
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
                            <li class="active"><a href="<?=admin_site('brand/index')?>">品牌管理</a></li>
                            <li><a href="<?=admin_site('brand/add')?>">品牌添加</a></li>
                      	</ul>
                        <div class="table-warp" style="padding: 25px 20px 35px 20px;">
                            <form id="myform" action="" method="post">
                        	<table class="table table-hover">
                            	<thead>
                                	<tr>
                                    	<th width="20"><input type="checkbox" class="select_all"></th>
                                        <th width="80">编号</th>
                                        <th>中文名称</th>
                                        <th>英文名称</th>
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
                                        <td><?=$row['cnname']?></td>
                                        <td><?=$row['enname']?></td>
                                        <td><?=$row['sort']?></td>
                                        <td><?=date('Y-m-d H:i:s', $row['updatetime'])?></td>
                                        <td>
                                            <a href="<?=admin_site('brand/edit/')?>?id=<?=$row['id']?>">修改</a>
                                            <a id="<?=$row['id']?>" class="item_del" href="javascript:;">删除</a>
                                        </td>
                                    </tr>
<?php endforeach;} ?>
                                </tbody>
                            </table>
                            <?php if($pagelist){?>
                            <table class="table" style="margin-top:-1px;">
                            	<tfoot>
                                	<tr>
                                    	<td width="20"></td>
                                        <td colspan="7">
                                        	<div class="tfoot-box clearfix">

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
                            <?php  } ?>
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
        var layer_confirm_index = layer.confirm('你确定要删除该品牌？</br>将连同数据一起删除，不可恢复！', {
            btn: ['确定','取消'] //按钮
        }, function(){
            layer.close(layer_confirm_index);
            yh_ajax_get("<?=admin_site('brand/delete')?>?id="+id+"&t=" + Math.random());
        });
    })
})
</script>
</body>
</html>
