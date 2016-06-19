<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Db_model');
		$this->load->model('Admin_model');
		$this->load->library('user_agent');
	}

	public function index()
	{
		if($this->Admin_model->isLogin())
		{
			return msgShow('你已经登陆了，无需重新登陆。', admin_site());
		}
		if($this->input->get('redirectUrl')){
			$data['redirectUrl'] = $this->input->get('redirectUrl');
		}elseif($rurl = $this->agent->referrer()){
			$data['redirectUrl'] = $rurl;
		}else{
			$data['redirectUrl'] = site_url();
		}
		$this->load->view('admin/login', $data);
	}

	public function userLoginAjax()
	{
		
		if(strstr($this->agent->referrer(), site_url()))
		{
			$post = $this->input->post(NULL,TRUE);
			$user = trim($post['username']);
			$pass = trim($post['password']);
			$code = trim($post['verifycode']);
			echo json_encode($this->Admin_model->login($user, $pass, $code));
		}
		else
		{
			echo json_encode(array('code'=>10050, 'msg'=>'Bad Request'));
		}
	}
}