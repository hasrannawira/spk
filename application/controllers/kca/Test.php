<?php
//  for testing only
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
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
        $ab = $this->Wilayah_model->getKabByIdKec(15);
        echo json_encode($ab);
    }

    public function tabeltest()
    {
        $metatabel = $this->MetaTabel_model->getMetaTabel("1.1.1");
        $datatabel = $this->DesaTabel_model->getTabel1_1_1('1');
        $kec = $this->Wilayah_model->getKecamatanById(1);

        $ab = array(
            "no_tabel"=> $metatabel->no_tabel,
            "nama_tabel"=> $metatabel->nama_tabel,
            "sumber_data"=> $metatabel->sumber_data,
            "jum_kolom" => $metatabel->jum_kolom,
            "kecamatan_id" => $kec->id_kec,
            "kecamatan" => $kec->nama_kec,
        );

        $datareturn = array(
            "meta_tabel"=> $ab,
            "data_tabel"=> $datatabel,
        );

        echo json_encode($datareturn);
        
    }

    public function update(){
        // $dataupdate = '{
        //      "data": {
        //         "no_tabel": "1.1.4",
        //         "sumber_data": "Podes 2019",
        //         "kecamatan": "Masni",
        //         "data_tabel": [
        //         {
        //             "id_desa": "1",
        //             "nama_desa": "MUARA WARIORI",
        //             "latitude": "5.9934",
        //             "longitude": "9.1145"
        //         },
        //         {
        //             "id_desa": "2",
        //             "nama_desa": "KOYANI",
        //             "latitude": "5.6753",
        //             "longitude": "3.2726"
        //         },
        //         {
        //             "id_desa": "3",
        //             "nama_desa": "YEN SORIBO",
        //             "latitude": "2.8222",
        //             "longitude": "4.9827"
        //         }
        //         ]
        //     }
        //     }';

        $dataupdate = $this->input->post('data');
        
        $dataupdate = json_decode($dataupdate);
        $dataupdate = $dataupdate->data;
        if ($dataupdate != NULL){
            $sumber_data = $dataupdate->sumber_data;
            $notabel = $dataupdate->no_tabel;

            // update metadata tabel
            $statusupdate = $this->MetaTabel_model->updateSumberDataByNoTabel($notabel, $sumber_data);
            $datatabel = $dataupdate->data_tabel;
            $statusupdaterow = $this->DesaTabel_model->updateTabel1_1_4($datatabel);
            if ($statusupdaterow){
                $datareturn = array(
                        "task" => "update",
                        "tabel" => $notabel,
                        "status"=> "success",
                    );
                echo json_encode($datareturn);
            } else {
                $datareturn = array(
                    "task" => "update",
                    "tabel" => $notabel,
                    "status"=> "success",
                );
                echo json_encode($datareturn);
            }
        }else{
            $datareturn = array(
                "task" => "update",
                "status"=> "failed, No Data From Client"
            );
            echo json_encode($datareturn);
        }

    
    }

}

/* End of file test.php */

?>