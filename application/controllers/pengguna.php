<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function index()
	{	
		 $this->load->database();
     	 $this->load->model('peng_model');	
		 
		 $data['h']=$this->peng_model->getpengguna();
      	 $this->load->view('p_pengguna',$data);
	}

}
