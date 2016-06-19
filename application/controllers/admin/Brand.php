<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Brand extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Db_model');
	}

	public function index()
	{
		$data['menuid'] = 200;
		$get=$this->input->get(NULL, TRUE);
		$page = isset($get['p']) ? $get['p'] : 0;
		$pagesize = 20;
		$data['listData'] = $this->Db_model->get_all("SELECT * FROM brand ORDER BY updatetime DESC LIMIT $page, $pagesize");
		$rst = $this->Db_model->get_one('SELECT count(id) AS num FROM brand');
		$this->load->model('Page_model');
		$data['pagelist'] = $this->Page_model->boot($rst['num'], $pagesize, admin_site("brand/index"),3);
		$this->load->view('admin/brand_list', $data);
	}

	public function add()
	{
		$data['menuid'] = 200;
		$this->load->view('admin/brand_add', $data);
	}

	public function addAjax()
	{
		$post = $this->input->post(NULL, TRUE);
		$insertData = array(
				'cnname'	=> $post['cnname'],
				'enname'	=> $post['enname'],
				'logofile'	=> $post['logofile'],
				'updatetime'=> time(),
				'sort'		=> $post['sort']
			);
		if($this->Db_model->insert('brand', $insertData)){
			jsonMsg('添加成功');
		}else{
			jsonMsg('添加失败，请重试', 1);
		}
	}

	public function edit()
	{
		$data['menuid'] = 200;
		if(!$id = $this->input->get('id', TRUE))
		{
			return msgShow('非法请求，请重试。');
		}
		elseif(!$data['field'] = $this->Db_model->get_one("SELECT * FROM brand WHERE id=$id LIMIT 1"))
		{
			return msgShow('参数错误，请重试。');
		}
		$this->load->view('admin/brand_edit', $data);
	}

	public function editAjax()
	{
		$post = $this->input->post(NULL, TRUE);
		$sort = empty($post['sort']) ? 100 : $post['sort'];
		$updateData = array(
				'cnname' 	=> $post['cnname'],
				'enname'	=> $post['enname'],
				'logofile'	=> $post['logofile'],
				'updatetime'=>time(),
				'sort' 		=> $sort
			);
		if($this->Db_model->update('brand', $updateData, "id={$post['id']}")){
			jsonMsg('修改成功');
		}else{
			jsonMsg('修改失败，请重试', 1);
		}
	}

	public function delete()
	{
		if(!$id = $this->input->get('id', TRUE))
		{
			jsonMsg('非法请求', 1);
		}
		$this->load->helper('file');
		if( ! $b = $this->Db_model->get_one("SELECT logofile FROM brand WHERE id=$id")){
			jsonMsg('要删除的品牌不存在或已经删除了', 1);
		}
		if($this->Db_model->delete('brand',"id=$id"))
		{	
			//delete_files(FCPATH.ltrim($b['logofile'], '/'), false);//删除brand中的logo图片文件
			if($row = $this->Db_model->get_all("SELECT litpic FROM article WHERE bid=$id"))
			{
				foreach ($row as $r) {
					//delete_files(FCPATH.ltrim($r['litpic'], '/'), false);
				}
			}
			$this->Db_model->delete('article', "bid=$id");
			jsonMsg('删除成功', 0);
		}else{
			jsonMsg('删除失败，请重试', 1);
		}
	}
}