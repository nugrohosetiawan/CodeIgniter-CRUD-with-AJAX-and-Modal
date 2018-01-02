<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	 	{

	 		parent::__construct();
			$this->load->helper('url');
			$this->load->model('des_model');
	 		
	 	}

	public function index()
	{
	$cek = $this->session->userdata('username');
	   if(empty($cek)){
			$this->load->view('p_login');
		}else{
	  $this->load->database();
      $this->load->model('des_model');
      $data['h']=$this->des_model->getdestinasi();
      $this->load->view('p_manage',$data);
}
		
	}
	public function des_edit($id)
    {
      $data = $this->des_model->get_by_id($id);
       echo json_encode($data);
    }

    public function des_update()
     {
    $data = array(
    	  'id_des' => $this->input->post('id_des'),
          'nama' => $this->input->post('nama'),
          'deskripsi' => $this->input->post('deskripsi'),
          'lokasi' => $this->input->post('lokasi'),
          'gambar' => $this->input->post('gambar'),
          'kategori' => $this->input->post('kategori'),
          'stat' => $this->input->post('stat'),
      );
    $this->des_model->des_update(array('id_des' => $this->input->post('id_des')), $data);
    echo json_encode(array("status" => TRUE));
    }

    function uploadFileMulti()
    {
      //echo "<pre>";print_r($_FILES);"</pre>";exit();
      if(isset($_FILES[0]['error']))
      {
        $fileUpload = $_FILES[0]['name'];
        $tmpFile = $_FILES[0]['tmp_name'];
        $uploadDir = "uploads/";
        
        move_uploaded_file($tmpFile, $uploadDir.$fileUpload);
        
        $flag = true;
      }
      else
      {
        $flag = false;
      }
      
      echo $flag;
    }



//	public function detail()
//	{
//		$this->load->view('p_profile');
//	}
//	public function usr()
//	{
//		$this->load->view('p_usr');
//	}

}
