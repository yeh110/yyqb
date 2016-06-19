<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page_model extends CI_Model
{
	function __construct(){
  		parent::__construct();
  		$this->load->library('pagination');
	}
	public function boot($rows,$size=20,$url,$urinum=3,$suffix=''){
		$config['use_global_url_suffix'] = FALSE;
		$config['suffix'] = $suffix;
		$config ['num_links'] = 5; // 当前连接前后显示页码个数
		$config['base_url'] = $url;
		$config['total_rows'] = $rows;
		$config['per_page'] = $size; 
		$config['uri_segment'] =$urinum;

		$config['page_query_string'] = TRUE; //get参数形式显示
		$config['query_string_segment'] = 'p'; //get参数形式显示自定义参数名称 ?p=

		//当前链接标签
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		//左边显示“第一页”链接的名字
		$config['first_link'] = '«';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		//右边显示“最后一页”链接的名字
		$config['last_link'] = '»';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		//下一页链接
		$config['next_link'] = '›';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		//上一页
		$config['prev_link'] = '‹';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		//页码标签
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['anchor_class'] = " class=\"link\" ";
		$this->pagination->initialize($config); 
		return $this->pagination->create_links();
	}

	//默认前台分页
	/**
	 * 总条数/一页数量/分页链接/分页段数/按钮数量/显示第一页/显示最后一页/显示上一页/显示下一页/分页信息多少页多少条/ 
	 */
	public function dpage($rows,$size=20, $url, $urinum=3, $num_links=5, $suffix='', $style='active', $onepage='首页', $endpage='末页', $prevpage='上一页', $nextpage='下一页', $info=false){
		$config['suffix'] = $suffix;		//自定义前缀添加到分页URL
		$config['total_rows'] = $rows;		//总条数
		$config['per_page'] = $size;		//一页数量
		$config['base_url'] = $url;			//链接URL
		$config ['num_links'] = $num_links; // 当前连接前后显示页码个数
		$config['uri_segment'] =$urinum;	//URL路由段
		//当前链接标签
		$config['cur_tag_open'] = '<a class="'.$style.'">';
		$config['cur_tag_close'] = '</a>';

		//左边显示“首页”链接的名字
		if($onepage){
			$config['first_link'] = $onepage;
			$config['first_tag_open'] = '';
			$config['first_tag_close'] = '';
		}else{
			$config['first_link'] = false;
		}

		//显示“末页”链接的名字
		if($endpage){
			$config['last_link'] = $endpage;
			$config['last_tag_open'] = '';
			$config['last_tag_close'] = '';
		}else{
			$config['last_link'] = false;
		}

		//显示"下一页"链接的名字
		if($nextpage){
			$config['next_link'] = $nextpage;
			$config['next_tag_open'] = '';
			$config['next_tag_close'] = '';
		}else{
			$config['prev_link']=false;
		}

		//显示"上一页"链接的名字
		if($prevpage){
			$config['prev_link'] = $prevpage;
			$config['prev_tag_open'] = '';
			$config['prev_tag_close'] = '';
		}else{
			$config['prev_link']=false;
		}
				//页码标签
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config); 
		return $this->pagination->create_links();
	}
}