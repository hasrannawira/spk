<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class M_aktivitas extends CI_Model{
	public function tampil_data(){
		$this->db->order_by('waktu','DESC');
		return $this->db->get('tbl_aktivitas');
	}

	public function input_data($aktivitas){

		$this->db->insert('tbl_aktivitas',$aktivitas);
	}

}

?>