<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>数据管理</title>
<link href="<?=static_url('default/css/base.css')?>" rel="stylesheet" type="text/css">
<link href="<?=static_url('default/js/jqeury.dateRange/img/jqeury.dateRange.css')?>" rel="stylesheet">
<script src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
<script src="<?=static_url('default/js/jqeury.dateRange/jquery.dateRange.js')?>"></script>
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
                            <li><a href="<?=site_url('item/index')?>">返回项目</a></li>
                        	<li class="active"><a href="<?=site_url('mobile/index')?>?iid=<?=$url['iid']?>">数据管理</a></li>
                      	</ul>
                        <div class="where-warp">
                            <span class="where-btn">
                            	<a class="btn <?=$url['ac']=='all' ? 'btn-success' : 'btn-default'?>" href="<?=site_url('mobile/index/'.$url['p'])?>?iid=<?=$url['iid']?>&ac=all&sd=<?=$url['sd']?>&ed=<?=$url['ed']?>">全部</a>
                                <a class="btn <?=$url['ac']=='mine' ? 'btn-success' : 'btn-default'?>" href="<?=site_url('mobile/index/'.$url['p'])?>?iid=<?=$url['iid']?>&ac=mine&sd=<?=$url['sd']?>&ed=<?=$url['ed']?>">已购买</a>
                                <a class="btn <?=$url['ac']=='not' ? 'btn-success' : 'btn-default'?>" href="<?=site_url('mobile/index/'.$url['p'])?>?iid=<?=$url['iid']?>&ac=not&sd=<?=$url['sd']?>&ed=<?=$url['ed']?>">未购买</a>
                            </span>
                        	<span class="where-title">时间</span>
                            <span class="where-date">
                            	<input type="text" class="form-control" class="w150" id="input_date_show" readonly>
                            </span>
                            <input type="hidden" name="date_state" id="input_date_start">
                            <input type="hidden" name="date_end" id="input_date_end">
                            <span class="where-title">最近：</span>
                            <span class="where-lately">
                            	<a href="javascript:;" id="date_aToday">今天</a>
                                <a href="javascript:;" id="date_aYesterday">1天</a>
                                <a href="javascript:;" id="date_aRecent7Days">1周</a>
                                <a href="javascript:;" id="date_aRecent30Days">1月</a>
                            </span>
                        </div>
                        <div class="table-warp">
                            <form id="myform" method="post">
                        	<table class="table table-hover">
                            	<thead>
                                	<tr>
                                    	<th class="w30"><input type="checkbox" class="select_all"></th>
                                        <th class="w50">编号</th>
                                        <th class="w100">号码</th>
                                        <th class="wauto">受访页面</th>
                                        <th class="wauto">关键词</th>
                                        <th class="w70">IP地址</th>
                                        <th class="wauto">IP归属地</th>
                                        <th class="w40">次数</th>
                                        <th class="w140">时间</th>
                                        <th class="w100">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php foreach ($listData as $row):?>
                                	<tr>
                                    	<td><input type="checkbox" name="id[]" value="<?=$row['id']?>"></td>
                                        <td><?=$row['id']?></td>
                                        <td><?=hidtel($row['mobile'], $row['status'])?></td>
                                        <td><a href="<?=$row['url']?>" target="_bank" title="<?=$row['title']?>"><?=cn_substr($row['url'], 40)?></a></td>
                                        <td><a href="<?=$row['rurl']?>" target="_bank" title="<?=$row['word']?>"><?=cn_substr($row['word'], 60)?></a></td>
                                        <td><?=$row['ip']?></td>
                                      	<td><?=$row['ipcity']?></td>
                                        <td><?=$row['pv']?></td>
                                        <td><?=date("Y-m-d H:i:s", $row['newobdate'])?></td>
                                      	<td>
                                        	<a class="<?=$row['status']==0 ? 'mobile-buy-one' : 'link-disabled';?>" id="<?=$row['id']?>">购买</a>
                                            <a class="delete-one" href="javascript:;" id="<?=$row['id']?>">删除</a>
                                        </td>
                                    </tr>
<?php endforeach;?>
                                </tbody>
                            </table>
                            </form>
                            <table class="table" style="margin-top:-1px;">
                            	<tfoot>
                                	<tr>
                                    	<td width="20"><span class="tfoot-input"><input type="checkbox" class="select_all"></span></td>
                                        <td colspan="7">
                                        	<div class="tfoot-box clearfix">
                                            	<div class="tfoot-plus">
                                                	<button class="btn btn-default delete-more" type="button">删除所选</button> 
                                                    <button class="btn btn-default mobile-buy-more" type="button">购买所选</button>
                                                    <a class="btn btn-primary" href="<?=site_url('mobile/download')?>?iid=<?=$url['iid']?>&ac=<?=$url['ac']?>&sd=<?=$url['sd']?>&ed=<?=$url['ed']?>">导出EXCEL</a> 
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
var dateRange = new pickerDateRange('input_date_show', {
	aToday : 'date_aToday', //最近7天
	aYesterday : 'date_aYesterday',
	aRecent7Days : 'date_aRecent7Days', //最近7天
	aRecent30Days : 'date_aRecent30Days', //最近30天
    <?=$url['sd']!=0 ? "startDate : '{$url['sd']}'," : ''?>
    <?=$url['ed']!=0 ? "endDate : '{$url['ed']}'," : ''?>
	isTodayValid : true,
	autoSubmit : true,
	defaultText : ' - ',
	inputTrigger : 'input_date_show',
	theme : 'ta',
	success : function(obj) {
        yh_skip('<?=site_url('mobile/index/'.$url['p'])?>?iid=<?=$url['iid']?>&ac=<?=$url['ac']?>&sd='+obj.startDate+'&ed='+obj.endDate)
		$("#input_date_start").val(obj.startDate);
		$("#input_date_end").val(obj.endDate);
	}
});
$(function () {
     //单条删除
    $('.delete-one').click(function(){
        var id = $(this).attr('id');
        var layer_confirm_index = layer.confirm('你确定要删除该数据？不可恢复！', {
            btn: ['确定','取消'] //按钮
        }, function(){
            layer.close(layer_confirm_index);
            yh_ajax_get("<?=site_url('mobile/delone')?>?id="+id+"&t=" + Math.random());
        });
    })
    //批量删除多条
    $('.delete-more').click(function(){
        var layer_confirm_index = layer.confirm('你确定要删除该数据？不可恢复！', {
            btn: ['确定','取消'] //按钮
        },function(){
            layer.close(layer_confirm_index);
            yh_ajax_post('<?=site_url('mobile/delete')?>', $('#myform').serialize(), function(data){
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
    //单条数据购买
    $('.mobile-buy-one').click(function(){
        var id = $(this).attr('id');
        yh_ajax_get("<?=site_url('mobile/mobileBuyOne')?>?id="+id+"&t=" + Math.random());
    })

    //批量购买数据
    $('.mobile-buy-more').click(function(){
        yh_ajax_post('<?=site_url('mobile/mobileBuyMore')?>', $('#myform').serialize(), function(data){
            if(data.errNum===0){
                layer.msg(data.retMsg, {icon: 1}, function(){
                    location.reload();
                });
            }else{
                layer.msg(data.retMsg, {icon: 2});
            }
        });
    })
})
</script>
</body>
</html>
