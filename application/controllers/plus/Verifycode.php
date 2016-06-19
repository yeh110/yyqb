<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifycode extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Validatecode_model');
	}

	public function index ()
	{
		$this->Validatecode_model->doimg();
	}

}