<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Des_model extends CI_Model {
	var $table = 'destinasi';
 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getdestinasi()
	{
		
		$query=$this->db->get('destinasi');
		return $query;
	}
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_des',$id);
		$query = $this->db->get();
 
		return $query->row();
	}
	public function des_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function des_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function delete_by_id($id)
	{
		$this->db->where('id_des', $id);
		$this->db->delete($this->table);
	}

	
}
