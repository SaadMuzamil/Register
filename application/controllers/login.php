<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		$this->load->library("encrypt");
		$this->load->library('email');
		$this->load->model("login_model");
	}
	public function index()
	{
		$this->load->view('login');
	}
	public function validation()
	{
		$this->form_validation->set_rules('email','Email Address', 'required|trim|valid_email');
		$this->form_validation->set_rules('password','Password' , 'required');
		if($this->form_validation->run())
		{
			$result=$this->login_model->login($this->input->post('email'),$this->input->post('password'));
			if($result=="")
			{
					redirect('private_area');
			}
			else
			{
				$this->session->set_flashdata('message',$result);
				redirect('login');
			}
		}	
		else
		{
			$this->index();
		}
	}
	
}
