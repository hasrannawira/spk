<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MetaModel extends CI_Model {
    // meta itu hanya sebatas sumber, keterangan, dan judul.
    
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('dbkca', TRUE);
    }

    function getAllMeta(){
        $data = $this->db2->get('tbl_tabel_kca')->result_array();
        return $data;
    }

    //get all tabel by kecamatan
    function getAllMetaTabel(){
        $this->db2->select('id_tabel, kode_tabel, nama_tabel, jenis_tabel, sumber_data, keterangan');
        $this->db2->order_by('kode_tabel ASC');
        $data = $this->db2->get('tbl_tabel_kca')->result_array();
        return $data;
    }

    //get type tabel by kecamatan
    function getMetaByType($type){
        $this->db2->select('id_tabel, kode_tabel, nama_tabel, jenis_tabel, sumber_data, keterangan');
        $this->db2->where('jenis_tabel',$type);
        $this->db2->order_by('kode_tabel ASC');
        $data = $this->db2->get('tbl_tabel_kca')->result_array();
        return $data;
    }

    function getMetaById($idtabel){
        $this->db2->select('id_tabel, kode_tabel, nama_tabel, jenis_tabel, sumber_data, keterangan, type_endrow');
        $this->db2->where('id_tabel',$idtabel);        
        $data = $this->db2->get('tbl_tabel_kca')->row(1);
        return $data;
    }

    function updateMetaById($idtabel, $data){
        $this->db2->where('id_tabel', $idtabel);
        $this->db2->update('tbl_tabel_kca', $data);
        if ($this->db2->trans_status() === FALSE){
            return FALSE;
        } else {
            return TRUE;
        };
    }

    function getIdBukuByUserId($iduser){
        $this->db2->select('bk.id_buku, bk.nama_buku, bk.id_kec, kc.nama_kec');
        $this->db2->where('id_user', $iduser);
        $this->db2->from('tbl_master_buku_kca AS bk');
        $this->db2->join('tbl_wil_kec AS kc', 'kc.id_kec = bk.id_kec');

        $data = $this->db2->get()->row(1);
        return $data;
    }

    function getIdBukuByKec($idkec){
        $this->db2->select('id_buku');
        $this->db2->where('id_kec', $idkec);
        $this->db2->from('tbl_master_buku_kca');

        $data = $this->db2->get()->row(1)->id_buku;
        return $data;
    }

    function getAllTabelByBab($bab, $idkec){
        $this->db2->select('kode_tabel, nama_tabel');
        $this->db2->order_by('kode_tabel ASC');
        $this->db2->where('id_kec', $idkec);
        $this->db2->like('kode_tabel', $bab, 'after');
        $data = $this->db2->get('tbl_tabel_kca')->result_array();

        return $data;
    }



    

}

/* End of file MetaTabel.php */


?>