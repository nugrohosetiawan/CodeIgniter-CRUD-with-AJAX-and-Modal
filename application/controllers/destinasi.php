<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destinasi extends CI_Controller {

	public function __construct()
    {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('des_model');
    }

    public function index()
    {
      
      $this->load->database();
      $this->load->model('des_model');
      $data['h']=$this->des_model->getdestinasi();
      $this->load->view('p_manage',$data);
    
    }

    public function des_add()
    {
      $data = array(
          'nama' => $this->input->post('nama'),
          'deskripsi' => $this->input->post('deskripsi'),
          'lokasi' => $this->input->post('lokasi'),
          
          'kategori' => $this->input->post('kategori'),
          'stat' => $this->input->post('stat'),
        );

      if(!empty($_FILES['gambar']['name']))
        {
            $upload = $this->_do_upload();
            $data['gambar'] = $upload;
        }

      $insert = $this->des_model->des_add($data);
      echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'gambar';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }



    public function des_edit($id)
    {
      $data = $this->des_model->get_by_id($id);
       echo json_encode($data);
    }
       
    public function des_update()
    {
    $data = array(
        
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
   
    public function des_delete($id)
    {
    $this->des_model->delete_by_id($id);
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

   

}