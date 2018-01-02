<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function index(){
		$cek = $this->session->userdata('username');
		if(empty($cek))
			header("location:".base_url());
		else{
			$this->session->sess_destroy();
			header("location:".base_url());
		}


	}

}