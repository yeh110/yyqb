<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Db_model');
		$this->load->model('Admin_model');
	}

	public function editPass()
	{
		$data['menuid'] = 302;
		$this->load->view('admin/user_editPass', $data);
	}

	public function editPassAjax()
	{
		$post = $this->input->post(NULL, TRUE);
		$oldpass = md5(trim($post['oldpass']));
		if(empty($post['oldpass']))
		{
			jsonMsg('旧密码不能为空', 1);
		}
		elseif(!$this->Db_model->get_one("SELECT mid FROM admin WHERE mid=16388 AND pass='{$oldpass}' LIMIT 1"))
		{
			jsonMsg('旧密码输入的不正确', 1);
		}
		elseif(strlen(trim($post['pass']))<6)
		{
			jsonMsg('密码最少为6个字符', 1);
		}
		elseif(trim($post['pass'])!=trim($post['pass2']))
		{
			jsonMsg('两次输入的密码不一样', 1);
		}
		if($this->Db_model->update('admin', array('pass'=>md5(trim($post['pass']))), "mid=16388")){
			jsonMsg('密码修改成功，请重新登录');
		}else{
			jsonMsg('密码修改失败，请重试', 1);
		}
	}

	//退出系统
	public function loginOut()
	{
		$this->Admin_model->out();
		$this->load->library('user_agent');
		if( ! $rurl = $this->agent->referrer())
		{
			$rurl=admin_site('index');
		}
		$url = admin_site('index/login').'?redirectURL='.urlencode($rurl);
		return msgShow('退出成功，跳转中！', $url);
	}
}
