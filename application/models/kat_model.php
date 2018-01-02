<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kat_model extends CI_Model {
	var $table = 'kategori';

 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function kat_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function getkategori()
	{
		
		$query=$this->db->get('kategori');
		return $query;
	}

	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_kat',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
	public function delete_by_id($id)
	{
		$this->db->where('id_kat', $id);
		$this->db->delete($this->table);
	}
	public function kat_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

}