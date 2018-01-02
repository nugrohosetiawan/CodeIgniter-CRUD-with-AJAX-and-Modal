<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	 	{
	 		parent::__construct();
	    $this->load->helper('url');
      $this->load->model('kat_model');
	 	}
    public function index()//proses pengenalan model, view, dalam halaman utama
  {
      $this->load->database();
      $this->load->model('kat_model');
      $data['h']=$this->kat_model->getkategori();
      $this->load->view('p_kategori',$data);
    
  }

    	
	public function kat_add() //proses add database
	{
		$data = array(
          'kategori' => $this->input->post('kategori'),
         );
        $insert = $this->kat_model->kat_add($data);
        echo json_encode(array("status" => TRUE));
	}
	public function kat_edit($id)
    {
      $data = $this->kat_model->get_by_id($id);
       echo json_encode($data);
    }

    public function kat_delete($id)
    {
    $this->kat_model->delete_by_id($id);
    echo json_encode(array("status" => TRUE));
     }

     public function kat_update()
    {
    $data = array(
        
          'kategori' => $this->input->post('kategori'),
          
      );
    $this->kat_model->kat_update(array('id_kat' => $this->input->post('id_kat')), $data);
    echo json_encode(array("status" => TRUE));
    }

		
	
}