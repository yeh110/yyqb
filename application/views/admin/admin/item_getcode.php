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
<script type="text/javascript">
    var G = {
        backUrl : '<?=site_url('item/index')?>'
    };
</script>
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
                            <li><a href="<?=site_url('item/add')?>">项目添加</a></li>
                            <li class="active"><a href="<?=site_url('item/getcode')?>?iid=<?=$iid?>">代码获取</a></li>
                      	</ul>
                        <div class="content-box">
                        	<dl class="detail-part">
                                <dd class="form-row">
                                	<label>页面部署：</label>
                                    <div class="form-value">
                                    	<textarea class="form-control w500" rows="6" readonly >(function(a,d,e,i,p){i=<?=$user['uid']?>; e=<?=$iid?>; d=document; p={d:d.domain, u:d.location.href, t:d.title, r:d.referrer, a:'<?=site_url('hm/pd')?>?id='+i+'&e='+e}; a=p.a+'&d='+p.d+'&u='+decodeURIComponent(p.u)+'&t='+decodeURIComponent(p.t)+'&r='+decodeURIComponent(p.r); d.writeln(unescape("%3Cscript src='" + a + "' type='text/javascript'%3E%3C/script%3E")); })();</textarea>
                                    </div>
                                </dd>
                                <dd class="form-row">
                                	<label>调用部署：</label>
                                    <div class="form-value">
                                    	<textarea class="form-control w500" rows="2" readonly ><script type="text/javascript" src="<?=site_url('hm/js')?>?id=<?=$iid?>"></script></textarea>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
    $(function(){
        $('textarea').click(function(){
            $(this).select();
        })
    })

</script>
</body>
</html>
