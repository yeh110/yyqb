<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends CI_Controller {
	public $arctype;
	public function __construct(){
		parent::__construct();
		$this->load->model('Db_model');
		$this->load->config('global');
		$this->arctype = $this->config->item('arctype');
		$this->load->model('Admin_model');
	}

	public function index()
	{
		$this->Admin_model->isLogin('rurl');
		$data['menuid'] = 100;
		$get=$this->input->get(NULL, TRUE);
		$page = isset($get['p']) ? $get['p'] : 0;
		$pagesize = 20;
		$where = '1=1';
		if(isset($get['tid']) && $get['tid']>0)
		{
			$where.=" AND a.tid = {$get['tid']}";
			$url['tid'] = $get['tid'];
		}else{
			$url['tid'] = 0;
		}
		if(isset($get['bid']) && $get['bid']>0)
		{
			$where.=" AND a.bid = {$get['bid']}";
			$url['bid'] = $get['bid'];
		}else{
			$url['bid'] = 0;
		}
		$sql = "SELECT
			a.*, b.cnname
		FROM
			article AS a
		LEFT JOIN brand AS b ON b.id = a.bid
		WHERE
			{$where}
		ORDER BY
			a.sort DESC,
			a.senddate DESC
		LIMIT {$page}, {$pagesize}";
		$data['arctype'] = $this->arctype;
		$data['brand'] = $this->Db_model->get_all("SELECT id,cnname FROM brand");
		$data['listData'] = $this->Db_model->get_all($sql);
		$rst = $this->Db_model->get_one("SELECT count(id) AS num FROM article AS a WHERE {$where}");
		$this->load->model('Page_model');
		$moreurl = "?tid={$url['bid']}&bid={$url['bid']}";
		$data['pagelist'] = $this->Page_model->boot($rst['num'], $pagesize, admin_site("article/index").$moreurl,3);
		$data['url'] = $url;
		$this->load->view('admin/article_list', $data);
	}

	public function add()
	{
		$data['menuid'] = 100;
		$data['arctype'] = $this->arctype;
		$data['brand'] = $this->Db_model->get_all("SELECT id,cnname FROM brand");
		$this->load->view('admin/article_add', $data);
	}

	public function addAjax()
	{
		$post = $this->input->post(NULL, TRUE);
		$insertData = array(
				'title'		=> $post['title'],
				'videourl'	=> $post['videourl'],
				'litpic'	=> $post['litpic'],
				'tid'		=> $post['tid'],
				'bid'		=> $post['bid'],
				'senddate'	=> time(),
				'sort'		=> $post['sort']
			);
		if($this->Db_model->insert('article', $insertData)){
			jsonMsg('添加成功');
		}else{
			jsonMsg('添加失败，请重试', 1);
		}
	}

	public function edit()
	{
		if(!$id = $this->input->get('id', TRUE))
		{
			return msgShow('非法请求，请重试。');
		}
		elseif(!$data['field'] = $this->Db_model->get_one("SELECT * FROM article WHERE id=$id LIMIT 1"))
		{
			return msgShow('参数错误，请重试。');
		}
		$data['menuid'] = 100;
		$data['arctype'] = $this->arctype;
		$data['brand'] = $this->Db_model->get_all("SELECT id,cnname FROM brand");
		$this->load->view('admin/article_edit', $data);
	}

	public function editAjax()
	{
		$post = $this->input->post(NULL, TRUE);
		$sort = empty($post['sort']) ? 100 : $post['sort'];
		$updateData = array(
				'title'		=> $post['title'],
				'videourl'	=> $post['videourl'],
				'litpic'	=> $post['litpic'],
				'tid'		=> $post['tid'],
				'bid'		=> $post['bid'],
				'senddate'	=> time(),
				'sort'		=> $sort
			);
		if($this->Db_model->update('article', $updateData, "id={$post['id']}")){
			jsonMsg('修改成功');
		}else{
			jsonMsg('修改失败，请重试', 1);
		}
	}

	public function delete_one()
	{
		if(!$id = $this->input->get('id', TRUE))
		{
			jsonMsg('非法请求', 1);
		}
		$this->load->helper('file');
		if( ! $r = $this->Db_model->get_one("SELECT litpic FROM article WHERE id=$id")){
			jsonMsg('要删除的内容不存在或已经删除了', 1);
		}
		if($this->Db_model->delete('article',"id=$id"))
		{	
			//delete_files(FCPATH.ltrim($r['litpic'], '/'), false);//删除brand中的logo图片文件
			jsonMsg('删除成功', 0);
		}else{
			jsonMsg('删除失败，请重试', 1);
		}
	}

	public function delete_select()
	{
		$idarr = $this->input->post('id', TRUE);
		if(empty($idarr))
		{
			jsonMsg('你还没有选择要删除的内容', 1);
		}
		$this->load->helper('file');
		$idstr = implode(',', $idarr);
		$where = " id in({$idstr})";
		if( ! $rl = $this->Db_model->get_all("SELECT litpic FROM article WHERE $where")){
			jsonMsg('要删除的内容不存在或已经删除了', 1);
		}
		if($this->Db_model->delete('article', $where))
		{	
			foreach($rl AS $r)
			{
				//delete_files(FCPATH.ltrim($r['litpic'], '/'), false);//删除图片文件
			}
			jsonMsg('批量删除成功', 0);
		}else{
			jsonMsg('批量删除失败，请重试', 1);
		}
	}
}