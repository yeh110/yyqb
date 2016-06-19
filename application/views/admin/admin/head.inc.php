        	<div class="top-bar">
            	<div class="plus-nav">
                    <a href="#">帮助中心</a>
                </div>
                <div class="plus-nav">
                    <a href="#">问题反馈</a>
                </div>
            	<div class="user-info header-select">
                	<span class="username" id="username"><?=$user['uname']?></span>
                    <ul class="select-items user-nav">
                        <li><a href="<?=site_url('user/index')?>">个人信息</a></li>
                        <li><a href="<?=site_url('user/editInfo')?>">密码修改</a></li>
                        <li><a href="<?=site_url('user/exitLogin')?>">退出登陆</a></li>
                    </ul>
                </div>
            </div>