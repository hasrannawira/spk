<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        $this->load->model('WilayahModel');  
        $this->load->model('MetaModel');  
        $this->load->model('TabelModel');    
    }
    

    // retrive a tabel
    public function index(){
        // $notabel = $this->input->get('no', FALSE);
        // $idbuku = $this->input->get('buku', FALSE);
        // $idkec = $this->input->get('kec', FALSE);

        $notabel = '1.1.1';
        $idbuku = '1';
        $idkec = '9105141';
        $kec = $this->WilayahModel->getKecById($idkec);
        $idtabel = $this->TabelModel->getIdTabelByNonIdKec($notabel,$idkec)->id_tabel; 

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
            "kecamatan" =>$kec->nama_kec,
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

    public function alltabel(){
        
        $idkec = 9; //mkw barat
        $alltabel = $this->MetaModel->getAllMetaByIdKec($idkec);
        echo json_encode($alltabel);

    }

    public function update(){
        $datatoserver = '{
            "data": {
              "task": "update",
              "id": "1",
              "sumber": "Podes 2019 uhuy",
              "keterangan": "Ini Data Dummy Mohon diubah",
              "data_tabel": [
                {
                  "id_data": "1",
                  "data": "34"
                },
                {
                  "id_data": "2",
                  "data": "25"
                },
                {
                  "id_data": "3",
                  "data": "46"
                }
              ]
            }
          }';
        // $dataupdate = $this->input->post('data');
        $dataupdate = json_decode($datatoserver);
        if ($dataupdate != NULL){
            $dataupdate = $dataupdate->data;
            $metadata = array(
                "sumber_data"=> $dataupdate->sumber,
                "keterangan"=> $dataupdate->keterangan,
            );
            $updatemeta = $this->MetaModel->updateMetaById($dataupdate->id, $metadata); 
            $updatedata = $this->TabelModel->updateDataById($dataupdate->data_tabel);
            if($updatedata && $updatemeta){
                $datareturn = array(
                    "task" => "update",
                    "status"=> "success"
                );
                echo json_encode($datareturn);
            } else {
                $datareturn = array(
                    "task" => "update",
                    "status"=> "Failed",
                    "message"=> "Database error"
                );
                echo json_encode($datareturn);
            }
        } else {
            $datareturn = array(
                "task" => "update",
                "status"=> "failed",
                "message"=> "No Data From Client"
            );
            echo json_encode($datareturn);
        };

        
        
    }

}

/* End of file Test.php */

?>
