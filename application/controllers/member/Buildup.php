<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buildup extends CI_Controller {

    private $phpword;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Wordhelper');
        $this->load->model('MetaModel');
    }

    
    public function index()
    {
        // $idkec = '9111030';
        $idkec = $this->input->get('id_kec');        
        if (empty($idkec)){
            $idkec = '9105141';
            $idbuku = 1;
        } else {
            $idbuku = $this->MetaModel->getIdBukuByKec($idkec);
        }

        $phpword = $this->wordhelper->getWord();
        $phpword = $this->wordhelper->halamandepan($phpword, $idbuku, $idkec);
        $phpword = $this->wordhelper->kpdandaftarisi($phpword, $idbuku, $idkec);
        $phpword = $this->wordhelper->bab1indo($phpword, $idbuku, $idkec);
        $phpword = $this->wordhelper->bab2indo($phpword, $idbuku, $idkec);
        $phpword = $this->wordhelper->bab3indo($phpword, $idbuku, $idkec);
        $phpword = $this->wordhelper->bab4indo($phpword, $idbuku, $idkec);
        $phpword = $this->wordhelper->bab5indo($phpword, $idbuku, $idkec);
        $phpword = $this->wordhelper->bab6indo($phpword, $idbuku, $idkec);
        $phpword = $this->wordhelper->bab7indo($phpword, $idbuku, $idkec);
        $phpword = $this->wordhelper->bab8indo($phpword, $idbuku, $idkec);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpword, 'Word2007', $download = TRUE);
        $filename = 'KCA_'.$idkec.'.docx';
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save("php://output");
    }

   

}

/* End of file Buildup.php */


?>