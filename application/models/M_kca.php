<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class M_kca extends CI_Model{

    function __construct(){
        parent::__construct();
        //load our second db and put in $db2
        $this->db2 = $this->load->database('dbkca', TRUE);
     }

	public function tampil_data_buku(){

		return $this->db2->get('tbl_master_buku_kca');
	}

	public function tampil_kab(){

		return $this->db2->get('tbl_wil_kab');
	}
	public function input_kab($data){

		$this->db2->insert('tbl_wil_kab',$data);
	}
	public function edit_kab($where){

		return $this->db2->get_where('tbl_wil_kab', $where);
	}
	public function hapus_kab($where){
		$this->db2->where($where);
		$this->db2->delete('tbl_wil_kab');
	}
	public function tampil_kec(){

		return $this->db2->get('tbl_wil_kec');
	}

	public function input_kec($data){

		$this->db2->insert('tbl_wil_kec',$data);
	}
	public function edit_kec($where){

		return $this->db2->get_where('tbl_wil_kec', $where);
	}

	public function hapus_kec($where){
		$this->db2->where($where);
		$this->db2->delete('tbl_wil_kec');
	}
	public function update_kec($where,$data){
		$this->db2->where($where);
		$this->db2->update('tbl_wil_kec',$data);
		
	}
	public function input_data_buku($data){

		$this->db2->insert('tbl_master_buku_kca',$data);
	}

	public function hapus_data_buku($where){
		$this->db2->where($where);
		$this->db2->delete('tbl_master_buku_kca');
	}

	public function edit_data_buku($where){
		return $this->db2->get_where('tbl_master_buku_kca', $where);
		
	}

	public function update_data_buku($where,$data){
		$this->db2->where($where);
		$this->db2->update('tbl_master_buku_kca',$data);
		
	}

	public function tampil_master_tabel(){
		return $this->db2->get('tbl_tabel_kca');
	}

	public function input_data_tabel($data){

		$this->db2->insert('tbl_tabel_kca',$data);
	}

	public function hapus_tabel($where){
		$this->db2->where($where);
		$this->db2->delete('tbl_tabel_kca');
	}

	public function edit_tabel($where){
		return $this->db2->get_where('tbl_tabel_kca', $where);		
	}

	public function update_tabel($where,$data){
		$this->db2->where($where);
		$this->db2->update('tbl_tabel_kca',$data);	
	}

	public function tampil_judul_baris(){
		$this->db2->order_by('nama_judul_baris');
		return $this->db2->get('tbl_nama_judul_baris');
	}
	public function tampil_nama_judul_baris($where){
		return $this->db2->get_where('tbl_nama_judul_baris', $where);
	}
	public function tambah_nama_judul_baris($data){
		$this->db2->insert('tbl_nama_judul_baris',$data);
	}
	public function update_nama_judul_baris($where,$data){
		$this->db2->where($where);
		$this->db2->update('tbl_nama_judul_baris',$data);	
	}
	public function tambah_judul_baris($data){
		$this->db2->insert('tbl_judul_baris',$data);
	}
	public function hapus_judul_baris($where){
		$this->db2->where($where);
		$this->db2->delete('tbl_judul_baris');
		$this->db2->where($where);
		$this->db2->delete('tbl_nama_judul_baris');
	}
	public function edit_judul_baris($where){
		return $this->db2->get_where('tbl_judul_baris', $where);		
	}

	public function update_judul_baris($where,$data){
		$this->db2->where($where);
		$this->db2->update('tbl_judul_baris',$data);	
	}
	public function tampil_karakteristik(){
		$this->db2->order_by('nama_karakteristik');
		return $this->db2->get('tbl_nama_karakteristik');
	}
	public function tampil_nama_karakteristik($where){
		return $this->db2->get_where('tbl_nama_karakteristik', $where);
	}
	public function tambah_nama_karakteristik($data){
		$this->db2->insert('tbl_nama_karakteristik',$data);
	}
	public function update_nama_karakteristik($where,$data){
		$this->db2->where($where);
		$this->db2->update('tbl_nama_karakteristik',$data);	
	}
	public function tambah_karakteristik($data){
		$this->db2->insert('tbl_karakteristik',$data);
	}
	public function hapus_karakteristik($where){
		$this->db2->where($where);
		$this->db2->delete('tbl_karakteristik');
		$this->db2->where($where);
		$this->db2->delete('tbl_nama_karakteristik');
	}
	public function edit_karakteristik($where){
		return $this->db2->get_where('tbl_karakteristik', $where);		
	}
	public function update_karakteristik($where,$data){
		$this->db2->where($where);
		$this->db2->update('tbl_karakteristik',$data);	
	}
	public function hapus_data_isi($where){
		$this->db2->where($where);
		$this->db2->delete('tbl_data_kca');
	}
	public function tampil_data_isi($where){
		$this->db2->where($where);
		$this->db2->order_by('baris');
		$this->db2->order_by('kolom');
		return $this->db2->get_where('tbl_data_kca');
	}
	public function input_data_isi($data){

		$this->db2->insert('tbl_data_kca',$data);
	}
	public function update_data_isi($where,$data){

		$this->db2->where($where);
		$this->db2->update('tbl_data_kca',$data);	
	}
 
    public function getKabByIdInstansi(){
        $id_instansi = $this->session->userdata('id_instansi');
        $this->db2->select('*');
        $this->db2->from('tbl_wil_kab');
        $this->db2->where('id_kab', $id_instansi);
        return $data = $this->db2->get()->row(1)->nama_kab;
    }
    
}


?>