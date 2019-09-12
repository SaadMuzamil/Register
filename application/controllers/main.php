<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		$this->load->library("encrypt");
		$this->load->library('email');
		$this->load->model("main_model");
	}
	public function index()
	{
		$this->load->view('register');
	}
	public function registration()
	{
		$this->form_validation->set_rules('user_name','Name' , 'required|trim');
		$this->form_validation->set_rules('email','Email Address', 'required|trim|valid_email|is_unique[register.email]');
		$this->form_validation->set_rules('password','Password' , 'required');
		if($this->form_validation->run())
		{
			$verification_key=md5(rand());
			$encryption_key=$this->encrypt->encode($this->input->post('password'));
			$data=array(
				'name' => $this->input->post('user_name'),
				'email'  => $this->input->post('email'),
				'password'=>$encryption_key,
				'verification_key'=>$verification_key,
				'is_email_verified' => 'no',
			);
			$id=$this->main_model->insert($data);

			if($id>0)
			{
				$subject="Please Verify Email Before Login";
				$message="
					<p>Hi ".$this->input->post('user_name')."</p>
					<p>This Email send by registration system.First you want to verify your email
						by <a href='".base_url()."main/verify_email/".$verification_key."'>link</a>
					</p>
				";
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.gmail.com',
					'smtp_port' => 465,
					'smtp_user' => 'info.register2019@gmail.com',
					'smtp_pass' => 'info@register',
					'mailtype' => 'html',
					'charset'   => 'utf-8',
					// 'wordwrap' => TRUE,
					
					'newline' => "\r\n",
					
				);
				 $this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from('info@webslesson.info');
				$this->email->to($this->input->post('email'));
				$this->email->subject($subject);
				$this->email->message($message);
				if($this->email->send())
				{
					$this->session->set_flashdata('message','check email for verfiy');
          			redirect('main/registration');
				}
				else
				{
					show_error($this->email->print_debugger());
					$this->session->set_flashdata('message',' error');
          			//redirect('main/registration');
    			}
			}
		}	
		else
		{
			$this->index();
		}
	}
	 function verify_email()
		{
		  if($this->uri->segment(3))
		   {
			   $verification_key = $this->uri->segment(3);
			   if($this->main_model->verify_email($verification_key))
			   {
			    $data['message'] = '<h1 align="center">Your Email has been successfully verified, now you can login from <a href="'.base_url().'login">here</a></h1>';
			   }
			   else
			   {
			    $data['message'] = '<h1 align="center">Invalid Link</h1>';
			   }
			   $this->load->view('email_verification', $data);
		  
			}
		}
}
