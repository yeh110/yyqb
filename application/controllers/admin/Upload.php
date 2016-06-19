<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function do_upload(){
		$uploadfile = 'uploads/'.date('ymd',time()).'/';
		$config['upload_path'] = FCPATH.$uploadfile;
		$config['file_name'] = date('ymdHis',time()).'_'.mt_rand(10000,99999);
		$config['file_ext_tolower'] = true;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size'] = '2048';
		mkdirs($config['upload_path']);
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('imgFile'))
		{
			$rstdata = array('error' => 1, 'message' => $this->upload->display_errors());
		}else{
			$rst = $this->upload->data();
			$rstdata = array('error' => 0, 'url' => '/'.$uploadfile.$rst['file_name']);
		}
		echo json_encode($rstdata);
	}
}
?>