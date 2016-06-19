<?php defined('BASEPATH') OR exit('No direct script access allowed');
class System extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Db_model');
	}

	public function edit()
	{
		$data['menuid'] = 301;
		$data['field'] = $this->Db_model->get_one("SELECT * FROM system WHERE id = 1");
		$this->load->view('admin/system', $data);
	}

	public function editAjax()
	{
		$post = $this->input->post(NULL, FALSE);
		$updateData = array(
				'webname'		=> $post['webname'],
				'keywords'	=> $post['keywords'],
				'description'	=> $post['description'],
				'tongji'		=> $post['tongji'],
				'otherjs'		=> $post['otherjs']
			);
		if($this->Db_model->update('system', $updateData, "id=1")){
			jsonMsg('修改成功');
		}else{
			jsonMsg('修改失败，请重试', 1);
		}
	}
}