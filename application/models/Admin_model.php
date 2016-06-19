<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{
	var $CI;
	var $user;
	var $priv;

	public function __construct(){
  		parent::__construct();
  		$this->CI =& get_instance();
  		$this->CI->load->model('Db_model');
		$this->CI->load->library('session');
	}

	//判断是否登陆
	public function _ckLogin()
	{
		//判断  session uid是否存在
		if($mid=$this->CI->session->userdata('mid'))
		{

			//读取uid对应的用户数据
			if($this->user = $this->CI->Db_model->get_one("SELECT * FROM admin WHERE mid='$mid' LIMIT 1") )
			{
				
				//判断 session secret是否为空
				if($skey = $this->CI->session->userdata('skey') )
				{
					//对比secret是否正确
					if($skey == md5($this->user['mid'].$this->user['pass'].$this->user['uname']) )
					{
						$this->_setUserSession($mid, $skey);
						return $this->user;
					}
				}

			}

		}
		$this->_unUserSession();
		return FALSE;
	}

	//设置登陆用户的SESSION
	public function _setUserSession($mid, $skey)
	{
		if( $mid && $skey ){
			$this->CI->session->set_userdata('mid', $mid);
			$this->CI->session->set_userdata('skey', $skey);
		}
	}

	//销毁登陆用户的SESSION
	public function _unUserSession()
	{
		$this->CI->session->set_userdata('mid', '');
		$this->CI->session->set_userdata('skey', '');
	}

	//退出系统
	public function out()
	{
		$this->_unUserSession();
	}

	public function login($uname, $pass, $code='')
	{
		//判断系统是否开启登陆验证码
		$uname = strtolower(trim($uname));
		$pass  = strtolower(trim($pass));
		$code  = strtolower(trim($code));
		$pass = md5($pass);
		if(empty($code)){
			return array('code'=>10030, 'msg'=>'您还没有输入验证码，请先输入。', 'inputId'=>'verifycode');
		}
		elseif( md5($code.$code) != $this->CI->session->userdata('code') )
		{
			return array('code'=>10032, 'msg'=>'您输入的验证码不正确，请重新输入。', 'inputId'=>'verifycode');
		}
		elseif($user = $this->CI->Db_model->get_one("SELECT * FROM admin WHERE uname = '$uname' AND pass = '$pass' LIMIT 1") )
		{
			$skey = md5($user['mid'].$user['pass'].$user['uname']);
			$this->CI->session->set_userdata('mid', $user['mid']);
			$this->CI->session->set_userdata('skey', $skey);
			//$this->CI->Db_model->update('admin', array('loginnums'=>$user['loginnums']+1), "mid = '$user[mid]'");
			return array('code'=>10028, 'msg'=>'登陆成功');
		}
		return array('code'=>10030, 'msg'=>'您输入的帐号或者密码不正确，请重新输入。', 'inputId'=>'pass');
	}

	//判断是否登陆
	public function isLogin($action='boole')
	{
		if($rst = $this->_ckLogin())
		{
			return $rst;
		}
		switch ($action) {
			case 'boole':
				return FALSE;
				break;

			case 'home':
				redirect(admin_site('login').'?redirectUrl='.urlencode(admin_site()) );
				break;

			case 'rurl':
				redirect(admin_site('login').'?redirectUrl='.urlencode(current_url()) );
				break;
			
			default:
				redirect(admin_site('login').'?redirectUrl='.urlencode($action) );
				break;
		}
	}
}