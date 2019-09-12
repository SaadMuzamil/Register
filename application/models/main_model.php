<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main_model extends CI_Model {

	public function insert($data)
	{
		$this->db->insert('register',$data);
		return $this->db->insert_id();
	}

	function verify_email($verification_key)
	 {
	  $this->db->where('verification_key', $verification_key);
	  $this->db->where('is_email_verified', 'no');
	  $query = $this->db->get('register');
	 if($query->num_rows() > 0)
	  {
	   $data = array(
	    'is_email_verified'  => 'yes'
	   );
	   $this->db->where('verification_key', $verification_key);
	   $this->db->update('register', $data);
	   return true;
	  }
	  else
	  {
	   return false;
	  }
	  
	}
	
}
