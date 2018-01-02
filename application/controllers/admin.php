<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$cek = $this->session->userdata('username');
		if($cek == 'admin')
		$this->load->view('p_admin');
		else
			header("location:".base_url());
	}

}
