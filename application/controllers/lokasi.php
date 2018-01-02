<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

	public function __construct()
	 	{
	 		parent::__construct();
	   		$this->load->helper('url');
    		$this->load->model('lok_model');
	 	}

	 public function index(){
	 	$this->load->database();
	 	$this->load->model('lok_model');
	 	$data['h']=$this->lok_model->getlokasi();
	 	$this->load->view('p_lokasi',$data);
	 }	
	 public function lok_add() //proses add database
	{
		$data = array(
          'lokasi' => $this->input->post('lokasi'),
         );
        $insert = $this->lok_model->lok_add($data);
        echo json_encode(array("status" => TRUE));
	}
	public function lok_edit($id)
    {
      $data = $this->lok_model->get_by_id($id);
       echo json_encode($data);
    }
     public function lok_update()
    {
    $data = array(
        
          'lokasi' => $this->input->post('lokasi'),
          
      );
    $this->lok_model->lok_update(array('id_lok' => $this->input->post('id_lok')), $data);
    echo json_encode(array("status" => TRUE));
    }
 	

 	public function lok_delete($id)
    {
    $this->lok_model->delete_by_id($id);
    echo json_encode(array("status" => TRUE));
     }

     public function upload_file()
{
    $this->load->library('upload');

    if (isset($_FILES['gambar']) && !empty($_FILES['gambar']))
    {
        if ($_FILES['gambar']['error'] != 4)
        {
             // Image file configurations
            $config['upload_path'] = 'upload/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $this->upload->initialize($config);
            $this->upload->do_upload('gambar');
        }
    }}


	
}