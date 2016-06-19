<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends Home_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Item_model');
		$this->load->model('User_model');
	}

	public function index()
	{
		redirect(site_url('item/index'));
	}
}