<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('WilayahModel');  
        $this->load->model('MetaModel');  
        $this->load->model('TabelModel');
    }
    
    // retrive all table id, nomor , and judul
    public function index()
    {
        header('Content-Type: application/json');
        $iduser = 25;
        $metabuku = $this->MetaModel->getIdBukuByUserId($iduser);
        $alltabel = $this->MetaModel->getAllMetaTabel();
        $kecname = $metabuku->nama_kec;

        $datac = array();
        foreach ($alltabel as $tabel){
            $temp = array(
                'id_tabel'=>$tabel['id_tabel'],
                'kode_tabel'=>$tabel['kode_tabel'],
                'judul_tabel'=>$tabel['nama_tabel'].$kecname,
            );
            array_push($datac,$temp);
        }
        echo json_encode($datac);   

    }

    // view a table
    public function view(){
        header('Content-Type: application/json');

        $idtabel = 2; // didapatkan dari pilihan tabel sebelumnya, POST 
        $iduser = 25; //didapatkan dari page sebelumnya, POST 

        $metabuku = $this->MetaModel->getIdBukuByUserId($iduser);
        $kecname = $metabuku->nama_kec;
        $idbuku = $metabuku->id_buku;

        $meta = $this->MetaModel->getMetaById($idtabel);
        $relasi = $this->TabelModel->getBarisKarByIdTabel($idtabel);

        $idnamabaris = $relasi->id_nama_baris;
        $idnamakolom = $relasi->id_nama_kolom;
        $baris = $this->TabelModel->getBarisByIdNamaBaris($idnamabaris);
        $kolom = $this->TabelModel->getKolomByIdNamaKolom($idnamakolom);
        $judulbaris = $this->TabelModel->getJudulBarisByIdNamaBaris($idnamabaris);
        $data = $this->TabelModel->getDataByBukunTabel($idbuku, $idtabel);
        
        $cdata = array(
            "id" => $meta->id_tabel,
            "nomor" => $meta->kode_tabel,
            "kecamatan" =>$kecname,
            "judul" => $meta->nama_tabel,
            "sumber" => $meta->sumber_data,
            "keterangan" => $meta->keterangan,
            "judul_baris" => $judulbaris->nama_judul_baris,
            "baris" => $baris,
            "kolom" => $kolom,
            "data" => $data,

        );
        echo json_encode($cdata);
    }

    // update a table
    public function update(){

    }



}

/* End of file Tabel.php */


?>