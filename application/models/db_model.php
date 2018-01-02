<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_model extends CI_Model {
	public function getLoginData($usr, $pwd){
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($pwd));
		$cek_login = $this->db->get_where('users',array('username'=> $u, 'password' => $p ));
		if ($cek_login->num_rows() > 0) {
			$qad = $cek_login->row();
			if($u == $qad->username && $p == $qad->password){
				$sess = array(
					'username' => $qad->username,
					'stts'	   => $qad->status,

					);
				$this->session->set_userdata($sess);
				if($qad->status == 'admin')
					header('location:'.base_url().'admin');
				else
					header('location:'.base_url().'user');
			}

		} else {
			echo "<script>alert('Username/Password salah, Silahkan coba lagi...');";
			echo "windows.location.href = '"  .base_url(). "';";
			echo "</script>";
		}

	}
	

	
}
