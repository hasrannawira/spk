<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class WilayahModel extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->db2 = $this->load->database('dbkca', TRUE);
    }


    function getAllWilayah(){
        $this->db2->select('*');
        $this->db2->from('tbl_wil_kec');
        $this->db2->join('tbl_wil_kab','tbl_wil_kec.id_kab=tbl_wil_kab.id_kab', 'inner');
        $this->db2->order_by('tbl_wil_kec.id_kab');
        $data = $this->db2->get()->result_array();
        return $data;
    }

    function getAllKecByKab($idkab){
        $this->db2->select('*');
        $this->db2->where('id_kec', $idkec);
        $data = $this->db2->get('tbl_wil_kec')->result_array();
        return $data;
    }

    function getKecById($idkec){
        $this->db2->select('*');
        $this->db2->from('tbl_wil_kec');
        $this->db2->join('tbl_wil_kab','tbl_wil_kec.id_kab=tbl_wil_kab.id_kab', 'inner');
        $this->db2->where('id_kec', $idkec);
        return $data = $this->db2->get()->row(1);
    }

    function getAllKab(){
        $this->db2->select('*');
        return $this->db2->get('tbl_wil_kab')->result_array();
    }
 
    

}

/* End of file WilayahModel.php */


?>