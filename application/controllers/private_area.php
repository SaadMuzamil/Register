<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class private_area extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id'))
		{
			redirect('login');
		}
	}
	Public function index()
	{
		$this->load->view('wellcomeMsg');
		
	}
	Public function logout()
	{
		$data = $this->session->all_userdata();
		foreach ($data as $row => $value) {
			$this->session->unset_userdata($value);
		}
		redirect("login");
	}	
}
