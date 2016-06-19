    	<div class="main-sidebar">
        	<div class="side-menu">
            	<div class="logo">
                	<div class="main-logo"><a href="/"><img src="<?=static_admin('images/logo.png')?>" width="180" height="50"/></a></div>
                    <div class="main-menu">
                   	  <ul class="level-1-menu">
                            <li class="menu-item<?=$menuid==100 ? ' active' : NULL?>"><a href="<?=admin_site('article/index')?>">内容管理</a></li>
                            <li class="menu-item<?=$menuid==200 ? ' active' : NULL?>"><a href="<?=admin_site('brand/index')?>">品牌分类</a></li>
                            <li class="menu-user<?=$menuid>=300 && $menuid<400 ? ' li-open' : NULL?>"><a href="javascript:;">系统设置</a>
                            	<ul class="level-2-menu">
                            		<li<?=$menuid==301 ? ' class="active"' : NULL?>><a href="<?=admin_site('system/edit')?>">网站设置</a></li>
                            		<li<?=$menuid==302 ? ' class="active"' : NULL?>><a href="<?=admin_site('user/editPass')?>">密码修改</a></li>
                                    <li<?=$menuid==303 ? ' class="active"' : NULL?>><a href="<?=admin_site('user/exitLogin')?>">退出登陆</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>  