<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$cek = $this->session->userdata('username');
		if($cek == 'user')
		
		$this->load->view('p_user');
		else
			header("location:".base_url());
	}

}
