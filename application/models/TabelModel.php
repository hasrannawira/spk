<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TabelModel extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
         $this->db2 = $this->load->database('dbkca', TRUE);
    }

    //get all data in a tabel
    function getDataByBukunTabel($idbuku, $idtabel){
        $this->db2->select('id_data, baris, kolom, data');
        $this->db2->where('id_buku', $idbuku);
        $this->db2->where('id_tabel', $idtabel);
        $this->db2->order_by('baris ASC, kolom ASC');
        $data = $this->db2->get('tbl_data_kca');      
        
        return $data->result_array();
    }

    function getIdTabelByNonIdKec($notabel,$idkec){
        $this->db2->select('id_tabel, kode_tabel');
        $this->db2->where('kode_tabel', $notabel);
        $this->db2->where('id_kec', $idkec);
        $data = $this->db2->get('tbl_tabel_kca')->row(1);

        return $data;
    }

    function getBarisKarByIdTabel($idtabel){
        $this->db2->select('id_tabel, id_nama_judul_baris AS id_nama_baris, id_nama_karakteristik AS id_nama_kolom');
        $this->db2->where('id_tabel',$idtabel);        
        $data = $this->db2->get('tbl_tabel_kca')->row(1);
        return $data;
    }

    function getBarisByIdNamaBaris($idnamabaris){
        $this->db2->select('no, nama_baris');
        $this->db2->where('id_nama_judul_baris',$idnamabaris);
        $data = $this->db2->get('tbl_judul_baris');      
        
        return $data->result_array();
    }

    function getJudulBarisByIdNamaBaris($idnamabaris){

        $this->db2->select('nama_judul_baris');
        $this->db2->where('id_nama_judul_baris',$idnamabaris);
        $data = $this->db2->get('tbl_nama_judul_baris');      
        
        return $data->row(1);
    }

    function getKolomByIdNamaKolom($idnamakolom){
        $this->db2->select('no, nama_karakteristik AS nama_kolom');
        $this->db2->where('id_nama_karakteristik', $idnamakolom);
        $data = $this->db2->get('tbl_karakteristik');      
        
        return $data->result_array();
    }

    function updateDataById($data){
        $this->db2->update_batch('tbl_data_kca', $data,'id_data');
        if ($this->db2->trans_status() === FALSE){
            return FALSE;
        } else {
            return TRUE;
        };
    }
    

}

/* End of file TabelModel.php */


?>