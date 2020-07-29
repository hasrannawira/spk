<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        $this->load->model('DesaTabel_model');
        $this->load->model('MetaTabel_model');
        $this->load->model('Wilayah_model');
    }
    

    public function index()
    {
        
    }

    public function tabel1_1_1()
    {
        //kode kecamatan
        $idkec = 1; 
        $kec = $this->Wilayah_model->getKecamatanById($idkec);

        // kode tabel
        $no_tabel = "1.1.1";
        $metatabel = $this->MetaTabel_model->getMetaTabel($no_tabel);
        $datatabel = $this->DesaTabel_model->getTabel1_1_1($idkec);
        
        $namakolom = array("Desa/Kelurahan", "Luas Wilayah", "Persentase Luas Wilayah");
        $ab = array(
            "no_tabel"=> $metatabel->no_tabel,
            "nama_tabel"=> $metatabel->nama_tabel,
            "sumber_data"=> $metatabel->sumber_data,
            "jum_kolom" => $metatabel->jum_kolom,
            "nama_kolom" => $namakolom,
            "kecamatan_id" => $kec->id_kec,
            "kecamatan" => $kec->nama_kec,
        );

        $datareturn = array(
            "meta_tabel"=> $ab,
            "data_tabel"=> $datatabel,
        );

        echo json_encode($datareturn);
    }

    public function tabel1_1_2(){
        $idkec = 1; 
        $kec = $this->Wilayah_model->getKecamatanById($idkec);

        // kode tabel
        $no_tabel = "1.1.2";
        $metatabel = $this->MetaTabel_model->getMetaTabel($no_tabel);
        $datatabel = $this->DesaTabel_model->getTabel1_1_2($idkec);
        
        $namakolom = array("Desa/Kelurahan", "Tinggi Wilayah", "Jarak ke Ibukota Distrik");
        $ab = array(
            "no_tabel"=> $metatabel->no_tabel,
            "nama_tabel"=> $metatabel->nama_tabel,
            "sumber_data"=> $metatabel->sumber_data,
            "jum_kolom" => $metatabel->jum_kolom,
            "nama_kolom" => $namakolom,
            "kecamatan_id" => $kec->id_kec,
            "kecamatan" => $kec->nama_kec,
        );

        $datareturn = array(
            "meta_tabel"=> $ab,
            "data_tabel"=> $datatabel,
        );

        echo json_encode($datareturn);
    }

    public function tabel1_1_3(){
        return "Kosong";
    }

    public function tabel1_1_4(){
        $idkec = 1; 
        $kec = $this->Wilayah_model->getKecamatanById($idkec);

        // kode tabel
        $no_tabel = "1.1.4";
        $metatabel = $this->MetaTabel_model->getMetaTabel($no_tabel);
        $datatabel = $this->DesaTabel_model->getTabel1_1_4($idkec);
        
        $namakolom = array("Desa/Kelurahan", "Latitude", "Longitude");
        $ab = array(
            "no_tabel"=> $metatabel->no_tabel,
            "nama_tabel"=> $metatabel->nama_tabel,
            "sumber_data"=> $metatabel->sumber_data,
            "jum_kolom" => $metatabel->jum_kolom,
            "nama_kolom" => $namakolom,
            "kecamatan_id" => $kec->id_kec,
            "kecamatan" => $kec->nama_kec,
        );

        $datareturn = array(
            "meta_tabel"=> $ab,
            "data_tabel"=> $datatabel,
        );

        echo json_encode($datareturn);
    }

}

/* End of file Tabel.php */



?>