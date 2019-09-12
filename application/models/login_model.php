<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {

	public function login($email,$password)
	{
		$this->db->where("email",$email);
		$query=$this->db->get('register');
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row) {
				if($row->is_email_verified == 'yes')
				{
					$check_password=$this->encrypt->decode($row->password);
					if($password == $check_password)
					{
						$this->session->set_userdata('id',$row->id);
					}
					else
					{
						return 'Wrong Password';
					}
				}
				else{
					return 'First Verify your Email';
				}
			}

		}
		else
		{
			return 'Wrong Email';
		}
	}
	
}
