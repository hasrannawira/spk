<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buildup extends CI_Controller {

    private $phpword;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Wordhelper');

    }

    
    public function index()
    {
        $phpword = $this->wordhelper->getWord();
        $phpword = $this->wordhelper->bab1indo($phpword);
        $phpword = $this->wordhelper->bab2indo($phpword);
        // $test->bab2Indo($test->getWord()); 

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpword, 'Word2007', $download = TRUE);
        $filename = 'kca.docx';
        header('Content-Disposition: attachment; filename='.$filename);
        $objWriter->save("php://output");
    }

   

}

/* End of file Buildup.php */


?>