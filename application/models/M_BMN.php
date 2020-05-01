<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class M_BMN extends CI_Model{
	public function tampil_data(){

		return $this->db->get('tbl_bmn');
	}

	public function input_data($data){

		$this->db->insert('tbl_bmn',$data);
	}

	public function hapus_data($where){
		$this->db->where($where);
		$this->db->delete('tbl_bmn');
	}

	public function edit_data($where){
		return $this->db->get_where('tbl_bmn', $where);
		
	}

	public function update_data($where,$data){
		$this->db->where($where);
		$this->db->update('tbl_bmn',$data);
		
	}
}


?>